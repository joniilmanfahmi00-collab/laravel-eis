<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EisScore;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

class EisController extends Controller
{
    // LENGKAH 1: Nampilkeun form input Aset
    public function stepOne()
    {
        return view('eis.step-one');
    }

    // LENGKAH 1 (POST): Nyimpen data Aset kana Session
    public function postStepOne(Request $request)
    {
        $validated = $request->validate([
            'current_assets' => 'required|numeric|min:0',
            'total_assets' => 'required|numeric|min:0',
        ]);

        $request->session()->put('eis_data', $validated);

        return redirect()->route('eis.stepTwo');
    }

    // LENGKAH 2: Nampilkeun form input Kewajiban & Pendapatan
    public function stepTwo(Request $request)
    {
        if (!$request->session()->has('eis_data')) {
            return redirect()->route('eis.stepOne');
        }
        return view('eis.step-two');
    }

    // LENGKAH 2 (POST) & KALKULASI: Nyimpen data, ngitung skor, nyimpen ka DB
    public function postStepTwo(Request $request)
    {
        $validated = $request->validate([
            'current_liabilities' => 'required|numeric|min:0',
            'total_liabilities' => 'required|numeric|min:0',
            'total_revenue' => 'required|numeric|min:0',
            'total_operating_expenses' => 'required|numeric|min:0',
        ]);

        // Gabungkeun data ti Step 1 sareng Step 2
        $eisData = array_merge($request->session()->get('eis_data'), $validated);

        // --- PROSES KALKULASI RASIO ---
        
        // 1. Liquidity Ratio (Aset Lancar / Kewajiban Lancar)
        // Ngahindarkeun division by zero
        $liquidity = $eisData['current_liabilities'] > 0 
            ? $eisData['current_assets'] / $eisData['current_liabilities'] 
            : 0;

        // 2. Solvency Ratio (Total Kewajiban / Total Aset)
        $solvency = $eisData['total_assets'] > 0 
            ? $eisData['total_liabilities'] / $eisData['total_assets'] 
            : 0;

        // 3. Operating Margin ((Pendapatan - Beban) / Pendapatan)
        $operatingMargin = $eisData['total_revenue'] > 0 
            ? (($eisData['total_revenue'] - $eisData['total_operating_expenses']) / $eisData['total_revenue']) * 100 
            : 0;

        // --- PROSES SCORING (0-100 per rasio) ---
        $scoreLiquidity = $this->calculateLiquidityScore($liquidity);
        $scoreSolvency = $this->calculateSolvencyScore($solvency);
        $scoreMargin = $this->calculateMarginScore($operatingMargin);

        // --- SKOR AKHIR (Bobot: Liquidity 40%, Solvency 30%, Margin 30%) ---
        $finalScore = ($scoreLiquidity * 0.40) + ($scoreSolvency * 0.30) + ($scoreMargin * 0.30);
        
        // Nangtukeun Status Kaséhatan
        $healthStatus = 'Critical / High Risk';
        if ($finalScore >= 80) {
            $healthStatus = 'Excellent Financial Health';
        } elseif ($finalScore >= 60) {
            $healthStatus = 'Adequate / Needs Monitoring';
        }

        // --- NYIMPEN KA DATABASE ---
        $uuid = Str::uuid()->toString();
        
        EisScore::create([
            'reference_code' => $uuid,
            'current_assets' => $eisData['current_assets'],
            'total_assets' => $eisData['total_assets'],
            'current_liabilities' => $validated['current_liabilities'],
            'total_liabilities' => $validated['total_liabilities'],
            'total_revenue' => $validated['total_revenue'],
            'total_operating_expenses' => $validated['total_operating_expenses'],
            'liquidity_ratio' => $liquidity,
            'solvency_ratio' => $solvency,
            'operating_margin' => $operatingMargin,
            'final_score' => $finalScore,
            'health_status' => $healthStatus,
        ]);

        // Hapus session margi parantos réngsé
        $request->session()->forget('eis_data');

        // Alihkeun ka halaman Result
        return redirect()->route('eis.result', ['uuid' => $uuid]);
    }

    // Nampilkeun Halaman Result
    public function showResult($uuid)
    {
        // Milari data dumasar UUID, pami teu aya otomatis 404
        $result = EisScore::where('reference_code', $uuid)->firstOrFail();
        
        return view('eis.result', compact('result'));
    }
	
	// Nyiapkeun sareng Ngunduh PDF
    public function downloadPdf($uuid)
    {
        $result = EisScore::where('reference_code', $uuid)->firstOrFail();
        
        // Load view khusus kanggo PDF
        $pdf = Pdf::loadView('eis.pdf', compact('result'));
        
        // Atur ukuran kertas (opsional, standar A4)
        $pdf->setPaper('A4', 'portrait');
        
        // Eksekusi download dengan nama file yang rapih
        return $pdf->download('EIS_Report_' . $result->reference_code . '.pdf');
    }

    // --- FUNGSI BANTUAN KANGGO SKORING ---
    private function calculateLiquidityScore($ratio) {
        if ($ratio >= 2.0) return 100;
        if ($ratio >= 1.0) return 75;
        return 40;
    }

    private function calculateSolvencyScore($ratio) {
        if ($ratio <= 0.4) return 100;
        if ($ratio <= 0.6) return 75;
        return 40;
    }

    private function calculateMarginScore($margin) {
        if ($margin >= 10) return 100;
        if ($margin > 0) return 75;
        return 40;
    }
}