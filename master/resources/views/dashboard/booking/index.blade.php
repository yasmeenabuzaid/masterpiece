@extends('layouts.dashboard_master')

@section('content')

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3><i class="fas fa-calendar-check me-2"></i> All Bookings (Total: {{ $bookings->count() }})</h3>
    </div>

    <div class="mb-4">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>id</th>
                    @if (!auth()->user()->isEmployee())
                        <th>User Name</th>
                        <th>Email</th>
                    @endif
                    <th>Salon Address</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Note</th>
                    <th>Services</th>
                    <th>Created At</th>
                    @if (auth()->check() && (auth()->user()->isSuperAdmin() || auth()->user()->isOwner()))
                        <th>Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @if ($bookings->isEmpty())
                    <tr>
                        <td colspan="{{ auth()->check() && (auth()->user()->isSuperAdmin() || auth()->user()->isOwner()) ? '9' : '8' }}" class="text-center">
                            No bookings available.
                        </td>
                    </tr>
                @else
                    @foreach($bookings as $booking)
                        <tr>
                            <td>{{ $booking->id}}</td>
                            @if (!auth()->user()->isEmployee())
                                <td>{{ $booking->user ? $booking->user->name : 'Unknown User' }}</td>
                                <td>{{ $booking->user ? $booking->user->email : 'Unknown email' }}</td>
                            @endif
                            <td>{{ $booking->subsalon ? $booking->subsalon->address : 'Unknown Salon' }}</td>
                            <td>{{ $booking->date }}</td>
                            <td>{{ $booking->time }}</td>
                            <td>{{ $booking->note ?? 'N/A' }}</td>
                            <td>
                                @foreach($booking->services as $service)
                                    <span class="badge bg-secondary">{{ $service->name }}</span>
                                @endforeach
                            </td>
                            <td>{{ $booking->created_at->format('Y-m-d') }}</td>
                            @if (auth()->check() && (auth()->user()->isSuperAdmin() || auth()->user()->isOwner()))
                                <td>
                                    <button type="button" class="btn btn-icon btn-youtube" onclick="confirmDeletion(event, '{{ route('bookings.destroy', $booking->id) }}')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>

<!-- Custom Confirmation Modal for Deletion -->
<div id="confirmationModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; z-index: 1000;">
    <div style="background: #fff; padding: 20px; border-radius: 5px; text-align: center;">
        <h3><i class="fas fa-trash" style="font-size: 2rem; color: #dc3545;"></i></h3>
        <p>Are you sure you want to delete this booking?</p>
        <button id="confirmButton" class="btn btn-danger">Confirm</button>
        <button id="cancelButton" class="btn btn-secondary">Cancel</button>
    </div>
</div>

<script>
    function confirmDeletion(event, url) {
        event.preventDefault();
        var modal = document.getElementById('confirmationModal');
        var confirmButton = document.getElementById('confirmButton');
        var cancelButton = document.getElementById('cancelButton');
        modal.style.display = 'flex';

        // Confirm button click
        confirmButton.onclick = function() {
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = url;

            // Add CSRF Token
            var csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            form.appendChild(csrfToken);

            // Add DELETE method
            var methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'DELETE';
            form.appendChild(methodField);

            // Submit the form
            document.body.appendChild(form);
            form.submit();
        };

        // Cancel button click
        cancelButton.onclick = function() {
            modal.style.display = 'none';
        };

        // Close modal if clicked outside
        window.onclick = function(event) {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        };
    }
</script>

@endsection
