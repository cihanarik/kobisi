<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\CompanyPackage;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Company::all()->isEmpty()) {
            $dummy = Factory::create('en_US');
            for ($i = 0; $i < 100; $i++) {
                $company = Company::create([
                    'site_url' => $dummy->unique()->url,
                    'name' => $dummy->firstName,
                    'lastname' => $dummy->lastName,
                    'company_name' => $dummy->company,
                    'email' => $dummy->unique()->email,
                    'password' => bcrypt($dummy->password(8, 20)),
                    'token' => base64_encode($dummy->unique()->email . "-" . $dummy->unique()->url),
                    'status' => 1
                ]);

                $month = $dummy->numberBetween(1, 12);
                $day = $dummy->numberBetween(1, 29);
                $start_date = Carbon::now()->subMonth($month)->subDay($day);
                $periods = [1,12];
                $rand_keys = array_rand($periods);
                $end_date = Carbon::parse($start_date)->addMonths($periods[$rand_keys]);

                if($periods == 1){
                    $cycle="monthly";
                }else{
                    $cycle="yearly";
                }

                CompanyPackage::create([
                    'package_id' => $dummy->numberBetween(1, 6),
                    'company_id' => $company->id,
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                    'cycle' => $cycle
                ]);

            }
        }
    }
}
