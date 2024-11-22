@extends('layouts.dashboard_master')

@section('content')

{{-- ------------------------------------------------------------------- start title and button create --------------------------------- --}}
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3><i class="fas fa-concierge-bell me-2"></i> Services (Total: {{ $services->count() }})</h3>

        @if (auth()->check() && (auth()->user()->isSuperAdmin() || auth()->user()->isOwner()))
        <a href="{{ route('services.create') }}">
            <button class="Btn">
                <div class="sign"><i class="fa-solid fa-plus"></i></div>
                <div class="text">create</div>
            </button>
        </a>
        @endif
    </div>

    <form action="{{ route('services.index') }}" method="GET" class="d-flex form-search justify-content-between mb-4">
        <div>
            <input type="text" name="search" class="form-control me-2" placeholder="Search by name" value="{{ request('search') }}">
        </div>
        <div>
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>
{{-- ------------------------------------------------------------------- end title and button create --------------------------------- --}}

{{-- ------------------------------------------------------------------- start success message--------------------------------- --}}
    <div class="mb-4">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>
{{-- ------------------------------------------------------------------- end success message--------------------------------- --}}

{{-- ------------------------------------------------------------------- start table--------------------------------- --}}
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th style="max-width: 250px; word-wrap: break-word; white-space: normal;">Description</th> <!-- Adjusted width for description -->
                    <th>Category</th>
                    <th>Created At</th>
                    @if (auth()->check() && (auth()->user()->isSuperAdmin() || auth()->user()->isOwner()))
                        <th>Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @if($services->isEmpty())
                    <tr>
                        <td colspan="{{ auth()->check() && (auth()->user()->isSuperAdmin() || auth()->user()->isOwner()) ? '6' : '5' }}" class="text-center">
                            No services available. Please add a new service.
                        </td>
                    </tr>
                @else
                    @foreach($services as $service)
                        <tr>
                            <td>{{ $service->id }}</td>
                            <td>{{ $service->name }}</td>
                            <td style="max-width: 250px; word-wrap: break-word; white-space: normal;">{{ $service->description }}</td> <!-- Adjusted width for description -->
                            <td>{{ $service->categorie->name }}</td>
                            <td>{{ $service->created_at->format('Y-m-d') }}</td>
                            @if (auth()->check() && (auth()->user()->isSuperAdmin() || auth()->user()->isOwner()))
                                <td>
                                    <button type="button"class="btn btn-icon btn-youtube" onclick="confirmDeletion(event, '{{ route('services.destroy', $service->id) }}')">
                                        <i class="fa-solid fa-trash"></i> <!-- Trash Icon -->
                                    </button>

                                    <a href="{{ route('services.edit', $service->id) }}">
                                        <button type="button" class="btn btn-gradient-dark btn-icon">
                                            <i class="fa-solid fa-pen-to-square"></i> <!-- Edit Icon -->
                                        </button>
                                    </a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    </div>
{{-- ------------------------------------------------------------------- end table--------------------------------- --}}

{{-- ------------------------------------------------------------------- start modal--------------------------------- --}}
    <div id="confirmationModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; z-index: 1000;">
        <div style="background: #fff; padding: 20px; border-radius: 5px; text-align: center;">
            <p>Are you sure you want to delete this service?</p>
            <button id="confirmButton" class="btn btn-danger">Confirm</button>
            <button id="cancelButton" class="btn btn-secondary">Cancel</button>
        </div>
    </div>
{{-- ------------------------------------------------------------------- end modal--------------------------------- --}}

<script>
    function confirmDeletion(event, url) {
        event.preventDefault();
        var modal = document.getElementById('confirmationModal');
        var confirmButton = document.getElementById('confirmButton');
        var cancelButton = document.getElementById('cancelButton');

        // Show the custom confirmation dialog
        modal.style.display = 'flex';

        // Set up the confirm button to submit the form
        confirmButton.onclick = function() {
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = url;

            var csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            form.appendChild(csrfToken);

            var methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'DELETE';
            form.appendChild(methodField);

            document.body.appendChild(form);
            form.submit();
        };

        // Set up the cancel button to hide the modal
        cancelButton.onclick = function() {
            modal.style.display = 'none';
        };
    }
</script>

@endsection
