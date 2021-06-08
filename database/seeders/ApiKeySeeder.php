<?php

namespace Database\Seeders;

use App\Models\ApiKey;
use Illuminate\Database\Seeder;

class ApiKeySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $apikey = array(
            array(
                'id'=>'1',
                'key'=>'4NuJA4fhUf6V1ED0ENVm',
                'related'=>'Website',
                'status'=>1,
            ),
            array(
                'id'=>'2',
                'key'=>'8YgHA4fhUf6V1ED0EJkn',
                'related'=>'MobileApp',
                'status'=>1,
            )
        );

        ApiKey::insert($apikey);
    }
}
