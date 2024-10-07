@extends('layouts.dashboard_master')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="title-1"> Owners</h3>
        <a href="{{ route('users.create') }}">
            <button type="button" class="btn btn-gradient-success btn-rounded btn-fw"><i class="fa-solid fa-plus" style="margin-right: 5px"></i>
                <i class="zmdi zmdi-plus"></i> Add New Owner
            </button>
        </a>
    </div>

    <div class="row">
        <div class="col-12 grid-margin">
          <div class="card">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th> Assignee </th>
                      <th> User Type </th>
                      <th> Email </th>
                      <th> Date </th>
                      <th> Actions </th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($users as $user)
                    <tr>
                      <td>
                        <img src="{{ $user->image ? asset($user->image) : 'default-image-path.jpg' }}" class="me-2" alt="image"> {{ $user->name }}
                      </td>
                      <td>

                        @if($user->usertype === 'owner')
                            <label class="badge" style="background-color: orange; color: white;">Owner</label>

                        @endif
                    </td>


                      <td>{{ $user->email }}</td>
                      <td>{{ $user->created_at->format('Y-m-d') }}</td>
                      <td>
                        <button type="button" class="btn btn-gradient-danger btn-rounded btn-icon" onclick="confirmDeletion(event, '{{ route('users.destroy', $user->id) }}')">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                        <button type="button" class="btn btn-gradient-dark btn-rounded btn-icon">
                          <i class="fa-solid fa-eye"></i>
                       </button>
                           <a href="{{ route('users.edit', $user->id) }}" >
                              <button type="button" class="btn btn-gradient-info btn-rounded btn-icon">
                                  <i class="fa-solid fa-pen-to-square"></i>
                              </button>                          </a>

                      </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center">No users found.</td>
                        </tr>
                    @endforelse
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
