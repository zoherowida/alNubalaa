<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('clientName');
            $table->string('companyName');
            $table->integer('subCategory');
            $table->integer('city');
            $table->string('location');
            $table->string('phoneNumber');
            $table->string('phoneCompany')->nullable();
            $table->string('latLong');
            $table->integer('AddBy');
            $table->timestamps();
                            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
