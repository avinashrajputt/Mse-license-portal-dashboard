<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLicensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('licenses', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('business_name'); // Name of the business
            $table->string('license_number')->unique(); // Unique license number
            $table->date('issue_date'); // Date of issue
            $table->date('expiry_date'); // Expiry date
            $table->string('status')->default('active'); // Status (e.g., active, expired)
            $table->string('owner_name'); // Owner's name
            $table->string('email')->nullable(); // Owner's email
            $table->string('phone')->nullable(); // Owner's phone number
            $table->timestamps(); // Created at and updated at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('licenses');
    }
}