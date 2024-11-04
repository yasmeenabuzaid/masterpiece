@extends('layouts.dashboard_master')

@section('content')
    <div class="container">
        <h3><i class="fas fa-cut me-2"></i> - Trashed Salons</h3>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Salon Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($salons as $salon)
                                <tr>
                                    <td>{{ $salon->name }}</td>
                                    <td>
                                        <form action="{{ route('salons.restore', $salon->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-success">Restore</button>
                                        </form>
                                        <form action="{{ route('salons.destroy', $salon->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete Permanently</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
