<?php

namespace Database\Seeders;

use App\Models\Jail;
use App\Models\User;
use App\Models\Ward;
use Illuminate\Database\Seeder;
 
class JailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $wards = Ward::all();
        $wards->each(function($ward){
            Jail::factory()->count(2)->for($ward)->create();
        });

        $users_prisoers = User::where('role_id',4)->get();
        //dd($users_prisoers);
        $jails=Jail::all();

        $jails->each(function($jail) use($users_prisoers){
            $jail->users()->attach($users_prisoers->shift(4));
        });




    }
}
