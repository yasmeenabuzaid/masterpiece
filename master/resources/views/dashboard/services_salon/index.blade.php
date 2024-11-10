@extends('layouts.dashboard_master')

@section('content')
<div class="container">
    <!-- عنوان الصفحة -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3><i class="fas fa-concierge-bell me-2"></i> Services (Total: {{ $services->count() }})</h3>
        @if (auth()->check() && (auth()->user()->isSuperAdmin() || auth()->user()->isOwner()))
            <a href="{{ route('services.create') }}">
                <button type="button" class="btn btn-gradient-success btn-fw">
                    <i class="fa-solid fa-plus me-2"></i> Add New Service
                </button>
            </a>
        @endif
    </div>

    <!-- رسالة النجاح عند إضافة خدمة جديدة -->
    <div class="mb-4">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    <!-- جدول الخدمات -->
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
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
                            <td>{{ $service->description }}</td>
                            <td>{{ $service->categorie->name }}</td>
                            <td>{{ $service->created_at->format('Y-m-d') }}</td>
                            @if (auth()->check() && (auth()->user()->isSuperAdmin() || auth()->user()->isOwner()))
                                <td>
                                    <!-- حذف الخدمة -->
                                    <button type="button" class="btn btn-danger" onclick="confirmDeletion(event, '{{ route('services.destroy', $service->id) }}')">
                                        <i class="fa-solid fa-trash"></i> Delete
                                    </button>
                                    <!-- عرض الخدمة -->
                                    <a href="{{ route('services.show', $service->id) }}">
                                        <button type="button" class="btn btn-dark">
                                            <i class="fa-solid fa-eye"></i> View
                                        </button>
                                    </a>
                                    <!-- تعديل الخدمة -->
                                    <a href="{{ route('services.edit', $service->id) }}">
                                        <button type="button" class="btn btn-info">
                                            <i class="fa-solid fa-pen-to-square"></i> Edit
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

<!-- Custom Confirmation Modal for Deletion -->
<div id="confirmationModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; z-index: 1000;">
    <div style="background: #fff; padding: 20px; border-radius: 5px; text-align: center;">
        <p>Are you sure you want to delete this service?</p>
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
