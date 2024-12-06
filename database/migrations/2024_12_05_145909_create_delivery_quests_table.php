

public function up()
{
    Schema::table('delivery_quests', function (Blueprint $table) {
        $table->string('pickup_location');
        $table->string('dropoff_location');
    });
}

public function down()
{
    Schema::table('delivery_quests', function (Blueprint $table) {
        $table->dropColumn(['pickup_location', 'dropoff_location']);
    });
}