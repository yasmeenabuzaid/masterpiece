@if (auth()->check() && (auth()->user()->isSuperAdmin()))

@extends('layouts.dashboard_master')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3><i class="fas fa-comments me-2"></i> Contacts Us (Total: {{ $contacts->count() }})</h3>
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
                    <th>ID</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Date</th>
                    @if (auth()->check() && (auth()->user()->isSuperAdmin() || auth()->user()->isOwner()))
                        <th>Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @if ($contacts->isEmpty())
                    <tr>
                        <td colspan="{{ auth()->check() && (auth()->user()->isSuperAdmin() || auth()->user()->isOwner()) ? '7' : '6' }}" class="text-center">
                            No contacts available.
                        </td>
                    </tr>
                @else
                    @foreach($contacts as $contact)
                        <tr>
                            <td>{{ $contact->id }}</td>
                            <td>{{ $contact->name }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->message }}</td>
                            <td>{{ $contact->created_at->format('Y-m-d') }}</td>
                            @if (auth()->check() && (auth()->user()->isSuperAdmin() || auth()->user()->isOwner()))
                                <td>
                                    <button type="button"  class="btn btn-icon btn-youtube" onclick="confirmDeletion(event, '{{ route('contacts.destroy', $contact->id) }}')">
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
        <p>Are you sure you want to delete this contact?</p>
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
@endif
