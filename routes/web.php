<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EisController;

// Otomatis diarahkeun ka Step 1 pami muka domain utama
Route::get('/', function () {
    return redirect()->route('eis.stepOne');
});

// Route kanggo Léngkah 1 (Input Aset)
Route::get('/eis/step-1', [EisController::class, 'stepOne'])->name('eis.stepOne');
Route::post('/eis/step-1', [EisController::class, 'postStepOne'])->name('eis.postStepOne');

// Route kanggo Léngkah 2 (Input Kewajiban & Pendapatan)
Route::get('/eis/step-2', [EisController::class, 'stepTwo'])->name('eis.stepTwo');
Route::post('/eis/step-2', [EisController::class, 'postStepTwo'])->name('eis.postStepTwo');

// Route kanggo nampilkeun Hasil / Skor
Route::get('/eis/result/{uuid}', [EisController::class, 'showResult'])->name('eis.result');

// Route kanggo Download PDF
Route::get('/eis/download/{uuid}', [EisController::class, 'downloadPdf'])->name('eis.download');