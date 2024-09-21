@extends('layouts.dashboard_master')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="title-1">Sub Salons</h2>

        {{-- @if(auth()->user()->isSuperAdmin())
            <form method="GET" action="{{ route('subsalons.index') }}" class="form-inline">
                <div class="form-group">
                    <label for="salon_id">Filter by Salon:</label>
                    <select name="salon_id" id="salon_id" class="form-control" onchange="this.form.submit()">
                        <option value="">All Salons</option>
                        @foreach($salons as $salon)
                            <option value="{{ $salon->id }}" {{ request('salon_id') == $salon->id ? 'selected' : '' }}>{{ $salon->name }}</option>
                        @endforeach
                    </select>
                </div>
            </form>
        @endif --}}

        <a href="{{ route('subsalons.create') }}">
            <button type="button" class="btn btn-primary">
                <i class="zmdi zmdi-plus"></i> Add New Sub Salon
            </button>
        </a>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive table--no-card m-b-40">
                <table class="table table-bordered bg-white">
                    <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>Salon Name</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($subsalons as $subsalon)
                            <tr>
                                <th>{{ $subsalon->id }}</th>
                                <td>{{ $subsalon->salon->name }}</td>
                                <td>
                                    @if($subsalon->image)
                                        <img src="{{ asset($subsalon->image) }}" alt="Image" style="width: 100px; border-radius: 0px;">
                                    @else
                                        <span>No Image</span>
                                    @endif
                                </td>
                                <td>{{ $subsalon->name }}</td>
                                <td>{{ $subsalon->description }}</td>
                                <td>{{ $subsalon->address }}</td>
                                <td>{{ $subsalon->phone }}</td>
                                <td>{{ $subsalon->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <a href="{{ route('subsalons.edit', $subsalon->id) }}">
                                        <button type="button" class="btn btn-secondary">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                    </a>
                                    <button type="button" class="btn btn-danger" onclick="confirmDeletion(event, '{{ route('subsalons.destroy', $subsalon->id) }}')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
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
