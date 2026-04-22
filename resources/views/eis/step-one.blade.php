@extends('eis.app')
@section('title', 'Step 1: Assets')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Step 1 of 2: Entity Assets</h5>
    </div>
    <div class="card-body">
        <div class="progress mb-4" style="height: 25px;">
            <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                <strong>50% Complete</strong>
            </div>
        </div>
        <form action="{{ route('eis.postStepOne') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label for="current_assets" class="form-label">Current Assets (USD)</label>
                <input type="number" step="0.01" class="form-control @error('current_assets') is-invalid @enderror" id="current_assets" name="current_assets" value="{{ old('current_assets') }}" required placeholder="e.g. 150000.00">
                @error('current_assets')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="form-text">Short-term assets expected to be converted to cash within a year.</div>
            </div>

            <div class="mb-4">
                <label for="total_assets" class="form-label">Total Assets (USD)</label>
                <input type="number" step="0.01" class="form-control @error('total_assets') is-invalid @enderror" id="total_assets" name="total_assets" value="{{ old('total_assets') }}" required placeholder="e.g. 500000.00">
                @error('total_assets')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="form-text">The total value of all assets owned by the entity.</div>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg">Next Step &raquo;</button>
            </div>
        </form>
    </div>
</div>
@endsection