<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProfileAndCustomerIdToInvitationsTable extends Migration
{
    public function up()
    {
        Schema::table('invitations', function (Blueprint $table) {
            $table->string('profile')->nullable()->after('expires_at');
            $table->unsignedBigInteger('customer_id')->nullable()->after('profile');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('invitations', function (Blueprint $table) {
            $table->dropForeign(['customer_id']);
            $table->dropColumn(['profile', 'customer_id']);
        });
    }
}
