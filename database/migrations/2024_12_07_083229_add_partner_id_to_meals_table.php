<?php

// database/migrations/xxxx_xx_xx_xxxxxx_add_partner_id_to_meals_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPartnerIdToMealsTable extends Migration
{
    public function up()
    {
        Schema::table('meals', function (Blueprint $table) {
            $table->unsignedBigInteger('partner_id')->after('id');
            $table->foreign('partner_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('meals', function (Blueprint $table) {
            $table->dropForeign(['partner_id']);
            $table->dropColumn('partner_id');
        });
    }
}
