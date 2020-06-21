<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('FirstName')->nullable();
            $table->string('LastName')->nullable();
            $table->string('MiddleName')->nullable();
            $table->string('Gender')->nullable();
            $table->string('BirthDate')->nullable();
            $table->string('HomeAddress')->nullable();
            $table->string('HomeCity')->nullable();
            $table->string('HomeState')->nullable();
            $table->string('HomeCountry')->nullable();
            $table->string('HomeZip')->nullable();
            $table->string('WorkAddress')->nullable();
            $table->string('WorkCity')->nullable();
            $table->string('WorkState')->nullable();
            $table->string('WorkCountry')->nullable();
            $table->string('WorkZip')->nullable();
            $table->string('ShippingAddress')->nullable();
            $table->string('ShippingCity')->nullable();
            $table->string('ShippingState')->nullable();
            $table->string('ShippingCountry')->nullable();
            $table->string('ShippingZip')->nullable();
            $table->string('BillingAddress')->nullable();
            $table->string('BillingCity')->nullable();
            $table->string('BillingState')->nullable();
            $table->string('BillingCountry')->nullable();
            $table->string('BillingZip')->nullable();
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
        Schema::dropIfExists('customers');
    }
}
