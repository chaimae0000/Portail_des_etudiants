<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateMessagesTableAddSenderReceiver extends Migration
{
    public function up()
    {
        Schema::table('messages', function (Blueprint $table) {
            if (Schema::hasColumn('messages', 'user_id')) {
                $table->dropForeign(['user_id']); // si une FK existe
                $table->dropColumn('user_id');
            }

            if (Schema::hasColumn('messages', 'subject')) {
                $table->dropColumn('subject');
            }

            // Ajout des colonnes sender_id et receiver_id si elles n'existent pas déjà
            if (!Schema::hasColumn('messages', 'sender_id')) {
                $table->unsignedBigInteger('sender_id')->after('id');
                $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');
            }

            if (!Schema::hasColumn('messages', 'receiver_id')) {
                $table->unsignedBigInteger('receiver_id')->after('sender_id');
                $table->foreign('receiver_id')->references('id')->on('users')->onDelete('cascade');
            }
        });
    }

    public function down()
    {
        Schema::table('messages', function (Blueprint $table) {
            if (Schema::hasColumn('messages', 'sender_id')) {
                $table->dropForeign(['sender_id']);
                $table->dropColumn('sender_id');
            }

            if (Schema::hasColumn('messages', 'receiver_id')) {
                $table->dropForeign(['receiver_id']);
                $table->dropColumn('receiver_id');
            }

            if (!Schema::hasColumn('messages', 'user_id')) {
                $table->unsignedBigInteger('user_id')->after('id');
                // Remets la FK si besoin
            }

            if (!Schema::hasColumn('messages', 'subject')) {
                $table->string('subject')->nullable()->after('user_id');
            }
        });
    }
}
