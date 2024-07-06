<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDefaultValueToOrderInFormFieldsTable extends Migration
{
    public function up()
    {
        Schema::table('form_fields', function (Blueprint $table) {
            $table->integer('order')->default(0)->change();
        });
    }

    public function down()
    {
        Schema::table('form_fields', function (Blueprint $table) {
            $table->integer('order')->change();
        });
    }
}