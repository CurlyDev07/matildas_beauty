<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class RemoveHandoverFromJtPancakeVipOrdersWorkflowStage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("UPDATE jt_pancake_vip_orders SET workflow_stage = 'shipped' WHERE workflow_stage = 'handover'");
        DB::statement("ALTER TABLE jt_pancake_vip_orders MODIFY workflow_stage ENUM('sales','production','packing','shipped') NOT NULL DEFAULT 'sales'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE jt_pancake_vip_orders MODIFY workflow_stage ENUM('sales','production','packing','handover','shipped') NOT NULL DEFAULT 'sales'");
    }
}

