@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header py-3 border-0">
                <h3 class="card-title fw-bold mb-0">Create New Ticket</h3>
            </div>
            
            <div class="card-body">
                <form method="POST" action="{{ route('tickets.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label for="title" class="form-label required fw-semibold fs-6">Subject</label>
                        <input type="text" class="form-control form-control-solid @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required autofocus placeholder="Brief summary of the issue">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="form-label required fw-semibold fs-6">Description</label>
                        <textarea class="form-control form-control-solid @error('description') is-invalid @enderror" id="description" name="description" rows="5" required placeholder="Detailed explanation...">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="attachment" class="form-label fw-semibold fs-6">Attachment (Optional)</label>
                        <input class="form-control form-control-solid @error('attachment') is-invalid @enderror" type="file" id="attachment" name="attachment">
                        <div class="form-text text-muted">Allowed types: PDF, DOC, DOCX, JPG, PNG (Max 10MB)</div>
                        @error('attachment')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end pt-3">
                        <a href="{{ route('tickets.index') }}" class="btn btn-light me-3">Cancel</a>
                        <button type="submit" class="btn btn-primary">
                            Submit Ticket
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
