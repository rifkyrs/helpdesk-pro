@extends('layouts.guest')

@section('content')
    <div class="mb-10 text-start">
        <h2 class="text-dark fw-bolder mb-3">Login</h2>
        <div class="text-muted fw-bold fs-6">
            Enter your email and password to access the application.
        </div>
    </div>

    @if (session('status'))
        <div class="alert alert-success mb-4 text-center">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="form w-100">
        @csrf

        <!-- Email -->
        <div class="fv-row mb-3">
             <div class="input-icon-wrapper">
                 <span class="svg-icon">
                     <i class="bi bi-envelope"></i>
                 </span>
                 <input type="email" name="email" class="form-control form-control-solid" placeholder="Email / Username" value="{{ old('email') }}" required autofocus autocomplete="username" style="height: 50px;">
             </div>
             @error('email')
                <div class="text-danger small mt-2">{{ $message }}</div>
             @enderror
        </div>

        <!-- Password -->
        <div class="fv-row mb-3">
             <div class="input-icon-wrapper">
                 <span class="svg-icon">
                     <i class="bi bi-key"></i>
                 </span>
                <input type="password" name="password" class="form-control form-control-solid" placeholder="Password" required autocomplete="current-password" style="height: 50px;">
                <span class="password-toggle">
                    <i class="bi bi-eye"></i>
                </span>
            </div>
             @error('password')
                <div class="text-danger small mt-2">{{ $message }}</div>
             @enderror
        </div>

        <!-- Links -->
        <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8 justify-content-end">
            <a href="{{ route('password.request') }}" class="link-primary text-decoration-none">Reset / Forgot Password?</a>
        </div>

        <!-- Math Captcha -->
        <div class="fv-row mb-3">
            <label class="form-label fw-bolder text-dark fs-6">Security Check</label>
            <div class="d-flex align-items-center mb-2">
                <img src="{{ route('captcha.image') }}" class="me-3 rounded border" style="height: 40px" alt="Captcha">
                <button type="button" class="btn btn-icon btn-sm btn-light" onclick="this.previousElementSibling.src = '{{ route('captcha.image') }}?' + Math.random()">
                    <i class="bi bi-arrow-clockwise"></i>
                </button>
            </div>
            <input type="number" name="captcha_answer" class="form-control form-control-solid" placeholder="Enter result" required>
            @error('captcha_answer')
                <div class="text-danger small mt-2">{{ $message }}</div>
            @enderror
        </div>

        <!-- Actions -->
        <div class="d-grid mb-5">
            <button type="submit" class="btn btn-primary" style="height: 50px;">
                <span class="indicator-label fw-bold">Sign In to Application</span>
            </button>
        </div>
        


         <div class="text-gray-500 text-center fw-semibold fs-6">
            Not a member yet?
            <a href="{{ route('register') }}" class="link-primary text-decoration-none">Sign up</a>
        </div>
    </form>
@endsection
