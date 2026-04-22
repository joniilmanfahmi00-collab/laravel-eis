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
        Schema::create('eis_scores', function (Blueprint $table) {
            $table->id();
            $table->uuid('reference_code')->unique(); // Kanggo URL unik PDF/Result
            
            // Input Data Kauangan (Nganggo Decimal kanggo nampung nominal artos nu ageung)
            $table->decimal('current_assets', 15, 2)->default(0);
            $table->decimal('total_assets', 15, 2)->default(0);
            $table->decimal('current_liabilities', 15, 2)->default(0);
            $table->decimal('total_liabilities', 15, 2)->default(0);
            $table->decimal('total_revenue', 15, 2)->default(0);
            $table->decimal('total_operating_expenses', 15, 2)->default(0);

            // Hasil Kalkulasi Rasio (Disimpen supados gampil narik ka PDF)
            $table->decimal('liquidity_ratio', 8, 2)->nullable();
            $table->decimal('solvency_ratio', 8, 2)->nullable();
            $table->decimal('operating_margin', 8, 2)->nullable();
            
            // Hasil Skor Akhir EIS & Status
            $table->decimal('final_score', 5, 2)->nullable(); // Misal: 85.50
            $table->string('health_status')->nullable(); // Excellent, Adequate, atawa Critical
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eis_scores');
    }
};
