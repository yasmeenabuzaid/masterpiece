@extends("layouts.dashboard_master")
@section("content")

<div class="nav-profile-text d-flex flex-column">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h3><i class="fas fa-edit me-2"></i> - Edit This Salon</h3>
                <br>
                <p>⭐ Please make your edits clear and applicable to all your subsidiary beauty salons.</p>

                <hr>
                <br>
                <form id="editForm" action="{{ route('salons.update', $salon->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Salon Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Insert your edit name" value="{{ old('name', $salon->name) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Salon Description</label>
                        <input type="text" class="form-control" id="description" name="description" placeholder="Insert your edit description" value="{{ old('description', $salon->description) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="image">File Upload</label>
                        <input type="file" name="image" id="fileUpload" class="form-control">
                        The old image:
                        @if($salon->image)
                            <img src="{{ asset($salon->image) }}" alt="Current Image" style="max-width: 100px; margin-top: 10px;">
                        @endif
                    </div>

                    <button type="submit" class="btn btn-gradient-success btn-fw" onclick="confirmEdit(event)">Submit Update</button>
                    <a href="{{ route('salons.index') }}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="confirmationModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; z-index: 1000; padding:20px ">
    <div style="background: #fff; padding: 20px; border-radius: 5px; text-align: center;">
        <h3><i class="fas fa-pencil-alt" style="font-size: 2rem; color: #007bff;"></i></h3>
        <p>Are you sure you want to edit this salon?</p>
        <button id="confirmButton" class="btn btn-primary">Edit</button>
        <button id="cancelButton" class="btn btn-secondary">Cancel</button>
    </div>
</div>


<script>
    function confirmEdit(event) {
        event.preventDefault();
        var modal = document.getElementById('confirmationModal');
        var confirmButton = document.getElementById('confirmButton');
        var cancelButton = document.getElementById('cancelButton');
        modal.style.display = 'flex';

        confirmButton.onclick = function() {
            document.getElementById('editForm').submit();
        };

        cancelButton.onclick = function() {
            modal.style.display = 'none';
        };
    }
</script>

@endsection
