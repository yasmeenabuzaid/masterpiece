@extends('layouts.dashboard_master')

@section('content')
@if (auth()->check() && auth()->user()->isSuperAdmin())
<div class="container">
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="title-1">Salons</h3>
        @if (auth()->check() && auth()->user()->isSuperAdmin())
        <a href="{{ route('salons.create') }}">
            <button type="button" class="btn btn-success btn-rounded btn-fw"><i class="fa-solid fa-plus" style="margin-right: 5px"></i>  Add New Salon</button>
        </a>
        @endif
    </div>
    <div class="row">
        <div class="col-12 grid-margin">
          <div class="card">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-bordered" style="table-layout: fixed; width: 100%;">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            {{-- <th>Address</th>
                            <th>Description</th> --}}
                            <th>Date</th>
                            @if (auth()->check() && auth()->user()->isSuperAdmin())
                            <th>Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @if($salons->isNotEmpty())
                        @foreach($salons as $salon)
                        <tr>
                            <td>
                                @if($salon->image)
                                    <img src="{{ asset($salon->image) }}" alt="Salon Image" class="me-2" style="border-radius: 3px; width: 100px;">
                                @else
                                    <span>No image found</span>
                                @endif
                            </td>
                            <td>{{ $salon->name }}</td>
                            {{-- <td>{{ $salon->address }}</td>
                            <td style="max-width: 200px; word-wrap: break-word;">
                                {{ $salon->description }}
                            </td> --}}
                            <td>
                                Date: {{ $salon->created_at->format('Y-m-d') }}<br>
                                Time: {{ $salon->created_at->format('H:i') }}
                            </td>
                            @if (auth()->check() && auth()->user()->isSuperAdmin())
                            <td>
                                <button type="button" class="btn btn-danger btn-rounded btn-icon" onclick="confirmDeletion(event, '{{ route('salons.destroy', $salon->id) }}')">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                                <a href="{{ route('salons.edit', $salon->id) }}">
                                    <button type="button" class="btn btn-info btn-rounded btn-icon">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                </a>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="{{ auth()->check() && auth()->user()->isSuperAdmin() ? '6' : '5' }}" class="text-center">
                                No salons available
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>

              </div>
            </div>
          </div>
        </div>
      </div>

    {{-- <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive table--no-card m-b-40">
                <table class="table table-bordered bg-white">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Image</th>
                        <th scope="col">Address</th>
                        <th scope="col">Description</th>
                        <th scope="col">Date</th>
                        @if (auth()->check() && auth()->user()->isSuperAdmin())
                        <th scope="col">Actions</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                        @if($salons->isNotEmpty())
                            @foreach($salons as $salon)
                                <tr>
                                    <th scope="row">{{ $salon->id }}</th>
                                    <td>{{ $salon->name }}</td>
                                    <td>
                                        @if($salon->image)
                                            <img src="{{ asset($salon->image) }}" alt="Salon Image" style="width: 100px; border-radius: 0px;">
                                        @else
                                            <span>No Image</span>
                                        @endif
                                    </td>
                                    <td>{{ $salon->address }}</td>
                                    <td>{{ $salon->description }}</td>
                                    <td>{{ $salon->created_at->format('Y-m-d H:i') }}</td>
                                    @if (auth()->check() && auth()->user()->isSuperAdmin())
                                        <td>
                                            <a href="{{ route('salons.edit', $salon->id) }}">
                                                <button type="button" class="btn btn-secondary">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                            </a>
                                            <button type="button" class="btn btn-danger" onclick="confirmDeletion(event, '{{ route('salons.destroy', $salon->id) }}')">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="{{ auth()->check() && auth()->user()->isSuperAdmin() ? '7' : '6' }}" class="text-center">
                                    No available salons.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div> --}}
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
@endif
@endsection
