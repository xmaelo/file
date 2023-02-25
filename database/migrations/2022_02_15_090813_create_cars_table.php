<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->text('brand');
            $table->text('model');
            $table->text('type')->nullable();
            $table->text('body_type');
            $table->text('doors');
            $table->date('first_registration');
            $table->integer('reg_year');
            $table->integer('milage')->nullable();
            $table->text('exterior_color');
            $table->text('exterior_finish');
            $table->text('interior_color');
            $table->text('interior_finish');
            $table->text('special_equipments')->nullable();
            $table->text('serial_equipments')->nullable();
            $table->text('wheel_drive');
            $table->text('gear');
            $table->text('fuel');
            $table->text('displacement');
            $table->text('performance_hp');
            $table->text('performance_kw');
            $table->text('seats')->nullable();
            $table->text('frame_number')->nullable();
            $table->text('model_number')->nullable();
            $table->text('vehicle_number')->nullable();
            $table->text('register_number')->nullable();
            $table->text('direct_import')->nullable();
            $table->text('additional_info')->nullable();
            $table->text('factory_price')->nullable();
            $table->text('general_conditions')->nullable();
            $table->text('registration_document');
            $table->text('service_record_booklet');
            $table->text('inspection')->nullable();
            $table->text('repairs');
            $table->text('service_record_digital');
            $table->text('keys');
            $table->text('mechanics')->nullable();
            $table->text('body')->nullable();
            $table->text('car_finish')->nullable();
            $table->text('others')->nullable();
            $table->text('documents')->nullable();
            $table->text('images')->nullable();
            $table->integer('min_price');
            $table->text('location');
            $table->text('status');
            $table->text('bidder_id')->nullable();
            $table->text('slug');
            $table->text('u_id');
            $table->text('p_id')->nullable();
            $table->boolean('is_paid')->default(false);
            $table->integer('max_bid')->nullable();
            $table->dateTime('end_auction')->nullable();
            $table->boolean('is_in_auction')->default(false);
            $table->boolean('charged_publishing_price')->default(false);
            $table->text('ref_number')->nullable();
            $table->text('auction')->nullable();
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
        Schema::dropIfExists('cars');
    }
};
