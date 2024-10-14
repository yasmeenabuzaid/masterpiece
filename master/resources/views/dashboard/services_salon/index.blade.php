@extends('layouts.dashboard_master')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="title-1">Services</h3>
        @if (auth()->check() && (auth()->user()->isSuperAdmin() || auth()->user()->isOwner()))
            <a href="{{ route('services.create') }}">
                <button type="button" class="btn btn-gradient-success btn-rounded btn-fw"><i class="fa-solid fa-plus" style="margin-right: 5px"></i>
                    <i class="zmdi zmdi-plus"></i> Add New Service
                </button>
            </a>
        @endif
    </div>

    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">Created At</th>
                                    @if (auth()->check() && (auth()->user()->isSuperAdmin() || auth()->user()->isOwner()))
                                        <th scope="col">Actions</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($services as $service)
                                    <tr>
                                        <th scope="row">{{ $service->id }}</th>
                                        <td>{{ $service->name }}</td>
                                        <td>{{ $service->description }}</td>
                                        <td>{{ $service->categorie->name }}</td>
                                        <td>{{ $service->created_at->format('Y-m-d') }}</td>
                                        @if (auth()->check() && (auth()->user()->isSuperAdmin() || auth()->user()->isOwner()))
                                            <td>

                                                <button type="button" class="btn btn-gradient-danger btn-rounded btn-icon" onclick="confirmDeletion(event, '{{ route('services.destroy', $service->id) }}')">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                                <button type="button" class="btn btn-gradient-dark btn-rounded btn-icon">
                                                  <i class="fa-solid fa-eye"></i>
                                               </button>
                                               <a href="{{ route('services.edit', $service->id) }}">
                                                <button type="button" class="btn btn-gradient-info btn-rounded btn-icon">
                                                  <i class="fa-solid fa-pen-to-square"></i>
                                              </button>
                                              </a>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom Confirmation Modal -->
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
