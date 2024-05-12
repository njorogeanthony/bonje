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
        Schema::create('receipts', function (Blueprint $table) {
            $table->id();
            $table->string('company');
            $table->string('cuserial');
            $table->string('cuin');
            $table->string('seller');
            $table->string('pin');
            $table->integer(column: 'amount', unsigned: true);
            $table->integer(column: 'vat_percentage', unsigned: true);
            $table->date('purchase_date');
            $table->string('image_path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receipts');
    }
};
