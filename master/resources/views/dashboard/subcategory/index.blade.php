@extends('layouts.dashboard_master')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="title-1">all Sub categories</h2>
        <a href="{{ route('subcategories.create') }}">
            <button type="button" class="btn btn-primary">
                <i class="zmdi zmdi-plus"></i> Add New Subcategory
            </button>
        </a>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive table--no-card m-b-40">
                <table class="table table-bordered bg-white">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Category</th>
                            <th scope="col">Date</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($subcategories as $subcat)
                        <tr>
                            <td>{{ $subcat->id }}</td>
                            <td>{{ $subcat->name }}</td>
                            <td>{{ $subcat->description }}</td>
                            <td>{{ $subcat->categorie->name }}</td>
                            <td>{{ $subcat->created_at->format('Y-m-d') }}</td>
                            <td>
                                <a href="{{ route('subcategories.edit', $subcat->id) }}">
                                    <button type="button" class="btn btn-secondary">
                                        <i class="fa-solid fa-pen-to-square"></i> Edit
                                    </button>
                                </a>

                                <button type="button" class="btn btn-danger" onclick="confirmDeletion(event, '{{ route('subcategories.destroy', $subcat->id) }}')">
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

<div id="confirmationModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.7); justify-content: center; align-items: center; z-index: 1000;">
    <div style="background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3); text-align: center;">
        <i class="fa-solid fa-exclamation-triangle" style="color: rgb(255, 225, 0); font-size: 50px; margin-bottom: 20px;"></i>
        <p style="font-size: 20px; margin-bottom: 30px;">Are you sure delete this sub category?</p>
        <button id="confirmButton" class="btn btn-danger" >Yes, Delete</button>
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
