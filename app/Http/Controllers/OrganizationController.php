<?php

namespace App\Http\Controllers;
use App\Models\SportsType;
use App\Models\AppUser;
use App\Models\Organization;
use Illuminate\Support\Facades\Auth;

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
        //
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

        echo $organization_leaders;

        $sportsType = SportsType::where('type', $request->sports_type)->first();

        $organization = new Organization();
        $organization->name = $request->name;
        $organization->organization_leaders_id = $organization_leaders->id;
        $organization->sports_types_id = $sportsType->id;

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
        //
    }
}
