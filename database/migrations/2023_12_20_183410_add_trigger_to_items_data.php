<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        DB::unprepared('
            CREATE TRIGGER total_cost_Items_updated_insert
            BEFORE INSERT ON items_data
            FOR EACH ROW
            BEGIN
                SET NEW.total_cost = NEW.unity_cost * NEW.quantity;
            END;
        ');

        DB::unprepared('
            CREATE TRIGGER total_cost_Items_updated
            BEFORE UPDATE ON items_data
            FOR EACH ROW
            BEGIN
                SET NEW.total_cost = NEW.unity_cost * NEW.quantity;
            END;
        ');
    }


    public function down()
    {
        DB::unprepared('DROP TRIGGER IF EXISTS total_cost_Items_updated_insert');
        DB::unprepared('DROP TRIGGER IF EXISTS total_cost_Items_updated');
    }
};
