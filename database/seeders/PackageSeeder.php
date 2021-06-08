<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $packages = array(
            array('id' => '1', 'name' => 'NoFee', 'price_month' => '0', 'price_year' => '0'),
            array('id' => '2', 'name' => 'Personal', 'price_month' => '99', 'price_year' => '1010'),
            array('id' => '3', 'name' => 'Plus', 'price_month' => '149', 'price_year' => '1520'),
            array('id' => '4', 'name' => 'Professional', 'price_month' => '249', 'price_year' => '2540'),
            array('id' => '5', 'name' => 'Business', 'price_month' => '349', 'price_year' => '3560'),
            array('id' => '6', 'name' => 'Prime', 'price_month' => '2499', 'price_year' => '25490'),
        );

        Package::insert($packages);

    }
}
