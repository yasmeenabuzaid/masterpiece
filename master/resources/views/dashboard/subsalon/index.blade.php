@extends('layouts.dashboard_master')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3><i class="fas fa-cut me-2"></i> Sub Salons (Total: {{ $subsalons->count() }})</h3>

        <a href="{{ route('subsalons.create') }}">
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

    <form action="{{ route('subsalons.index') }}" method="GET" class="d-flex form-search justify-content-between">
        <div>
            <select name="governorate" class="form-select me-2">
                <option value="">Select Governorate</option>
                @foreach (['Amman', 'Zarqa', 'Irbid', 'Ajloun', 'Jerash', 'Madaba', 'Mafraq', 'Karak', 'Tafilah', 'Ma\'an', 'Aqaba'] as $governorate)
                    <option value="{{ $governorate }}" {{ request('governorate') == $governorate ? 'selected' : '' }}>{{ $governorate }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>

    <br><br>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>id</th>
                    <th>Image</th>
                    <th>Parent Salon</th>
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
                            <td>{{ $subsalon->id }}</td>

                            <td>
                                @if($subsalon->image)
                                    <img src="{{ asset($subsalon->image) }}" alt="Image not found" class="me-2" style="border-radius: 3px; width: 50px;">
                                @else
                                    <span>No Image</span>
                                @endif
                            </td>
                            <td>{{ $subsalon->salon->name ?? 'No Salon Available' }}</td>
                            <td>{{ $subsalon->usersCount() > 0 ? $subsalon->usersCount() : 'No associated employees' }}</td>
                            <td>{{ $subsalon->phone }}</td>
                            <td>
                                Date: {{ $subsalon->created_at->format('Y-m-d') }}<br>Time: {{ $subsalon->created_at->format('H:i') }}
                            </td>
                            <td>
                                <a href="{{ route('subsalons.edit', $subsalon->id) }}">
                                    <button type="button" class="btn btn-gradient-dark btn-icon"><i class="fa-solid fa-pencil-alt"></i></button>
                                </a>
                                <button type="button" class="btn btn-icon btn-youtube" onclick="confirmDeletion(event, '{{ route('subsalons.destroy', $subsalon->id) }}')">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                                <a href="{{ route('subsalons.view', $subsalon->id) }}">
                                    <button type="button" class="btn btn-custom btn-icon">
                                        <i class="fa-solid fa-eye"></i>
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

<!-- Confirmation Modal for Deletion -->
<div id="deleteConfirmationModal"
    style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; z-index: 1000; padding: 20px;">
    <div style="background: #fff; padding: 20px; border-radius: 5px; text-align: center;">
        <h3><i class="fas fa-trash" style="font-size: 2rem; color: #dc3545;"></i></h3>
        <p>Are you sure you want to permanently delete this sub salon?</p>
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
