@extends('layouts.dashboard_master')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3><i class="fas fa-tags me-2"></i> Categories (Total: {{ $categories->count() }})</h3>

        @if (auth()->check() && (auth()->user()->isSuperAdmin() || auth()->user()->isOwner()))
        <a href="{{ route('categories.create') }}">
            <button class="Btn">
                <div class="sign"><i class="fa-solid fa-plus"></i></div>
                <div class="text">create</div>
            </button>
        </a>
        @endif
    </div>

    <form action="{{ route('categories.index') }}" method="GET" class="d-flex form-search justify-content-between mb-4">
        <div>
            <input type="text" name="search" class="form-control me-2" placeholder="Search by name" value="{{ request('search') }}">
        </div>
        <div>
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>id</th>
                    <th>Name</th>
                    <th style="max-width: 250px; word-wrap: break-word; white-space: normal;">Description</th> <!-- تقليص عرض عمود الوصف مع الحفاظ على التفاف النص -->
                    <th>Category belongs to</th>
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
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td style="max-width: 250px; word-wrap: break-word; white-space: normal;">{{ $category->description }}</td> <!-- تطبيق التنسيق على العمود -->
                            <td>
                                @if ($category->subSalon && $category->subSalon->salon)
                                    {{ $category->subSalon->salon->name }} <!-- Display Salon Name -->
                                @else
                                    No Salon Found
                                @endif
                            </td>
                            <td>
                                Date: {{ isset($category->created_at) ? $category->created_at->format('Y-m-d') : 'null' }}<br>
                                Time: {{ isset($category->created_at) ? $category->created_at->format('H:i') : 'null' }}
                            </td>
                            @if (auth()->check() && (auth()->user()->isSuperAdmin() || auth()->user()->isOwner()))
                                <td>
                                    <button type="button" class="btn btn-icon btn-youtube" onclick="confirmDeletion(event, '{{ route('categories.destroy', $category->id) }}')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                    <a href="{{ route('categories.edit', $category->id) }}">
                                        <button type="button"class="btn btn-gradient-dark btn-icon">
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

<!-- Custom Confirmation Modal for Deletion -->
<div id="confirmationModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; z-index: 1000;">
    <div style="background: #fff; padding: 20px; border-radius: 5px; text-align: center;">
        <h3><i class="fas fa-trash" style="font-size: 2rem; color: #dc3545;"></i></h3>
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
