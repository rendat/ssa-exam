
    <!-- Modal for Creating a New User -->
    <div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createUserModalLabel">Create New User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Prefix Name Dropdown -->
                        <div class="form-group">
                            <label for="prefixname">Prefix Name</label>
                            <select id="prefixname" class="form-control" name="prefixname" required>
                                <option value="" disabled selected>Select Prefix</option>
                                <option value="Mr">Mr</option>
                                <option value="Mrs">Mrs</option>
                                <option value="Ms">Ms</option>
                            </select>
                        </div>

                        <!-- First Name -->
                        <div class="form-group">
                            <label for="firstname">First Name</label>
                            <input id="firstname" type="text" class="form-control" name="firstname" value="{{ old('firstname') }}" required>
                        </div>

                        <!-- Middle Name -->
                        <div class="form-group">
                            <label for="middlename">Middle Name</label>
                            <input id="middlename" type="text" class="form-control" name="middlename" value="{{ old('middlename') }}">
                        </div>

                        <!-- Last Name -->
                        <div class="form-group">
                            <label for="lastname">Last Name</label>
                            <input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" required>
                        </div>

                        <!-- Suffix Name -->
                        <div class="form-group">
                            <label for="suffixname">Suffix Name</label>
                            <input id="suffixname" type="text" class="form-control" name="suffixname" value="{{ old('suffixname') }}">
                        </div>

                        <!-- Username -->
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required>
                        </div>

                        <!-- Email -->
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                        </div>

                        <!-- Password -->
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input id="password" type="password" class="form-control" name="password" required>
                        </div>

                        <!-- Confirm Password -->
                        <div class="form-group">
                            <label for="password-confirm">Confirm Password</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>

                        <!-- Profile Photo -->
                        <div class="form-group">
                            <label for="photo">Profile Photo</label>
                            <input id="photo" type="file" class="form-control" name="photo" accept="image/*">
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">
                                Create User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>