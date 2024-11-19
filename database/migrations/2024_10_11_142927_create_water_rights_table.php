<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('water_rights', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('subfile_id')->index();
            $table->bigInteger('surf_zone_id')->index();
            $table->bigInteger('water_right_use_id')->index();
            $table->bigInteger('amount_category_id')->index();
            $table->bigInteger('water_source_id')->index();
            $table->bigInteger('hs_recommendation_id')->index();
            $table->bigInteger('water_right_status_id')->index();
            $table->bigInteger('right_status_id')->index();
            $table->bigInteger('purpose_of_use_category_id')->index();
            $table->bigInteger('specific_purpose_of_use_id')->index();
            $table->bigInteger('detailed_purpose_of_use_id')->index();
            $table->string('hs_recommend', 50)->index();
            $table->char('hs_doc_heading', 1);
            $table->string('purpose_txt');
            $table->string('ose_file', 75);
            $table->double('water_duty');
            $table->text('amount_txt');
            $table->double('div_rt_hl');
            $table->double('cfs');
            $table->double('con_water_use');
            $table->double('surface_area');
            $table->double('depth');
            $table->double('volume');
            $table->string('work_notes', 4000);
            $table->text('hs_pou_notes');
            $table->tinyInteger('no_right')->nullable();
            $table->char('cond', 10);
            $table->double('tot_rt_acr');
            $table->double('cid_rt_acr');
            $table->double('off_rt_acr');
            $table->double('off_nr_acr');
            $table->tinyInteger('rev_hs_acr')->nullable();
            $table->string('ebid_txt');
            $table->bigInteger('map_nbr');
            $table->double('tx_acres');
            $table->double('rt_fdr');
            $table->double('rt_prim_gw');
            $table->decimal('annual_evaporative_loss', 12, 4);
            $table->string('other_amount_restrictions', 20);
            $table->string('offset_indicator', 20);
            $table->bigInteger('accounting_period_duration');
            $table->string('accounting_period_date', 20);
            $table->string('right_description', 64);
            $table->bigInteger('r_id_access');
            $table->timestamp('created_at')->nullable();
            $table->string('created_by', 64);
            $table->timestamp('updated_at')->nullable();
            $table->string('updated_by', 64);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('water_rights');
    }
};
