<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Training;
use App\Models\Coach;
use App\Models\Organization;
use App\Models\AppUser;
use App\Models\TeamPlayerAttendenceTraining;
use App\Models\TeamPlayer;
use App\Http\Controllers\TrainingController;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams = Team::all();
		return view('teams', compact('teams'));
    }

    public function getTeamsBySportsType($id)
    {

        $teams = DB::table("teams")
                ->join("organizations", "teams.organizations_id", "=", "organizations.id")
                ->where('organizations.sports_types_id', '=', $id)
                ->select("teams.name")
                ->get();

		return view('teams', compact('teams'));
    }
    public function getTeamsByOrganizations($id)
    {

        $teams = DB::table("teams")
                ->join("organizations", "teams.organizations_id", "=", "organizations.id")
                ->where('organizations.id', '=', $id)
                ->select("teams.name", "teams.id")
                ->get();

		return view('myteams', compact('teams'));
    }

    public function create()
    {

        $name = Auth::user()->name;
        $app_user = AppUser::where('name', $name)->first();

        $organizations = DB::table("organizations")
        ->join("organization_leaders", "organizations.organization_leaders_id", "=", "organization_leaders.id")
        ->where('organization_leaders.app_user_id', '=', $app_user->id)
        ->select("organizations.id","organizations.name")
        ->get();

        return view('create_team', compact('organizations'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'name' => 'required|string|min:2|max:50|unique:teams',
        );        
        $this->validate($request, $rules);

        $name = Auth::user()->name;
        $app_user = AppUser::where('name', $name)->first();
        $coaches = $app_user->coaches()->create();

        $team = new Team();
        $team->name = $request->name;
        $team->organizations_id = $request->organization_id;
        $team->coaches_id = $coaches->id;
        $team->save();
        return redirect()->action(
            [TeamController::class, 'edit'], ['id' => $team->id , 'message' => "Ierakstiet cilvēka lietotājvārdu un spiediet add"]
        );
    }

    public function addPlayer(Request $request)
    {

        $app_user = AppUser::where('name', $request->player_name)->first();

        $name = Auth::user()->name;
        $curr_user = AppUser::where('name', $name)->first();

        if ($app_user == null  OR $app_user->name == $curr_user->name) {
            return redirect()->action(
                [TeamController::class, 'edit'], ['id' => $request->team_id, 'message' => 'Spēlētājs ar šādu lietotājvārdu nav iespējams pievienot']
            );
        } else {

            $isAlready = TeamPlayer::where('app_users_id', $app_user->id)->where('teams_id', $request->team_id)->first();
            
            if ($isAlready !== null) {
                return redirect()->action(
                    [TeamController::class, 'edit'], ['id' => $request->team_id, 'message' => 'Spēlētājs ar šādu lietotājvārdu nav iespējams pievienot']
                );
            }


            $team_player = new TeamPlayer();
            $team_player->is_default_attending = false;
            $team_player->app_users()->associate($app_user);
            $team_player->teams_id = $request->team_id;
            $team_player->save();

            return redirect()->action(
                [TeamController::class, 'edit'], ['id' => $request->team_id, 'message' => 'Spēlētājs veiksmīgi pievienots komandai']
            );
        }

    }

    public function addTraining(Request $request)    {

        $training = new Training();
        $training->start_date_and_time = $request->date_and_time;
        $training->team_id = $request->team_id;

        $training->save();

        $players_default_go = DB::table("team_players")
        ->where('teams_id', $request->team_id)
        ->where("is_default_attending", "1")
        ->select("app_users_id")
        ->get();

        foreach ($players_default_go as $player_id) {
            $attendence = new TeamPlayerAttendenceTraining();
            $attendence->app_users_id = $player_id->app_users_id;
            $attendence->training_id = $training->id;
            $attendence->save();
        }


        return redirect()->action(
            [TeamController::class, 'edit'], ['id' => $request->team_id]
        );
    }

    public function willAttend($training_id)    {

        $name = Auth::user()->name;
        $app_user = AppUser::where('name', $name)->first();

        $isAlready = DB::table("team_player_attendence_trainings")
                ->where("training_id", $training_id)
                ->where("app_users_id", $app_user->id)
                ->select("app_users_id", "training_id")
                ->first();

        if ($isAlready === null) {

            $attendence = new TeamPlayerAttendenceTraining();
            $attendence->app_users_id = $app_user->id;
            $attendence->training_id = $training_id;
            $attendence->save();
        }

       return redirect()->action([TrainingController::class, 'index']);
    }

    public function wontAttend($training_id)    {
        
        $name = Auth::user()->name;
        $app_user = AppUser::where('name', $name)->first();

        $isAlready = DB::table("team_player_attendence_trainings")
                ->where("training_id", $training_id)
                ->where("app_users_id", $app_user->id)
                ->select("app_users_id", "training_id")
                ->first();

        if ($isAlready !== null) {
            DB::table("team_player_attendence_trainings")
            ->where("training_id", $training_id)
            ->where("app_users_id", $app_user->id)->delete();
        }

       return redirect()->action([TrainingController::class, 'index']);

    }

    public function showPlayingTeams() {
        
        $name = Auth::user()->name;
        $app_user = AppUser::where('name', $name)->first();

        $teams = DB::table("team_players")
                ->join("teams", "team_players.teams_id", "=", "teams.id")
                ->where("app_users_id", $app_user->id)
                ->get();

        echo $teams;

		return view('playing_teams', compact('teams'));
    }

    public function willAlwaysAttend($team_id) {

    }

    public function willNeverAttend($team_id) {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $message = "Ierakstiet cilvēka lietotājvārdu un spiediet add", $message2 = "")
    {

        $team = Team::where('id', $id)->first();

        // cehck if you are the coach or organization leader
        $name = Auth::user()->name;
        $app_user = AppUser::where('name', $name)->first();

        $organizations = DB::table("organizations")
        ->join("organization_leaders", "organizations.organization_leaders_id", "=", "organization_leaders.id")
        ->where('organizations.id', '=', $team->organizations_id)
        ->select("organization_leaders.app_user_id")
        ->get();
        $organizations = $organizations[0] ?? null;

        $coaches = DB::table("coaches")
        ->join("app_users", "coaches.app_user_id", "=", "app_users.id")
        ->where('coaches.id', '=', $team->coaches_id)
        ->select("coaches.app_user_id", "app_users.name")
        ->get();

        $coaches = $coaches[0] ?? null;

        $team_players = DB::table("team_players")
        ->join("app_users", "team_players.app_users_id", "=", "app_users.id")
        ->where('team_players.teams_id', '=', $team->id)
        ->select("app_users.name", "app_users.id")
        ->get();

        $trainings = DB::table("trainings")
        ->where('team_id', '=', $team->id)
        ->select("start_date_and_time", "id")
        ->get();

        $countTrainingAttend = DB::table("team_player_attendence_trainings")
        ->select(DB::raw("training_id, count(training_id) as bodyCount"))
        ->groupBy('training_id')
        ->get();

        $isCoach = $coaches->app_user_id == $app_user->id;
        $isOrganizationLeader = $organizations->app_user_id == $app_user->id;

        $coach = "";
        $leader = "";

        if ($isCoach) {
            $coach = "Treneris";
        }

        if ($isOrganizationLeader) {
            $leader = ", Organizācijas vadītājs";
        }


        if ($isCoach OR $isOrganizationLeader) {
            return view('edit_team', compact('team', 'coach', 'leader', 'message', 'team_players', 'message2', 'coaches', 'trainings', 'countTrainingAttend'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function destroyTeam($id)
    {
        $name = Auth::user()->name;
        $app_user = AppUser::where('name', $name)->first();
        
        DB::table("coaches")
        ->join("teams", "coaches.id","=","teams.coaches_id")
        ->join("app_users","coaches.app_user_id","=","app_users.id")
        ->where("coaches.app_user_id", "=", $app_user->id)
        ->select("*")->delete()
        ->first();
        
        /*
        $attendance_training = DB::table("team_player_attendance_trainings")
        ->join("trainings","team_player_attendance_trainings.training_id","=","trainings.id")
        ->join("teams","trainings.team_id","=", "teams.id")
        ->where("teams.id","=", $id)
        ->select("*")
        ->get();
        TeamPlayerAttendanceTraining::findOrFail($attendance_training)->each()->delete();

        $trainings = DB::table("trainings")
        ->join("teams","trainings.team_id","=","teams.id")
        ->where("teams.id","=", $id)
        ->select("*")
        ->get();
        Training::findOrFail($trainings)->each()->delete();

        $team_players = DB::table("team_players")
        ->join("teams","team_players.teams_id","=", "teams.id")
        ->where("teams.id", "=", $id)
        ->select("*")
        ->get();
        TeamPlayer::findOrFail($team_players)->each()->delete();

        Team::findOrFail($id)->each()->delete();
        */

        return redirect('myteams/organizations');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyPlayer($id, $team_id)
    {
        TeamPlayer::where('app_users_id', $id)->where('teams_id', $team_id)->first()->delete();
        return redirect()->action(
            [TeamController::class, 'edit'], ['id' => $team_id, 'message' => 'Spēlētājs izdzēsts']
        );
    }

    public function changeCoach(Request $request)
    {
        echo $request->coach_name;
        echo $request->team_id;

        $app_user = AppUser::where('name', $request->coach_name)->first();

        if ($app_user == null) {
            return redirect()->action(
                [TeamController::class, 'edit'], ['id' => $request->team_id, 'message' => ' ', 'message2' => 'Spēlētājs ar šādu lietotājvārdu netika atrasts']
            );
        }


        $coaches = $app_user->coaches()->create();

        $affected = DB::table('teams')
              ->where('id', $request->team_id)
              ->update(['coaches_id' => $coaches->id]);

        return redirect()->action(
            [TeamController::class, 'edit'], ['id' => $request->team_id, 'message' => ' ', 'message2' => 'Treneris nomainīts']
        );
    }
}
