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
        Schema::create('meeting_management_audit_trials', function (Blueprint $table) {
            $table->id();
            $table->string('meetingmanagemengt_id')->nullable();
            $table->string('meetingmanagement_id')->nullable();
            $table->string('activity_type')->nullable();
            $table->longText('previous')->nullable();
            $table->string('stage')->nullable();
            $table->longText('current')->nullable();
            $table->longText('comment')->nullable();
            $table->string('user_id')->nullable();
            $table->string('action_name')->nullable();
            $table->string('action')->nullable();
            $table->string('user_name')->nullable();
            $table->string('user_role')->nullable();
            $table->string('origin_state')->nullable();
            $table->string('change_to')->nullable();
            $table->string('change_from')->nullable();
            $table->string('Submitted_comment')->nullable();
            $table->string('completed_comment')->nullable();
            $table->string('comments')->nullable();

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
        Schema::dropIfExists('meeting_management_audit_trials');
    }
};
