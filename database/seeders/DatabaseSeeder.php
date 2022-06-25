<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\AppUser;
use App\Models\SportsType;
use App\Models\Organization;
use App\Models\OrganizationLeader;
use App\Models\Team;
use App\Models\TeamPlayer;
use App\Models\Training;
use App\Models\TeamPlayerAttendenceTraining;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // create app users
        $app_user = AppUser::create(['name' => 'Kristaps Ašais']);
        $app_user = AppUser::create(['name' => 'Reinis Rubenis']);
        $app_user = AppUser::create(['name' => 'Zane Lase']);
        $app_user = AppUser::create(['name' => 'Jana Kviese']);

        // create coaches
        $app_user = AppUser::where('name', 'Reinis Rubenis')->first(); 
        $app_user->coaches()->create();

        $app_user = AppUser::where('name', 'Kristaps Ašais')->first(); 
        $app_user->coaches()->create();
        
        // create organization leaders
        $app_user->organization_leaders()->create();

        $app_user = AppUser::where('name', 'Zane Lase')->first();
        $app_user->organization_leaders()->create();

        // create sports types
        $sports_type = SportsType::create(['type' => 'Basketbols']);
        $sports_type = SportsType::create(['type' => 'Futbols']);
        $sports_type = SportsType::create(['type' => 'Regbijs']);
        $sports_type = SportsType::create(['type' => 'Hokejs']);

        // create organizations
        $organization = new Organization();
        $organization->name = 'Miesnieki';
        $sports_type = SportsType::where('type', 'Regbijs')->first();
        $organization->sports_types()->associate($sports_type);
        $app_user = AppUser::where('name', 'Kristaps Ašais')->first();
        $organization_leader = $app_user->organization_leaders()->first();
        $organization->organization_leaders()->associate($organization_leader);
        $organization->save();

        $organization = new Organization();
        $organization->name = 'BS Rīga';
        $sports_type = SportsType::where('type', 'Basketbols')->first();
        $organization->sports_types()->associate($sports_type);
        $app_user = AppUser::where('name', 'Zane Lase')->first();
        $organization_leader = $app_user->organization_leaders()->first();
        $organization->organization_leaders()->associate($organization_leader);
        $organization->save();

        // create teams
        $team = new Team();
        $team->name = 'BS Rīga';
        $organization = Organization::where('name', 'BS Rīga')->first();
        $team->organizations()->associate($organization);
        $app_user = AppUser::where('name', 'Kristaps Ašais')->first();
        $coach = $app_user->coaches()->first();
        $team->coaches()->associate($app_user);
        $team->save();

        $team = new Team();
        $team->name = 'BS Rīga U-18';
        $organization = Organization::where('name', 'BS Rīga')->first();
        $team->organizations()->associate($organization);
        $app_user = AppUser::where('name', 'Reinis Rubenis')->first();
        $coach = $app_user->coaches()->first();
        $team->coaches()->associate($app_user);
        $team->save();

        // create team players
        $team = Team::where('name', 'BS Rīga')->first();

        $team_player = new TeamPlayer();
        $team_player->is_default_attending = false;
        $app_user = AppUser::where('name', 'Zane Lase')->first();
        $team_player->app_users()->associate($app_user);
        $team_player->teams()->associate($team);
        $team_player->save();

        $team_player = new TeamPlayer();
        $team_player->is_default_attending = true;
        $app_user = AppUser::where('name', 'Jana Kviese')->first();
        $team_player->app_users()->associate($app_user);
        $team_player->teams()->associate($team);
        $team_player->save();
    
        // create trainigs
        $team->training()->create(['start_date_and_time' => '2022-07-21 15:00:00']);
        $team->training()->create(['start_date_and_time' => '2022-07-23 15:00:00']);
        $team->training()->create(['start_date_and_time' => '2022-07-28 15:00:00']);

        // create team player attendence training
        // when a new team training created we need to automatically check for team player that have set their attendence default to true, and automaitcally insert them into this table 
        $team_player_attendence_training = new TeamPlayerAttendenceTraining();
        $app_user = AppUser::where('name', 'Zane Lase')->first(); // + TODO should we check if person is in the team?
        $team_player_attendence_training->app_users()->associate($app_user);
        $training = Training::where('start_date_and_time', '2022-07-21 15:00:00')->first();
        $team_player_attendence_training->training()->associate($training);
        $team_player_attendence_training->save();

        $team_player_attendence_training = new TeamPlayerAttendenceTraining();
        $app_user = AppUser::where('name', 'Jana Kviese')->first(); // + TODO should we check if person is in the team?
        $team_player_attendence_training->app_users()->associate($app_user);
        $training = Training::where('start_date_and_time', '2022-07-21 15:00:00')->first();
        $team_player_attendence_training->training()->associate($training);
        $team_player_attendence_training->save();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
