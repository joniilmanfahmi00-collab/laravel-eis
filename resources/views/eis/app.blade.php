<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Free Macro Accrual EIS Calculator (No Login Required) - @yield('title')</title>
    <meta name="description" content="Analyze your entity's financial health using the FREE International Standard Macro Accrual EIS Calculator without login & subscription required. Get instant liquidity, solvency, and operating margin reports.">
    <meta property="og:title" content="Macro Accrual EIS Calculator - @yield('title')">
    <meta property="og:description" content="Free financial health analyzer tool for corporate entities.">
    <meta property="og:type" content="website">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-brand i { margin-right: 8px; }
        .card { border-radius: 12px; overflow: hidden; }
        .btn-lg { border-radius: 8px; font-weight: 600; }
        .form-label { font-weight: 600; color: #495057; }
        .form-control:focus { border-color: #0d6efd; box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15); }
        footer { border-top: 4px solid #0d6efd; }
    </style>
    <!-- Schema Markup: Web -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebApplication",
      "name": "Macro Accrual EIS Calculator",
      "description": "A free Executive Information System tool to analyze financial health, liquidity, solvency, and operating margins without login.",
      "applicationCategory": "FinanceApplication",
      "operatingSystem": "Any",
      "offers": {
        "@type": "Offer",
        "price": "0",
        "priceCurrency": "USD"
      },
      "featureList": [
        "Liquidity Ratio Analysis",
        "Solvency Ratio Analysis",
        "Operating Margin Tracking",
        "Executive Summary Generation",
        "PDF Report Export"
      ]
    }
    </script> 
</head>
<body class="bg-light">
    <!-- Sticky Header -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('eis.stepOne') }}">
                <i class="bi bi-graph-up-arrow"></i> PRENEUR SPACE
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('step-one') ? 'active' : '' }}" href="{{ route('eis.stepOne') }}">New Analysis</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="alert('Macro Accrual EIS v1.0 - Standard Financial Reporting Compliance')">About System</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- Main Content -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="text-center mb-4">
                    <h2>Financial Health Analyzer</h2>
                    <p class="text-muted">International Standard Macro Accrual EIS</p>
                </div>
                
                @yield('content')

                <!-- Penjelasan Tools, Fitur, Disclaimer/Klarifikasi & Cara Penggunaan (background kontainer abu text hitam text justify) -->
                <div class="bg-light p-4 rounded shadow-sm mt-5 text-dark">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="fw-bold"><i class="bi bi-info-circle-fill text-primary"></i> About This Tool</h5>
                            <p class="small text-justify">
                                The <strong>Macro Accrual EIS Analyzer</strong> is a specialized Executive Information System designed to evaluate the financial health of an entity using standardized accrual accounting metrics. It processes raw financial data to generate high-level insights for stakeholders and board members.
                            </p>
                        </div>
                        <div class="col-md-6">
                            <h5 class="fw-bold"><i class="bi bi-gear-fill text-primary"></i> Key Features</h5>
                            <ul class="small ps-3">
                                <li>Automated Liquidity & Solvency Analysis</li>
                                <li>Operating Margin Performance Tracking</li>
                                <li>Instant Executive Summary Generation</li>
                                <li>PDF Report Export for Documentation</li>
                            </ul>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="fw-bold"><i class="bi bi-journal-text text-primary"></i> How to Use</h5>
                            <ol class="small">
                                <li><strong>Step 1:</strong> Enter your Current and Total Assets to determine asset liquidity.</li>
                                <li><strong>Step 2:</strong> Input Liabilities and Operational Revenue/Expenses for debt and margin analysis.</li>
                                <li><strong>Result:</strong> Review your EIS Score, download the PDF, or copy the generated Executive Letter.</li>
                            </ol>
                            <div class="alert alert-warning py-2 mt-3 mb-0" style="font-size: 0.85rem;">
                                <strong>Disclaimer:</strong> This system provides automated analysis based on user-provided data. It is intended for informational purposes and should be verified by certified financial auditors for official regulatory compliance.
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <!-- Sticky Footer -->
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container text-center">
            <div class="row">
                <div class="col-md-4 mb-3 mb-md-0">
                    <h6 class="text-uppercase fw-bold">EIS Analyzer</h6>
                    <p class="small text-gray-300">Providing high-level financial insights through macro accrual analysis and standardized KPI reporting.</p>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                    <h6 class="text-uppercase fw-bold">Compliance</h6>
                    <p class="small text-gray-300">Aligned with International Financial Reporting Standards (IFRS) for automated executive summaries.</p>
                </div>
                <div class="col-md-4">
                    <h6 class="text-uppercase fw-bold">System Status</h6>
                    <p class="small text-gray-300">Version 1.0.0 <br> &copy; {{ date('Y') }} Preneur Space. All rights reserved.</p>
                </div>
            </div>
            <hr class="my-3 border-secondary">
            <p class="mb-0 small">&copy; {{ date('Y') }} Financial Health Analyzer System. Built for Corporate Governance.</p>
        </div>
    </footer>

    <!-- auto scroll button -->
    <button id="scrollToTop" class="btn btn-primary rounded-circle position-fixed bottom-0 end-0 m-4 shadow" style="display: none; width: 50px; height: 50px; z-index: 1050;">
        <i class="bi bi-arrow-up"></i>
    </button>

    <script>
        const scrollBtn = document.getElementById("scrollToTop");
        window.onscroll = function() {
            if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
                scrollBtn.style.display = "block";
            } else {
                scrollBtn.style.display = "none";
            }
        };
        scrollBtn.onclick = function() {
            window.scrollTo({top: 0, behavior: 'smooth'});
        };
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
</body>
</html>