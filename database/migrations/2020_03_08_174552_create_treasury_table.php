<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTreasuryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treasury', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('business_partner_id');
            $table->unsignedBigInteger('bank_id');
            $table->char('type', 1);
            $table->decimal('amount', 14, 2);
            $table->timestamps();
            $table->boolean('status');
            $table->foreign('user_id')
                ->references('id')
                ->on('user')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->foreign('business_partner_id')
                ->references('id')
                ->on('business_partner')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->foreign('bank_id')
                ->references('id')
                ->on('bank')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('treasury');
    }
}
