<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAccountsTable extends Migration
{
    public function up()
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->unsignedBigInteger('agency_id')->nullable();
            $table->foreign('agency_id', 'agency_fk_4696927')->references('id')->on('agencies');
        });
    }
}
