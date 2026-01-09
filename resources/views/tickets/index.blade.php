@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-header border-0 pt-6 d-flex justify-content-between align-items-center">
                <div class="card-title mb-0">
                    <!-- Search -->
                    <div class="d-flex align-items-center position-relative my-1">
                        <span class="svg-icon fs-1 position-absolute ms-6">
                            <i class="bi bi-search fs-3"></i>
                        </span>
                        <form action="{{ route('tickets.index') }}" method="GET" class="d-flex">
                             <input type="text" name="search" class="form-control form-control-solid w-250px ps-15" placeholder="Search Tickets" value="{{ request('search') }}">
                        </form>
                    </div>
                </div>
                <div class="card-toolbar">
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('tickets.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-lg me-2"></i> New Ticket
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body py-4">
                @if($tickets->count() > 0)
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-6 gy-5">
                        <thead>
                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                <th class="min-w-125px">Title</th>
                                <th class="min-w-125px">Status</th>
                                <th class="min-w-125px">Created</th>
                                <th class="text-end min-w-100px">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                            @foreach($tickets as $ticket)
                            <tr>
                                <td>
                                    <div class="d-flex flex-column">
                                        <a href="{{ route('tickets.show', $ticket) }}" class="text-gray-800 text-hover-primary mb-1 fs-6 fw-bold">{{ $ticket->title }}</a>
                                        <span class="text-muted fw-semibold d-block fs-7">{{ Str::limit($ticket->description, 50) }}</span>
                                    </div>
                                </td>
                                <td>
                                    @if($ticket->status == 'open')
                                        <span class="badge text-bg-success">Open</span>
                                    @elseif($ticket->status == 'in_progress')
                                        <span class="badge text-bg-warning">In Progress</span>
                                    @else
                                        <span class="badge text-bg-secondary">Closed</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span class="text-gray-800 fw-bold">{{ $ticket->created_at->format('d M Y') }}</span>
                                        <span class="text-muted fs-7">{{ $ticket->created_at->format('H:i') }}</span>
                                    </div>
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('tickets.show', $ticket) }}" class="btn btn-sm btn-light btn-active-light-primary">
                                        View
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{ $tickets->appends(request()->query())->links() }}
                </div>
                @else
                    <div class="text-center py-10">
                        <i class="bi bi-ticket-detailed fs-5x text-muted mb-4"></i>
                        <h4 class="text-gray-800 fw-bold">No tickets found</h4>
                        <p class="text-muted fs-6 mb-5">There are no tickets created yet or matching your search.</p>
                        <a href="{{ route('tickets.create') }}" class="btn btn-primary">Create Ticket</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
