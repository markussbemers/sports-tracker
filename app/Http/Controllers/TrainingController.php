<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $username = Auth::user()->name;

        $id = DB::table("app_users")
        ->where('name', '=', $username)
        ->select('id')
        ->first();

        $id = $id->id;

        $trainings = DB::table("trainings")
        ->join("teams", "trainings.team_id", "=", "teams.id")
        ->join("team_players", "teams.id", "=", "team_players.teams_id")
        ->where('team_players.app_users_id', '=', $id)
        ->select('trainings.id', "teams.name", 'trainings.start_date_and_time')
        ->get();

        // echo $trainings;

        $willAttend = DB::table("team_player_attendence_trainings")
        ->where('app_users_id', '=', $id)
        ->get();

        //echo $willAttend;

        return view('mytrainings',  compact('trainings', 'willAttend'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
