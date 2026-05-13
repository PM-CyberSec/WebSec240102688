@extends('layouts.app')
@section('title', 'Login')

@section('styles')
<style>
    .auth-page {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, var(--dark-charcoal), var(--dark-secondary));
        padding: 40px 20px;
        position: relative;
        overflow: hidden;
    }

    .auth-page::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255, 107, 53, 0.1) 0%, transparent 50%);
        animation: rotate 20s linear infinite;
    }

    @keyframes rotate {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    .auth-card {
        background: white;
        border-radius: var(--radius-xl);
        box-shadow: var(--shadow-lg);
        overflow: hidden;
        position: relative;
        z-index: 2;
        max-width: 480px;
        width: 100%;
    }

    .auth-header {
        background: linear-gradient(135deg, var(--primary-orange), var(--primary-orange-dark));
        padding: 40px 40px 60px;
        text-align: center;
        margin-bottom: -40px;
    }

    .auth-logo {
        width: 80px;
        height: 80px;
        background: white;
        border-radius: var(--radius-lg);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        font-size: 36px;
        color: var(--primary-orange);
    }

    .auth-title {
        font-family: 'Playfair Display', serif;
        font-size: 28px;
        font-weight: 700;
        color: white;
        margin: 0;
    }

    .auth-subtitle {
        color: rgba(255,255,255,0.8);
        margin-top: 8px;
    }

    .auth-body {
        padding: 40px;
    }

    .form-group-custom {
        margin-bottom: 24px;
    }

    .form-label-custom {
        display: block;
        font-weight: 600;
        color: var(--dark-charcoal);
        margin-bottom: 8px;
    }

    .form-input-custom {
        width: 100%;
        padding: 16px 20px;
        border: 2px solid var(--light-gray);
        border-radius: var(--radius-md);
        font-size: 16px;
        transition: var(--transition-fast);
    }

    .form-input-custom:focus {
        border-color: var(--primary-orange);
        box-shadow: 0 0 0 4px rgba(255, 107, 53, 0.1);
        outline: none;
    }

    .remember-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
    }

    .remember-check {
        display: flex;
        align-items: center;
        gap: 8px;
        color: var(--muted-gray);
    }

    .remember-check input {
        width: 18px;
        height: 18px;
        accent-color: var(--primary-orange);
    }

    .forgot-link {
        color: var(--primary-orange);
        font-weight: 600;
    }

    .auth-btn {
        width: 100%;
        padding: 18px;
        font-size: 16px;
        font-weight: 700;
        border-radius: var(--radius-md);
    }

    .auth-divider {
        display: flex;
        align-items: center;
        gap: 16px;
        margin: 28px 0;
    }

    .auth-divider::before,
    .auth-divider::after {
        content: '';
        flex: 1;
        height: 1px;
        background: var(--light-gray);
    }

    .auth-divider span {
        color: var(--muted-gray);
        font-size: 14px;
    }

    .auth-footer {
        text-align: center;
        color: var(--muted-gray);
    }

    .auth-footer a {
        color: var(--primary-orange);
        font-weight: 600;
    }

    .social-login {
        display: flex;
        gap: 12px;
    }

    .social-btn {
        flex: 1;
        padding: 14px;
        border: 2px solid var(--light-gray);
        border-radius: var(--radius-md);
        background: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        cursor: pointer;
        transition: var(--transition-fast);
    }

    .social-btn:hover {
        border-color: var(--primary-orange);
        background: var(--off-white);
    }
</style>
@endsection

@section('content')
<div class="auth-page">
    <div class="auth-card">
        <div class="auth-header">
            <div class="auth-logo">
                <i class="bi bi-shop"></i>
            </div>
            <h2 class="auth-title">Welcome Back</h2>
            <p class="auth-subtitle">Sign in to continue to Foodie</p>
        </div>

        <div class="auth-body">
            @if(session('status'))
            <div class="alert alert-success border-0 rounded-3 mb-4" style="background: rgba(46, 204, 113, 0.1);">
                <i class="bi bi-check-circle me-2"></i>{{ session('status') }}
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group-custom">
                    <label class="form-label-custom" for="email">Email Address</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                           class="form-input-custom @error('email') is-invalid @enderror"
                           required autocomplete="email" autofocus placeholder="Enter your email">
                    @error('email')
                    <div class="text-danger small mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group-custom">
                    <label class="form-label-custom" for="password">Password</label>
                    <input type="password" name="password" id="password"
                           class="form-input-custom @error('password') is-invalid @enderror"
                           required autocomplete="current-password" placeholder="Enter your password">
                    @error('password')
                    <div class="text-danger small mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="remember-row">
                    <label class="remember-check">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <span>Remember me</span>
                    </label>
                    @if(Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot-link">Forgot password?</a>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary-custom auth-btn">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Sign In
                </button>
            </form>

            <div class="auth-divider"><span>or continue with</span></div>

            <div class="social-login">
                <button type="button" class="social-btn" title="Google">
                    <i class="bi bi-google" style="color: #DB4437;"></i>
                </button>
                <button type="button" class="social-btn" title="Facebook">
                    <i class="bi bi-facebook" style="color: #4267B2;"></i>
                </button>
                <button type="button" class="social-btn" title="Apple">
                    <i class="bi bi-apple"></i>
                </button>
            </div>

            <div class="auth-footer mt-4">
                <p class="mb-0">Don't have an account? <a href="{{ route('register') }}">Create one</a></p>
            </div>
        </div>
    </div>
</div>
@endsection