<!-- resources/views/users/index.blade.php -->

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
    <x-alert />
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
              
                <th>Full Name</th>
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
                
                    <td>{{ $user->fullname }}</td> <!-- Use the fullname accessor -->
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <img src="{{ $user->avatar }}" alt="User Photo" width="60" height="60">
                    
                    </td>
                    <td>
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#userModal" onclick="loadUserData({{ $user->id }})">
                            View
                        </button>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">
                            Edit
                        </a>
                        <button type="button" class="btn btn-danger btn-sm" onclick="deleteUser({{ $user->id }})">
                            Soft Delete
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    

    <!-- Include Create User Modal -->
    @include('users.create')

<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: .3rem; border: 1px solid #007bff;">
            <div class="modal-header" style="background-color: #007bff; color: #fff;">
                <h5 class="modal-title" id="userModalLabel">User Details</h5>
                <button type="button" class="btn-close" style="filter: invert(1);" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="userModalBody" style="padding: 1.25rem;">
              
            </div>
            <div class="modal-footer" style="border-top: 1px solid #007bff;">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


   
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
        fetch(`{{ route('users.show', ':id') }}`.replace(':id', userId))
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
                            <img src="${data.photo}" alt="User Photo" width="100">
                        </li>
                    </ul>
                `;
            });
    }

   function populateEditForm(userId) {
    console.log("User ID passed to populateEditForm:", userId); // Log the userId
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
                photoPreview.innerHTML = `<img src="${data.photo}" alt="User Photo" width="100">`;
            } else {
                photoPreview.innerHTML = ''; // Clear the preview if no photo
            }
        })
        .catch(error => {
            console.error('Error fetching user data:', error);
        });
}

    
</script>
@endsection
