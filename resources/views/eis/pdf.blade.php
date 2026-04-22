<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>EIS Report - {{ $result->reference_code }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; color: #333; }
        .header { text-align: center; border-bottom: 2px solid #333; padding-bottom: 10px; margin-bottom: 20px; }
        .title { font-size: 24px; font-weight: bold; margin: 0; }
        .ref-code { font-size: 12px; color: #777; }
        .score-box { text-align: center; margin-bottom: 30px; padding: 20px; background-color: #f8f9fa; border: 1px solid #ddd; }
        .final-score { font-size: 48px; font-weight: bold; margin: 10px 0; }
        
        /* Warna dumasar kana skor */
        .text-success { color: #198754; }
        .text-warning { color: #ffc107; }
        .text-danger { color: #dc3545; }

        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #f4f4f4; }
    </style>
</head>
<body>

    <div class="header">
        <p class="title">Macro Accrual Financial Health Report</p>
        <p class="ref-code">Reference Code: {{ $result->reference_code }}</p>
        <p class="ref-code">Date Generated: {{ $result->created_at->format('Y-m-d H:i') }}</p>
    </div>

    @php
        $scoreColor = 'text-danger';
        if($result->final_score >= 80) $scoreColor = 'text-success';
        elseif($result->final_score >= 60) $scoreColor = 'text-warning';
    @endphp

    <div class="score-box">
        <p>Overall EIS Score</p>
        <p class="final-score {{ $scoreColor }}">{{ number_format($result->final_score, 2) }}</p>
        <h3 class="{{ $scoreColor }}">{{ $result->health_status }}</h3>
    </div>

    <table>
        <tr>
            <th colspan="2">Key Performance Indicators (KPIs)</th>
        </tr>
        <tr>
            <td width="50%">Liquidity Ratio</td>
            <td width="50%"><strong>{{ number_format($result->liquidity_ratio, 2) }}</strong></td>
        </tr>
        <tr>
            <td>Solvency Ratio</td>
            <td><strong>{{ number_format($result->solvency_ratio, 2) }}</strong></td>
        </tr>
        <tr>
            <td>Operating Margin</td>
            <td><strong>{{ number_format($result->operating_margin, 2) }}%</strong></td>
        </tr>
    </table>

    <table>
        <tr>
            <th colspan="2">Financial Data Breakdown (USD)</th>
        </tr>
        <tr>
            <td width="50%">Current Assets</td>
            <td width="50%">{{ number_format($result->current_assets, 2) }}</td>
        </tr>
        <tr>
            <td>Total Assets</td>
            <td>{{ number_format($result->total_assets, 2) }}</td>
        </tr>
        <tr>
            <td>Current Liabilities</td>
            <td>{{ number_format($result->current_liabilities, 2) }}</td>
        </tr>
        <tr>
            <td>Total Liabilities</td>
            <td>{{ number_format($result->total_liabilities, 2) }}</td>
        </tr>
        <tr>
            <td>Total Revenue</td>
            <td>{{ number_format($result->total_revenue, 2) }}</td>
        </tr>
        <tr>
            <td>Total Operating Expenses</td>
            <td>{{ number_format($result->total_operating_expenses, 2) }}</td>
        </tr>
    </table>

    <p style="text-align: center; font-size: 10px; color: #999; margin-top: 50px;">
        This report is generated automatically by EIS Analyzer System.
    </p>

</body>
</html>