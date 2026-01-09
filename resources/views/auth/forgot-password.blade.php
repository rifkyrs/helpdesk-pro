@extends('layouts.guest')

@section('content')
    <div class="mb-5 text-start">
        <h2 class="text-dark fw-bolder mb-3">Forgot Password?</h2>
        <div class="text-muted fw-bold fs-6">
            Enter your email to receive a password reset link.
        </div>
    </div>

    @if (session('status'))
        <div class="alert alert-success mb-4 text-center">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="form w-100">
        @csrf

        <!-- Email -->
        <div class="fv-row mb-4">
            <div class="input-icon-wrapper">
                 <span class="svg-icon">
                     <i class="bi bi-envelope"></i>
                 </span>
                <input type="email" name="email" class="form-control form-control-solid" placeholder="Email Address" value="{{ old('email') }}" required autofocus style="height: 50px;">
            </div>
            @error('email')
                <div class="text-danger small mt-2">{{ $message }}</div>
            @enderror
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
        <div class="d-grid mb-3">
            <button type="submit" class="btn btn-primary" style="height: 50px;">
                <span class="indicator-label fw-bold">Send Reset Link</span>
            </button>
        </div>
        
        <div class="d-grid">
             <a href="{{ route('login') }}" class="btn btn-light" style="height: 50px; line-height: 38px;">
                Cancel
             </a>
        </div>
    </form>
@endsection
