<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Car;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('seller_invoices', function (Blueprint $table) {
            $table->foreignIdFor(Car::class)->nullable();
            $table->boolean('paid')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('seller_invoices', function (Blueprint $table) {
            $table->dropColumn('paid');
            $table->dropColumn('car_id');
        });   
    }
};
