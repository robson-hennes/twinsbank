<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToIncomesTable extends Migration
{
    public function up()
    {
        Schema::table('incomes', function (Blueprint $table) {
            $table->unsignedBigInteger('income_category_id')->nullable();
            $table->foreign('income_category_id', 'income_category_fk_4696890')->references('id')->on('income_categories');
            $table->unsignedBigInteger('account_id')->nullable();
            $table->foreign('account_id', 'account_fk_4696954')->references('id')->on('accounts');
        });
    }
}
