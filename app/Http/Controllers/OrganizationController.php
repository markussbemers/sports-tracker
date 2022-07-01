<?php

namespace App\Http\Controllers;
use App\Models\SportsType;
use App\Models\AppUser;
use App\Models\Organization;
use App\Models\OrganizationLeader;
use App\Models\Team;
use App\Models\Training;
use App\Models\Coach;
use App\Models\TeamPlayerAttendanceTraining;
use App\Models\TeamPlayer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $name = Auth::user()->name;
        $app_user = AppUser::where('name', $name)->first();

        $organizations = DB::table("organizations")
        ->join("organization_leaders", "organizations.organization_leaders_id", "=", "organization_leaders.id")
        ->where('organization_leaders.app_user_id', $app_user->id)
        ->select("organizations.id", "organizations.name")
        ->get();
        
        return view('organizations',  compact('organizations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sportsTypes = SportsType::all();
        return view('create_organization', compact('sportsTypes'));
    }

    // public function getSportsTypesforOrganization()
    // {
    //     $sportsTypes = SportsType::all();
    //     return view('create_organization', compact('sportsTypes'));
    // }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $rules = array(
            'name' => 'required|string|min:2|max:60|unique:organizations',
        );        
        $this->validate($request, $rules);

        $name = Auth::user()->name;
        $app_user = AppUser::where('name', $name)->first();
        $organization_leaders = $app_user->organization_leaders()->create();

        $organization = new Organization();
        $organization->name = $request->name;
        $organization->organization_leaders_id = $organization_leaders->id;
        $organization->sports_types_id = $request->sports_type_id;

        $organization->save();
        return redirect()->route('create_team');
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
    public function edit($id)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        DB::table("coaches")
        ->join("teams", "coaches.id","=","teams.coaches_id")
        ->join("organizations","teams.organizations_id","=","organizations.id")
        ->where("organizations.id", "=", $id)->delete();

        
        /*
        DB::table("organization_leaders")
        ->join("organizations","organization_leaders.id","=","organizations.organization_leaders_id")
        ->where("organization_leaders.id", "=", $id)->each()->delete();
       
        DB::table("team_player_attendance_trainings")
        ->join("trainings","team_player_attendance_trainings.training_id","=","trainings.id")
        ->join("teams","trainings.team_id","=","teams.id")
        ->join("organizations","teams.organizations_id","=","organizations.id")
        ->where("organizations.id","=", $id)->each()->delete();
        
        DB::table("trainings")
        ->join("teams","trainings.team_id","=","teams.id")
        ->join("organizations","teams.organizations_id","=","organizations.id")
        ->where("organizations.id","=", $id)->each()->delete();
        
        DB::table("team_players")
        ->join("teams","team_players.teams_id","=", "teams.id")
        ->join("organizations","teams.organizations_id","=","organizations.id")
        ->where("organizations.id","=", $id)->each()->delete();
        
        $team_id = DB::table("teams")
        ->join("organizations","teams.organizations_id","=","organizations.id")
        ->where("organizations.id","=", $id)->each()->delete();
        
        Organization::findOrFail($id)->delete();
        */
        return redirect('organizations');

    }
}
