<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form to Edit User -->
                <form id="editUserForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Prefix Name Dropdown -->
                    <div class="form-group">
                        <label for="prefixname">Prefix Name</label>
                        <select id="prefixname" class="form-control" name="prefixname" required>
                            <option value="" disabled>Select Prefix</option>
                            <option value="Mr" {{ old('prefixname', $user->prefixname) == 'Mr' ? 'selected' : '' }}>Mr</option>
                            <option value="Mrs" {{ old('prefixname', $user->prefixname) == 'Mrs' ? 'selected' : '' }}>Mrs</option>
                            <option value="Ms" {{ old('prefixname', $user->prefixname) == 'Ms' ? 'selected' : '' }}>Ms</option>
                        </select>
                    </div>

                    <!-- First Name -->
                    <div class="form-group">
                        <label for="firstname">First Name</label>
                        <input id="firstname" type="text" class="form-control" name="firstname" value="{{ old('firstname', $user->firstname) }}" required>
                    </div>

                    <!-- Middle Name -->
                    <div class="form-group">
                        <label for="middlename">Middle Name</label>
                        <input id="middlename" type="text" class="form-control" name="middlename" value="{{ old('middlename', $user->middlename) }}">
                    </div>

                    <!-- Last Name -->
                    <div class="form-group">
                        <label for="lastname">Last Name</label>
                        <input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname', $user->lastname) }}" required>
                    </div>

                    <!-- Suffix Name -->
                    <div class="form-group">
                        <label for="suffixname">Suffix Name</label>
                        <input id="suffixname" type="text" class="form-control" name="suffixname" value="{{ old('suffixname', $user->suffixname) }}">
                    </div>

                    <!-- Username -->
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input id="username" type="text" class="form-control" name="username" value="{{ old('username', $user->username) }}" required>
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" required>
                    </div>

                    <!-- Profile Photo -->
                    <div class="form-group">
                        <label for="photo">Profile Photo</label>
                        <input id="photo" type="file" class="form-control" name="photo" accept="image/*">
                        @if($user->photo)
                            <img src="{{ asset('storage/' . $user->photo) }}" alt="User Photo" width="100" class="mt-2">
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">
                            Update User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
