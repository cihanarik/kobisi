<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments ( 'id' )->index();
            $table->longText( 'site_url');
            $table->string( 'name',100 )->index();
            $table->string ( 'lastname',100 )->index();
            $table->longText ( 'company_name' );
            $table->string ( 'email',250 )->unique();
            $table->longText ( 'password');
            $table->longText ( 'token' );
            $table->integer ( 'status' )->index();
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
        Schema::dropIfExists('companies');
    }
}
