<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserViewLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE VIEW uv_logs AS
                        (
                            SELECT
                            a.id
                            , a.message
                            , a.created_at
                            , a.ip
                            , c.log_type
                            , b.username
                            , a.log_type_id
                            , a.user_id
                            FROM logs a
                            LEFT JOIN users b ON a.user_id = b.id
                            LEFT JOIN log_types c ON a.log_type_id = c.id
                        )");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW uv_logs");
    }
}
