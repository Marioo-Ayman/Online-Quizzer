<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('quizzes', function (Blueprint $table) {
            // Add topic_id as a foreign key referencing topics.id
            $table->foreignId('topic_id')->constrained('topics')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quizzes', function (Blueprint $table) {
            // Drop the foreign key and column if we rollback the migration
            $table->dropForeign(['topic_id']);
            $table->dropColumn('topic_id');
        });
    }
};
