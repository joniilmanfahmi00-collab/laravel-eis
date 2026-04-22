@extends('eis.app')
@section('title', 'Your EIS Score Result')

@section('content')
<div class="card shadow border-0">
    <div class="card-header bg-dark text-white text-center py-3">
        <h4 class="mb-0">Financial Health Analysis Result</h4>
        <small class="text-light">Ref: {{ $result->reference_code }}</small>
    </div>
    
    <div class="card-body text-center p-5">
        <h5 class="text-muted mb-3">Overall EIS Score</h5>
        
        @php
            $scoreColor = 'text-danger'; // Default Beureum
            if($result->final_score >= 80) $scoreColor = 'text-success'; // Héjo
            elseif($result->final_score >= 60) $scoreColor = 'text-warning'; // Konéng
        @endphp

        <h1 class="display-1 fw-bold {{ $scoreColor }}">
            {{ number_format($result->final_score, 2) }}
        </h1>
        
        <h3 class="mb-4 {{ $scoreColor }}">{{ $result->health_status }}</h3>

        <div class="row text-start mt-5">
            <div class="col-md-4 mb-3">
                <div class="p-3 border rounded bg-light">
                    <small class="text-muted d-block">Liquidity Ratio</small>
                    <span class="fs-5 fw-bold">{{ number_format($result->liquidity_ratio, 2) }}</span>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="p-3 border rounded bg-light">
                    <small class="text-muted d-block">Solvency Ratio</small>
                    <span class="fs-5 fw-bold">{{ number_format($result->solvency_ratio, 2) }}</span>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="p-3 border rounded bg-light">
                    <small class="text-muted d-block">Operating Margin</small>
                    <span class="fs-5 fw-bold">{{ number_format($result->operating_margin, 2) }}%</span>
                </div>
            </div>
        </div>

        <hr class="my-4">
		
		<div class="card mt-4 border-primary text-start shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="bi bi-file-earmark-text"></i> Executive Summary Letter</h5>
                <button class="btn btn-sm btn-light fw-bold" onclick="copyLetter()">Copy Text</button>
            </div>
            <div class="card-body bg-light">
                <div id="generatedLetter" class="p-4" style="font-family: 'Times New Roman', Times, serif; font-size: 16px; background: #fff; border: 1px solid #ccc;">
                    <p><strong>Date:</strong> {{ date('F j, Y') }}</p>
                    <p><strong>To:</strong> Board of Directors / Stakeholders</p>
                    <p><strong>Subject:</strong> Executive Financial Health Assessment (Ref: {{ $result->reference_code }})</p>

                    <p>Dear Members of the Board,</p>

                    <p>This letter presents the automated Executive Information System (EIS) analysis based on the latest macro accrual financial data. The entity has achieved an overall Financial Health Score of <strong>{{ number_format($result->final_score, 2) }}/100</strong>, classifying its current status as <strong>"{{ $result->health_status }}"</strong>.</p>

                    <p><strong>Key Performance Indicators (KPI) Breakdown:</strong></p>
                    <ul>
                        <li><strong>Liquidity Ratio ({{ number_format($result->liquidity_ratio, 2) }}):</strong> 
                            @if($result->liquidity_ratio >= 2) 
                                The entity has a strong ability to cover its short-term obligations, indicating excellent short-term financial stability.
                            @elseif($result->liquidity_ratio >= 1) 
                                The entity can cover short-term debts, but liquidity levels should be monitored to avoid future cash flow bottlenecks.
                            @else 
                                The entity is facing significant liquidity risks and may struggle to fulfill immediate short-term obligations.
                            @endif
                        </li>
                        <li><strong>Solvency Ratio ({{ number_format($result->solvency_ratio, 2) }}):</strong>
                            @if($result->solvency_ratio <= 0.4) 
                                The debt burden is remarkably low, indicating a highly solvent and low-risk capital structure.
                            @elseif($result->solvency_ratio <= 0.6) 
                                The debt level is moderate and generally within manageable limits for sustained operations.
                            @else 
                                The entity is highly leveraged, posing a substantial long-term solvency risk that requires strategic restructuring.
                            @endif
                        </li>
                        <li><strong>Operating Margin ({{ number_format($result->operating_margin, 2) }}%):</strong>
                            @if($result->operating_margin >= 10) 
                                Operations are highly profitable, generating a sustainable surplus for future investments.
                            @elseif($result->operating_margin > 0) 
                                Operations are yielding a marginal surplus, indicating significant room for cost-efficiency improvements.
                            @else 
                                The entity is currently operating at a deficit, requiring immediate and aggressive cost-control measures.
                            @endif
                        </li>
                    </ul>

                    <p><strong>Strategic Recommendation:</strong></p>
                    <p>
                        @if($result->final_score >= 80)
                            Given the excellent financial posture, we recommend maintaining current strategic operations while actively exploring opportunities for expansion, dividend distribution, or capital investment.
                        @elseif($result->final_score >= 60)
                            While the financial health is adequate, management is strongly advised to optimize operational efficiencies and closely monitor debt levels to prevent any potential downgrade to a critical status.
                        @else
                            Immediate executive action is required. We strongly advise implementing comprehensive corporate restructuring, aggressive cost-cutting, and debt renegotiation to stabilize the entity's financial footing.
                        @endif
                    </p>

                    <p>Sincerely,</p>
                    <p><strong>EIS Analyzer System</strong></p>
                </div>
            </div>
        </div>

        <script>
            function copyLetter() {
                var letterContent = document.getElementById('generatedLetter').innerText;
                navigator.clipboard.writeText(letterContent).then(function() {
                    alert('Executive Summary Letter successfully copied to clipboard!');
                }, function(err) {
                    console.error('Could not copy text: ', err);
                });
            }
        </script>

        <div class="d-grid gap-2 d-md-flex justify-content-md-center mt-4">
            <a href="{{ route('eis.download', $result->reference_code) }}" class="btn btn-danger btn-lg px-4 me-md-2">
				Download PDF Report
			</a>
            <a href="{{ route('eis.stepOne') }}" class="btn btn-outline-primary btn-lg px-4">
                Calculate Another Entity
            </a>
        </div>
    </div>
</div>
@endsection