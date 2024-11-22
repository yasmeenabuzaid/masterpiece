@extends('layouts.dashboard_master')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3><i class="fas fa-users me-2"></i> All Users (Total: {{ $users->count() }})</h3>

        <a href="{{ route('users.create') }}">
            <button class="Btn">
                <div class="sign"><i class="fa-solid fa-plus"></i></div>
                <div class="text">create</div>
            </button>
        </a>
    </div>

    <div class="mb-4">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    <form action="{{ route('users.index') }}" method="GET" class="d-flex form-search justify-content-between mb-4">
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
                    <th>Image</th>
                    <th>Name</th>
                    <th>User Type</th>
                    <th>Email</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if($users->isEmpty())
                    <tr>
                        <td colspan="6" class="text-center">No users available</td>
                    </tr>
                @else
                    @foreach($users as $user)
                        <tr>
                            <td>
                                @if($user->image)
                                    <img src="{{ asset($user->image) }}" class="me-2" alt="image" style="border-radius: 50%; width: 50px; height: 50px;">
                                @else
                                    <img src="https://i2.wp.com/chasesolar.org.uk/files/2022/02/blank-avatar.jpg" class="me-2" alt="No Image" style="border-radius: 50%; width: 50px; height: 50px;">
                                @endif
                            </td>

                            <td>{{ $user->name }}</td>
                            <td>
                                @if($user->usertype === 'user')
                                    <label class="badge" style="background-color: red; color: white;">Customer</label>
                                @elseif($user->usertype === 'employee')
                                    <label class="badge" style="background-color: blue; color: white;">Employee</label>
                                @elseif($user->usertype === 'owner')
                                    <label class="badge" style="background-color: orange; color: white;">Owner</label>
                                @elseif($user->usertype === 'super_admin')
                                    <label class="badge" style="background-color: green; color: white;">Super Admin</label>
                                @endif
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if ($user->created_at)
                                    Date: {{ $user->created_at->format('Y-m-d') }}<br>
                                    Time: {{ $user->created_at->format('H:i') }}
                                @else
                                    Date: N/A<br>
                                    Time: N/A
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('users.edit', $user->id) }}">
                                    <button type="button" class="btn btn-gradient-dark btn-icon">
                                        <i class="fa-solid fa-pencil-alt"></i>
                                    </button>
                                </a>
                                <button type="button" class="btn btn-icon btn-youtube" onclick="confirmDeletion(event, '{{ route('users.destroy', $user->id) }}')">
                                    <i class="fa-solid fa-trash"></i>
                                </button>

                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>

<!-- Confirmation Modal for Deletion -->
<div id="deleteConfirmationModal"
    style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; z-index: 1000; padding: 20px;">
    <div style="background: #fff; padding: 20px; border-radius: 5px; text-align: center;">
        <h3><i class="fas fa-trash" style="font-size: 2rem; color: #dc3545;"></i></h3>
        <p>Are you sure you want to permanently delete this user?</p>
        <button id="confirmDeleteButton" class="btn btn-danger">Delete</button>
        <button id="cancelDeleteButton" class="btn btn-secondary">Cancel</button>
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
</script>

@endsection
