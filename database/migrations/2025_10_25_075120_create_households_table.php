<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHouseholdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('households', function (Blueprint $table) {
            $table->id();
            $table->string('household_number')->unique();
            $table->foreignId('zone_id')->nullable()->constrained()->nullOnDelete();
            $table->text('address');
            $table->string('postcode', 10);
            $table->string('city');
            $table->string('state')->default('Kelantan');
            $table->decimal('monthly_income', 10, 2)->nullable();
            $table->enum('income_range', [
                'below_2000',
                '2000_3999',
                '4000_5999',
                '6000_7999',
                '8000_9999',
                'above_10000'
            ])->nullable();
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('households');
    }
}
