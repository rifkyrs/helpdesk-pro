@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <a href="{{ route('tickets.index') }}" class="btn btn-sm btn-light mb-4">
            &larr; Back to Tickets
        </a>

        <div class="card shadow-sm mb-4">
            <div class="card-header py-3 border-0 d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="card-title fw-bold mb-1">{{ $ticket->title }}</h3>
                    <div class="text-muted fs-7">
                        Submitted by <span class="fw-bold">{{ $ticket->user->name }}</span> • {{ $ticket->created_at->format('M d, Y H:i') }}
                    </div>
                </div>
                <div>
                    <span class="badge badge-light-{{ $ticket->status == 'open' ? 'success' : ($ticket->status == 'closed' ? 'secondary' : 'warning') }} fs-6 fw-bold">
                        {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                    </span>
                </div>
            </div>
            
            <div class="card-body">
                <div class="fs-6 fw-normal text-gray-800 mb-5">
                    {!! nl2br(e($ticket->description)) !!}
                </div>

                @if($ticket->attachments->count() > 0)
                <div class="separator separator-dashed my-5"></div>
                <h5 class="fw-bold mb-3">Attachments</h5>
                <div class="d-flex flex-wrap gap-3">
                    @foreach($ticket->attachments as $attachment)
                        <div class="d-flex align-items-center bg-body-tertiary rounded p-3 border border-secondary border-opacity-10" style="min-width: 200px;">
                            <span class="fs-2 me-3">📄</span>
                            <div class="d-flex flex-column flex-grow-1 me-2">
                                <span class="fw-bold fs-6 text-body">{{ Str::limit($attachment->filename, 20) }}</span>
                                <span class="text-muted fs-8">{{ round($attachment->size / 1024, 2) }} KB</span>
                            </div>
                            <a href="{{ route('tickets.download', [$ticket->id, $attachment->id]) }}" class="btn btn-sm btn-primary" title="Download">
                                <i class="bi bi-download me-1"></i> Download
                            </a>
                        </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
