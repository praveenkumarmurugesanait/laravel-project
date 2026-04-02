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
    Schema::table('profiles', function (Blueprint $table) {
        $table->renameColumn('city', 'city_name'); // rename
    });

    Schema::table('profiles', function (Blueprint $table) {
        $table->text('address')->change(); // change datatype
        $table->string('state')->after('city_name'); // add column
    });
}

public function down()
{
    Schema::table('profiles', function (Blueprint $table) {
        $table->renameColumn('city_name', 'city');
        $table->string('address')->change();
        $table->dropColumn('state');
    });
}
};
