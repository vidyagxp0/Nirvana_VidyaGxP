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
        Schema::create('hypothesis_audit_trials', function (Blueprint $table) {
            $table->id();
            $table->string('hypothesis_id');
            $table->string('activity_type');
            $table->longText('previous')->nullable();
            $table->string('stage')->nullable();
            $table->longText('current')->nullable();
            $table->longText('comment')->nullable();
            $table->string('user_id');
            $table->string('user_name');
            $table->string('origin_state');
            $table->string('user_role');
            $table->string('change_from')->nullable();
            $table->string('change_to')->nullable();
            $table->string('action_name')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('hypothesis_audit_trials');
    }
};