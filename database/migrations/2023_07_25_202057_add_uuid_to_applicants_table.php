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
        Schema::table('applicants', function (Blueprint $table) {
            // First, drop the existing primary key constraint on the 'id' column
            $table->dropPrimary('applicants_id_primary');

            // Add the 'uuid' column as the primary key with unique constraint
            $table->uuid('uuid')->primary()->unique()->after('id');

            // If you want to keep the 'id' column (as auto-increment) as well, you can add it like this:
            // $table->bigIncrements('id')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('applicants', function (Blueprint $table) {
            // Drop the primary key constraint on the 'uuid' column
            $table->dropPrimary();

            // Remove the unique constraint on the 'uuid' column
            $table->dropUnique('applicants_uuid_unique');

            // Add the 'id' column as the primary key again
            $table->bigIncrements('id')->change();

            // If you previously added the 'id' column as primary, you can remove it like this:
            // $table->dropColumn('id');
        });
    }
};
