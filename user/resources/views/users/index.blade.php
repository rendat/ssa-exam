@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Users List</h1>
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
            @foreach ($users as $user)
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
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#userModal" onclick="loadUserData({{ $user->id }})">
                            View
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- User Details Modal -->
    <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalLabel">User Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="userModalBody">
                    <!-- User details will be loaded here via JavaScript -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function loadUserData(userId) {
    fetch(`/users/${userId}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('userModalBody').innerHTML = `
                <ul class="list-unstyled">
                    <li><strong>ID:</strong> ${data.id}</li>
                    <li><strong>Prefix:</strong> ${data.prefixname}</li>
                    <li><strong>First Name:</strong> ${data.firstname}</li>
                    <li><strong>Middle Name:</strong> ${data.middlename}</li>
                    <li><strong>Last Name:</strong> ${data.lastname}</li>
                    <li><strong>Suffix:</strong> ${data.suffixname}</li>
                    <li><strong>Username:</strong> ${data.username}</li>
                    <li><strong>Email:</strong> ${data.email}</li>
                    <li>
                        <strong>Photo:</strong>
                        ${data.photo ? `<img src="/storage/${data.photo}" alt="User Photo" width="100">` : 'No Photo'}
                    </li>
                </ul>
            `;
        });
}
</script>
@endsection
