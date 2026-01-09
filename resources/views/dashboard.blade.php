@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-body">
                <h1 class="fw-bold mb-4">Welcome, {{ Auth::user()->name }}!</h1>
                
                <div class="row g-4">
                    <div class="col-md-4">
                         <div class="card bg-light-primary border-0 h-100">
                             <div class="card-body d-flex flex-column justify-content-center text-center">
                                 <h2 class="text-primary fw-bold display-4 mb-2">{{ \App\Models\Ticket::where('user_id', Auth::id())->count() }}</h2>
                                 <p class="text-gray-600 fw-semibold fs-5">Total Tickets</p>
                                 <a href="{{ route('tickets.index') }}" class="stretched-link"></a>
                             </div>
                         </div>
                    </div>
                     <div class="col-md-4">
                         <div class="card bg-light-success border-0 h-100">
                             <div class="card-body d-flex flex-column justify-content-center text-center">
                                 <h2 class="text-success fw-bold display-4 mb-2">{{ \App\Models\Ticket::where('user_id', Auth::id())->where('status', 'open')->count() }}</h2>
                                 <p class="text-gray-600 fw-semibold fs-5">Open Tickets</p>
                             </div>
                         </div>
                    </div>
                     <div class="col-md-4">
                         <div class="card bg-light-info border-0 h-100">
                             <div class="card-body d-flex flex-column justify-content-center text-center">
                                 <span class="fs-1 mb-2">🎫</span>
                                 <h5 class="fw-bold text-gray-800">New Request</h5>
                                 <p class="text-gray-500 mb-0">Submit a new issue</p>
                                 <a href="{{ route('tickets.create') }}" class="stretched-link"></a>
                             </div>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
