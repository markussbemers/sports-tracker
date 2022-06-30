<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Coach;
use App\Models\Organization;
use App\Models\AppUser;
use Illuminate\Support\Facades\Auth;


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

    public function create()
    {

        $name = Auth::user()->name;
        $app_user = AppUser::where('name', $name)->first();

        $organizations = DB::table("organizations")
        ->join("organization_leaders", "organizations.organization_leaders_id", "=", "organization_leaders.id")
        ->where('organization_leaders.app_user_id', '=', $app_user->id)
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

        $organization = Organization::where("name", $request->organization_name)->first();

        $name = Auth::user()->name;
        $app_user = AppUser::where('name', $name)->first();
        $coaches = $app_user->coaches()->create();

        $team = new Team();
        $team->name = $request->name;
        $team->organizations_id = $organization->id;
        $team->coaches_id = $coaches->id;
        $team->save();
        return redirect()->route('dashboard');
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
        //
    }
}
