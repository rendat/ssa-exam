@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Users List</h1>
    
    <!-- Button to Open Modal for Creating a New User -->
    <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#createUserModal">
        Create New User
    </button>
    <!-- Button to View Trashed Users -->
    <a href="{{ route('users.trashed') }}" class="btn btn-secondary mb-4">
        View Trashed Users
    </a>

    <!-- Users Table -->
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
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editUserModal" onclick="populateEditForm({{ $user->id }})">
                            Edit
                        </button>
                        <button type="button" class="btn btn-danger btn-sm" onclick="deleteUser({{ $user->id }})">
                            Soft Delete
                        </button>
                        
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @include('users.create')

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
        @include('users.edit')
</div>  

<script>
    function deleteUser(userId) {
    if (confirm('Are you sure you want to delete this user?')) {
        fetch(`/users/${userId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('User deleted successfully!');
                location.reload(); // Refresh the page to reflect changes
            } else {
                alert('Error deleting user.');
            }
        });
    }
}

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

function populateEditForm(userId) {
    fetch(`/users/${userId}/edit`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('editUserForm').action = `/users/${data.id}`;
            document.getElementById('prefixname').value = data.prefixname;
            document.getElementById('firstname').value = data.firstname;
            document.getElementById('middlename').value = data.middlename;
            document.getElementById('lastname').value = data.lastname;
            document.getElementById('suffixname').value = data.suffixname;
            document.getElementById('username').value = data.username;
            document.getElementById('email').value = data.email;

            // Display the existing photo if available
            const photoPreview = document.getElementById('photoPreview');
            if (data.photo) {
                photoPreview.innerHTML = `<img src="/storage/${data.photo}" alt="User Photo" width="100">`;
            } else {
                photoPreview.innerHTML = 'No Photo';
            }
        });
}


</script>
@endsection
