@extends('layouts.dashboard_master')

@section('content')
    <div class="container">
        <h3><i class="fas fa-cut me-2"></i> - Active Salons</h3>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Salon Name</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($salons as $salon)
                        <tr>
                            <td>{{ $salon->name }}</td>
                            <td>{{ $salon->created_at->format('Y-m-d') }}</td>
                            <td>
                                <a href="{{ route('salons.edit', $salon->id) }}">Edit</a>
                                <form action="{{ route('salons.destroy', $salon->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
