@extends('layouts.guest')

@section('content')
    <div class="mb-10 text-start">
        <h2 class="text-dark fw-bolder mb-3">Sign Up</h2>
        <div class="text-muted fw-bold fs-6">
            Create your account to start reporting issues.
        </div>
    </div>

    <form method="POST" action="{{ route('register') }}" class="form w-100">
        @csrf

        <!-- Name -->
        <div class="fv-row mb-3">
            <div class="input-icon-wrapper">
                 <span class="svg-icon">
                     <i class="bi bi-person"></i>
                 </span>
                <input type="text" name="name" class="form-control form-control-solid" placeholder="Full Name" value="{{ old('name') }}" required autofocus style="height: 50px;">
            </div>
            @error('name')
                <div class="text-danger small mt-2">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email -->
        <div class="fv-row mb-3">
            <div class="input-icon-wrapper">
                 <span class="svg-icon">
                     <i class="bi bi-envelope"></i>
                 </span>
                <input type="email" name="email" class="form-control form-control-solid" placeholder="Email Address" value="{{ old('email') }}" required style="height: 50px;">
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
                <input type="password" name="password" class="form-control form-control-solid" placeholder="Password (min 8 chars)" required style="height: 50px;">
                <span class="password-toggle">
                    <i class="bi bi-eye"></i>
                </span>
            </div>
            <div class="text-muted small mt-1">Password must be at least 8 characters and include uppercase, lowercase, numbers, and symbols.</div>
            @error('password')
                <div class="text-danger small mt-2">{{ $message }}</div>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="fv-row mb-4">
             <div class="input-icon-wrapper">
                 <span class="svg-icon">
                     <i class="bi bi-shield-lock"></i>
                 </span>
                <input type="password" name="password_confirmation" class="form-control form-control-solid" placeholder="Confirm Password" required autocomplete="new-password" style="height: 50px;">
                <span class="password-toggle">
                    <i class="bi bi-eye"></i>
                </span>
            </div>
        </div>

        <!-- Math Captcha -->
        <div class="fv-row mb-4">
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
                <span class="indicator-label fw-bold">Create Account</span>
            </button>
        </div>

         <div class="text-gray-500 text-center fw-semibold fs-6">
            Already have an account?
            <a href="{{ route('login') }}" class="link-primary text-decoration-none">Sign In</a>
        </div>
    </form>
@endsection
