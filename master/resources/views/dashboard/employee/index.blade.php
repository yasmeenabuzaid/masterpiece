@extends('layouts.dashboard_master')


@section('content')
<div class="container">



    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="title-1">employees</h2>
        <a href="{{ route('employees.create') }}">
            <button type="button" class="btn btn-primary">
                <i class="zmdi zmdi-plus"></i> Add New employee
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
                        <th scope="col">first_name</th>
                        <th scope="col">last_name</th>
                        <th scope="col">email</th>
                        <th scope="col">password</th>
                        <th scope="col">sub salons name</th>
                        <th scope="col">Date</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($employees as $employee)
                        <tr>
        
                            <th scope="row">{{ $employee->id }}</th>
                            <th scope="row">{{ $employee->first_name }}</th>
                            <th scope="row">{{ $employee->last_name }}</th>
                            <th scope="row">{{ $employee->email }}</th>
                            <th scope="row">{{ $employee->password }}</th>
                            <td scope="row">{{ $employee->subsalon->name }}</td>

                            <td>{{ $employee->created_at->format('Y-m-d') }}</td>
                             <th scope="row">
                                <a href="{{ route('employees.edit', $employee->id) }}">
                                    <button type="button" class="btn btn-secondary"><i class="fa-solid fa-pen-to-square"></i></button>

                                </a>

                                <button type="button" class="btn btn-danger" onclick="confirmDeletion(event, '{{ route('employees.destroy', $employee->id) }}')"><i class="fa-solid fa-trash"></i></button>
                            </th>
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
        <p>Are you sure you want to delete this category?</p>
        <button id="confirmButton" class="btn btn-danger">Confirm</button>
        <button id="cancelButton" class="btn btn-secondary">Cancel</button>
    </div>
</div>

<script>
    function confirmDeletion(event, url) {
        event.preventDefault(); // Prevent the default form submission -. تريد منع نموذج من الإرسال عند النقر على زر الإرسال
        var modal = document.getElementById('confirmationModal');
        var confirmButton = document.getElementById('confirmButton');
        var cancelButton = document.getElementById('cancelButton');

        // Show the custom confirmation dialog
        modal.style.display = 'flex';

        // Set up the confirm button to submit the form
        confirmButton.onclick = function() {
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = url;

            var csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            // "hidden" يُستخدم للإشارة إلى طرق مختلفة لجعل العناصر غير مرئية أو مخفية
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}'; // Laravel CSRF token
            form.appendChild(csrfToken);

            var methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'DELETE';
            form.appendChild(methodField);

            document.body.appendChild(form);
            form.submit();
        };

        // Set up the cancel button to hide the modal
        cancelButton.onclick = function() {
            modal.style.display = 'none';
        };
    }
</script>
@endsection
