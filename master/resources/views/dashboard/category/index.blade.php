@extends('layouts.dashboard_master')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3><i class="fas fa-tags me-2"></i> Categories (Total: {{ $categories->count() }})</h3>
        @if (auth()->check() && (auth()->user()->isSuperAdmin() || auth()->user()->isOwner()))
            <a href="{{ route('categories.create') }}">
                <button type="button" class="btn btn-success">
                    <i class="fa-solid fa-plus" style="margin-right: 5px"></i> Add New Category
                </button>
            </a>
        @endif
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Category Image</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Date Created</th>
                    @if (auth()->check() && (auth()->user()->isSuperAdmin() || auth()->user()->isOwner()))
                        <th>Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @if($categories->isEmpty())
                    <tr>
                        <td colspan="{{ auth()->check() && (auth()->user()->isSuperAdmin() || auth()->user()->isOwner()) ? 5 : 4 }}" class="text-center">No Categories Available</td>
                    </tr>
                @else
                    @foreach($categories as $category)
                        <tr>
                            <td>
                                @if ($category->image)
                                    <img src="{{ asset($category->image) }}" alt="Category Image" class="me-2" style="border-radius: 3px; width: 100px;">
                                @else
                                    <span>No image found</span>
                                @endif
                            </td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->description }}</td>
                            <td>Date: {{ $category->created_at->format('Y-m-d') }}<br>Time: {{ $category->created_at->format('H:i') }}</td>
                            @if (auth()->check() && (auth()->user()->isSuperAdmin() || auth()->user()->isOwner()))
                                <td>
                                    <button type="button" class="btn btn-danger" onclick="confirmDeletion(event, '{{ route('categories.destroy', $category->id) }}')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                    <a href="{{ route('categories.edit', $category->id) }}">
                                        <button type="button" class="btn btn-info">
                                            <i class="fa-solid fa-pen-to-square"></i>
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
