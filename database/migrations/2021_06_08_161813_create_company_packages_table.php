<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_packages', function (Blueprint $table) {
            $table->increments ( 'id' )->index();
            $table->integer( 'package_id')->index();
            $table->integer( 'company_id' )->unique()->index();
            $table->dateTime ( 'start_date' )->index();
            $table->dateTime ( 'end_date' )->index();
            $table->string ( 'cycle' ,50)->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_packages');
    }
}
