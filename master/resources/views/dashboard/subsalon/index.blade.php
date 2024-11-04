@extends('layouts.dashboard_master')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3><i class="fas fa-cut me-2"></i> Sub Salons (Total: {{ $subsalons->count() }})</h3>
        <a href="{{ route('subsalons.create') }}">
            <button type="button" class="btn btn-success"><i class="fa-solid fa-plus" style="margin-right: 5px"></i> Add New Sub Salon</button>
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Parent Salon</th>
                    <th>Address</th>
                    <th>Number of Employees</th>
                    <th>Phone</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if($subsalons->isEmpty())
                    <tr>
                        <td colspan="7" class="text-center">No Sub Salons Available</td>
                    </tr>
                @else
                    @foreach($subsalons as $subsalon)
                        <tr>
                            <td>
                                @if($subsalon->salon->image)
                                    <img src="{{ asset($subsalon->salon->image) }}" alt="Image not found" class="me-2" style="border-radius: 3px; width: 100px;">
                                @else
                                    <span>No Image</span>
                                @endif
                            </td>
                            <td>{{ $subsalon->salon->name }}</td>
                            <td>{{ $subsalon->address }}</td>
                            <td>{{ $subsalon->usersCount() > 0 ? $categorie->subsalon->usersCount() : 'No associated employees'  }}</td> <!-- افترض وجود حقل employee_count -->
                            <td>{{ $subsalon->phone }}</td>
                            <td>Date: {{ $subsalon->created_at->format('Y-m-d') }}<br>Time: {{ $subsalon->created_at->format('H:i') }}</td>
                            <td>

                                <button type="button" class="btn btn-danger" onclick="confirmDeletion(event, '{{ route('subsalons.destroy', $subsalon->id) }}')">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                                <a href="{{ route('subsalons.view', $subsalon->id) }}">
                                    <button type="button" class="btn btn-dark">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                </a>
                                <a href="{{ route('subsalons.edit', $subsalon->id) }}">
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
        <p>Are you sure you want to delete this sub salon?</p>
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
