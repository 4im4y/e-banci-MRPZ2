<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('membership_number')->unique();

            //Personal Information
            $table->string('ic_number', 12)->unique();
            $table->string('full_name');
            $table->date('date_of_birth');
            $table->enum('gender', [
                'male',
                'female'
            ]);
            $table->enum('marital_status', [
                'single',
                'married',
                'divorced',
                'widowed'
            ])->nullable();

            //Contact Information
            $table->string('phone_number', 15);
            $table->string('email')->nullable();

            //Address Information
            $table->text('address')->nullable();
            $table->string('postcode', 10)->nullable();
            $table->string('city')->nullable();
            $table->string('state')->default('Kelantan');

            //Occupation Information
            $table->string('occupation')->nullable();
            $table->enum('education_level', [
                'no_formal_education',
                'primary',
                'secondary',
                'diploma',
                'degree',
                'master',
                'phd'
            ])->nullable();

            // Additional Information
            $table->text('notes')->nullable();
            $table->boolean('is_active')->default(true);
            $table->date('registration_date')->default(now());
            
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
        Schema::dropIfExists('members');
    }
}
