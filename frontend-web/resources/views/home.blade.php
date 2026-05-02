<!-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection -->


@extends('layouts.app')

@section('content')
<style>
    .dashboard-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease;
    }
    .dashboard-card:hover {
        transform: translateY(-5px);
    }
    .welcome-gradient {
        background: linear-gradient(45deg, #4e73df, #224abe);
        color: white;
        border-radius: 15px 15px 0 0;
        padding: 1.5rem;
    }
    .stat-icon {
        font-size: 2rem;
        opacity: 0.3;
        position: absolute;
        right: 20px;
        bottom: 10px;
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-9">
            
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h2 class="fw-bold text-secondary">{{ __('Dashboard') }}</h2>
                <span class="badge bg-soft-primary text-primary p-2 px-3 rounded-pill" style="background-color: #e7f0ff;">
                    <i class="bi bi-calendar-event me-1"></i> {{ date('F j, Y') }}
                </span>
            </div>

            @if (session('status'))
                <div class="alert alert-success border-0 shadow-sm mb-4" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('status') }}
                </div>
            @endif

            <div class="card dashboard-card">
                <div class="card-header welcome-gradient border-0">
                    <h4 class="mb-0 fw-light">Welcome back, <strong>{{ Auth::user()->name }}!</strong></h4>
                </div>

                <div class="card-body p-4">
                    <div class="row g-4">
                        <div class="col-12">
                            <p class="text-muted">
                                {{ __('You are successfully logged into your secure dashboard. Here is a quick look at your current status.') }}
                            </p>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="p-3 border rounded-3 bg-light position-relative overflow-hidden">
                                <small class="text-uppercase fw-bold text-muted d-block mb-1">Status</small>
                                <span class="h5 mb-0 text-success">Active</span>
                                <div class="stat-icon text-success"><i class="bi bi-shield-check"></i></div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="p-3 border rounded-3 bg-light position-relative overflow-hidden">
                                <small class="text-uppercase fw-bold text-muted d-block mb-1">Security</small>
                                <span class="h5 mb-0">High</span>
                                <div class="stat-icon text-primary"><i class="bi bi-lock"></i></div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="p-3 border rounded-3 bg-light position-relative overflow-hidden">
                                <small class="text-uppercase fw-bold text-muted d-block mb-1">Session</small>
                                <span class="h5 mb-0">Secure</span>
                                <div class="stat-icon text-info"><i class="bi bi-clock-history"></i></div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5 pt-3 border-top">
                        <button class="btn btn-primary px-4 rounded-pill">View Profile</button>
                        <button class="btn btn-outline-secondary px-4 rounded-pill ms-2">Settings</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection