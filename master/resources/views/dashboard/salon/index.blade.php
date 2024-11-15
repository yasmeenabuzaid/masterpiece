@extends('layouts.dashboard_master')

@section('content')
    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3><i class="fas fa-cut me-2"></i> - All Salons (Total: {{ $salons->count() }})</h3>


            <div>
                <a href="{{ route('salons.create') }}" class="btn btn-success">Add New Salon</a>
            </div>
        </div>


        <div class="mb-4">
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
        </div>

        <form action="{{ route('salons.index') }}" method="GET" class="d-flex align-items-center form-search">
            <input type="text" name="search" class="form-control me-2" placeholder="Search by name" value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
        <br>
        <div class="mb-4">
            <a href="{{ route('salons.index', ['status' => 'active']) }}" class="btn btn-primary">
                <i class="fas fa-check-circle me-1"></i> Active Salons ({{ $activeSalonsCount }})
            </a>
            <a href="{{ route('salons.index', ['status' => 'trashed']) }}" class="btn btn-warning">
                <i class="fas fa-archive me-1"></i> Deleted Salons ({{ $trashedSalonsCount }})
            </a>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Salon Image</th>
                        <th>Salon Name</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($salons->isNotEmpty())
                        @foreach ($salons as $salon)
                            <tr>
                                <td>
                                    @if ($salon->image)
                                        <img src="{{ asset($salon->image) }}" alt="Salon Image" class="me-2" style="border-radius: 3px; width: 100px;">
                                    @else
                                        <span>No image found</span>
                                    @endif
                                </td>
                                <td>{{ $salon->name }}</td>
                                <td>
                                    Date: {{ $salon->created_at->format('Y-m-d') }}<br>
                                    @if ($salon->trashed())
                                        <span style="color:red;">Deleted: {{ $salon->deleted_at->format('Y-m-d') }}</span>
                                    @else
                                        <span>Created: {{ $salon->created_at->format('Y-m-d') }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($salon->trashed())
                                        <button type="button" class="btn btn-success" onclick="confirmRestore(event, '{{ route('salons.restore', $salon->id) }}')">
                                            <i class="fa-solid fa-undo"></i> Restore
                                        </button>
                                        <button type="button" class="btn btn-danger" onclick="confirmDeletion(event, '{{ route('salons.forceDelete', $salon->id) }}')">
                                            <i class="fa-solid fa-trash"></i> Delete
                                        </button>
                                    @else
                                        <a href="{{ route('salons.edit', $salon->id) }}" class="btn btn-info">
                                            <i class="fa-solid fa-pencil-alt"></i> Edit
                                        </a>
                                        <button type="button" class="btn btn-danger" onclick="confirmDeletion(event, '{{ route('salons.destroy', $salon->id) }}')">
                                            <i class="fa-solid fa-trash"></i> Delete
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" class="text-center">No salons available.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <!-- Confirmation Modals -->
    <div id="deleteConfirmationModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; z-index: 1000; padding: 20px;">
        <div style="background: #fff; padding: 20px; border-radius: 5px; text-align: center;">
            <h3><i class="fas fa-trash" style="font-size: 2rem; color: #dc3545;"></i></h3>
            <p>Are you sure you want to permanently delete this salon?</p>
            <button id="confirmDeleteButton" class="btn btn-danger">Delete</button>
            <button id="cancelDeleteButton" class="btn btn-secondary">Cancel</button>
        </div>
    </div>

    <div id="restoreConfirmationModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; z-index: 1000; padding: 20px;">
        <div style="background: #fff; padding: 20px; border-radius: 5px; text-align: center;">
            <h3><i class="fas fa-undo" style="font-size: 2rem; color: #28a745;"></i></h3>
            <p>Are you sure you want to restore this salon?</p>
            <button id="confirmRestoreButton" class="btn btn-success">Restore</button>
            <button id="cancelRestoreButton" class="btn btn-secondary">Cancel</button>
        </div>
    </div>

    <script>
        function confirmDeletion(event, url) {
            event.preventDefault();
            var modal = document.getElementById('deleteConfirmationModal');
            var confirmButton = document.getElementById('confirmDeleteButton');
            var cancelButton = document.getElementById('cancelDeleteButton');
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

            window.onclick = function(event) {
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            };
        }

        function confirmRestore(event, url) {
            event.preventDefault();
            var modal = document.getElementById('restoreConfirmationModal');
            var confirmButton = document.getElementById('confirmRestoreButton');
            var cancelButton = document.getElementById('cancelRestoreButton');
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
                methodField.value = 'POST';
                form.appendChild(methodField);

                document.body.appendChild(form);
                form.submit();
            };

            cancelButton.onclick = function() {
                modal.style.display = 'none';
            };

            window.onclick = function(event) {
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            };
        }
    </script>
@endsection
