@extends('layouts.dashboard_master')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center ">
        <h3 class="title-1">Sub Salons</h3>

        <a href="{{ route('subsalons.create') }}">
            <button type="button" class="btn btn-gradient-success btn-rounded btn-fw"><i class="fa-solid fa-plus" style="margin-right: 5px"></i>
                 Add New Sub Salon
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
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Salon Name</th>
                                    <th>Description</th>
                                    <th>Address</th>
                                    <th>User Count</th> <!-- إضافة عمود عدد المستخدمين -->
                                    <th>Phone</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($subsalons->isEmpty())
                                    <tr>
                                        <td colspan="9" class="text-center">No Sub Salons Available</td>
                                    </tr>
                                @else
                                    @foreach($subsalons as $subsalon)
                                        <tr>
                                            <td>
                                                @if($subsalon->salon->image)
                                                    <img src="{{ asset($subsalon->salon->image) }}" alt="Image" class="me-2" >{{ $subsalon->name }}
                                                @else
                                                {{ $subsalon->name }}

                                                @endif
                                            </td>                                            <td>{{ $subsalon->salon->name }}</td>
                                            {{-- <td>{{ $subsalon->users()->count() }}</td> <!-- إضافة عدد المستخدمين --> --}}

                                            <td>{{ $subsalon->description }}</td>
                                            <td>{{ $subsalon->address }}</td>
                                            <td>{{ $subsalon->phone }}</td>
                                            <td>
                                                {{ $subsalon->created_at->format('Y-m-d') }}<br>
                                                {{ $subsalon->created_at->format('H:i') }}
                                            </td>                                            <td>
                                                {{-- <a href="{{ route('subsalons.edit', $subsalon->id) }}">
                                                    <button type="button" class="btn btn-secondary">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>
                                                </a> --}}
                                                {{-- <button type="button" class="btn btn-danger" onclick="confirmDeletion(event, '{{ route('subsalons.destroy', $subsalon->id) }}')">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button> --}}
                                                {{-- ========================== --}}
                                                <button type="button" class="btn btn-gradient-danger btn-rounded btn-icon" onclick="confirmDeletion(event, '{{ route('subsalons.destroy', $subsalon->id) }}')">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                                <a href="{{route('subsalons.show',$subsalon->id)}}">
                                                <button type="button" class="btn btn-gradient-dark btn-rounded btn-icon">
                                                  <i class="fa-solid fa-eye"></i>
                                               </button>
                                               </a>
                                               <a href="{{ route('subsalons.edit', $subsalon->id) }}">
                                                <button type="button" class="btn btn-gradient-info btn-rounded btn-icon">
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
