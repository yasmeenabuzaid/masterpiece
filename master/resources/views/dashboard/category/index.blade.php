@extends('layouts.dashboard_master')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="title-1">Categories</h3>
        @if (auth()->check() && (auth()->user()->isSuperAdmin() || auth()->user()->isOwner()))
            <a href="{{ route('categories.create') }}">
                <button type="button" class="btn btn-primary">
                    <i class="zmdi zmdi-plus"></i> Add New Category
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
                                    <th scope="col">Date</th>
                                    @if (auth()->check() && (auth()->user()->isSuperAdmin() || auth()->user()->isOwner()))
                                        <th scope="col">Actions</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $categorie)
                                    <tr>
                                        <th scope="row">{{ $categorie->id }}</th>
                                        <td>{{ $categorie->name }}</td>
                                        <td>{{ $categorie->description }}</td>
                                        <td>{{ $categorie->created_at->format('Y-m-d') }}</td>
                                        @if (auth()->check() && (auth()->user()->isSuperAdmin() || auth()->user()->isOwner()))
                                            <td>
                                                <a href="{{ route('categories.edit', $categorie->id) }}">
                                                    <button type="button" class="btn btn-secondary">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>
                                                </a>
                                                <button type="button" class="btn btn-danger" onclick="confirmDeletion(event, '{{ route('categories.destroy', $categorie->id) }}')">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
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
        <p>Are you sure you want to delete this category?</p>
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
    }
</script>
@endsection
