@extends('layouts.dashboard_master')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3><i class="fas fa-users me-2"></i> All Users (Total: {{ $users->count() }})</h3>



        <a href="{{ route('users.create') }}">
            <button type="button" class="btn btn-success"><i class="fa-solid fa-plus" style="margin-right: 5px"></i> Add New User</button>
        </a>
    </div>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <form action="{{ route('users.index') }}" method="GET" class="d-flex align-items-center form-search">
        <input type="text" name="search" class="form-control me-2" placeholder="Search by name" value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <br>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>User Type</th>
                    <th>Email</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if($users->isEmpty())
                    <tr>
                        <td colspan="6" class="text-center">No users found</td>
                    </tr>
                @else
                    @foreach($users as $user)
                        <tr>
                            <td>
                                @if($user->image)
                                    <img src="{{ asset($user->image) }}" class="me-2" alt="image" style="border-radius: 50%; width: 50px; height: 50px;">
                                @else
                                    <span>No Image</span>
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
                            <td>{{ $user->created_at->format('Y-m-d') }}</td>
                            <td>
                                <button type="button" class="btn btn-danger" onclick="confirmDeletion(event, '{{ route('users.destroy', $user->id) }}')">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                                <a href="{{ route('users.edit', $user->id) }}">
                                    <button type="button" class="btn btn-info">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                </a>
                            </td>
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
        <p>Are you sure you want to delete this user?</p>
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
