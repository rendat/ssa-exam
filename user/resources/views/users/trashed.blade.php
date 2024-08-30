@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Trashed Users</h1>
    <a href="/users" class="btn btn-danger">Back</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Prefix</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>Suffix</th>
                <th>Username</th>
                <th>Email</th>
                <th>Photo</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($trashedUsers as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->prefixname }}</td>
                    <td>{{ $user->firstname }}</td>
                    <td>{{ $user->middlename }}</td>
                    <td>{{ $user->lastname }}</td>
                    <td>{{ $user->suffixname }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->photo)
                            <img src="{{ asset('storage/' . $user->photo) }}" alt="User Photo" width="50" height="50">
                        @else
                            No Photo
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('users.restore', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-primary btn-sm">Restore User</button>
                        </form>
                        <!-- Permanently Delete Button -->
                        <form action="{{ route('users.forceDelete', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete Permanently</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
