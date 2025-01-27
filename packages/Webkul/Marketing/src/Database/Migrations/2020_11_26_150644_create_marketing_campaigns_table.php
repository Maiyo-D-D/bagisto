<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marketing_campaigns', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('subject');
            $table->boolean('status')->default(0);
            $table->string('type');
            $table->string('mail_to');
            $table->string('spooling')->nullable();
            $table->integer('channel_id')->unsigned()->nullable();
            $table->integer('customer_group_id')->unsigned()->nullable();
            $table->integer('marketing_template_id')->unsigned()->nullable();
            $table->integer('marketing_event_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('channel_id')->references('id')->on('channels')->onDelete('NO ACTION');
            $table->foreign('customer_group_id')->references('id')->on('customer_groups')->onDelete('NO ACTION');
            $table->foreign('marketing_template_id')->references('id')->on('marketing_templates')->onDelete('NO ACTION');
            $table->foreign('marketing_event_id')->references('id')->on('marketing_events')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('marketing_campaigns');
    }
};
