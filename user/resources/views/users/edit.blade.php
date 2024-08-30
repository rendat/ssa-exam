@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Edit User</h4>
                </div>
                <x-alert />
                <div class="card-body">
                    <!-- Form to Edit User -->
                    <a href="/users" class="btn btn-danger btn-sm">Back</a>
                    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="prefixname" class="col-md-4 col-form-label text-md-right">Prefix Name</label>
                            <div class="col-md-6">
                                <select id="prefixname" class="form-control" name="prefixname">
                                    <option value="" disabled>Select Prefix</option>
                                    <option value="Mr" {{ old('prefixname', $user->prefixname) == 'Mr' ? 'selected' : '' }}>Mr</option>
                                    <option value="Mrs" {{ old('prefixname', $user->prefixname) == 'Mrs' ? 'selected' : '' }}>Mrs</option>
                                    <option value="Ms" {{ old('prefixname', $user->prefixname) == 'Ms' ? 'selected' : '' }}>Ms</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="firstname" class="col-md-4 col-form-label text-md-right">First Name</label>
                            <div class="col-md-6">
                                <input id="firstname" type="text" class="form-control" name="firstname" value="{{ old('firstname', $user->firstname) }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="middlename" class="col-md-4 col-form-label text-md-right">Middle Name</label>
                            <div class="col-md-6">
                                <input id="middlename" type="text" class="form-control" name="middlename" value="{{ old('middlename', $user->middlename) }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="lastname" class="col-md-4 col-form-label text-md-right">Last Name</label>
                            <div class="col-md-6">
                                <input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname', $user->lastname) }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="suffixname" class="col-md-4 col-form-label text-md-right">Suffix Name</label>
                            <div class="col-md-6">
                                <input id="suffixname" type="text" class="form-control" name="suffixname" value="{{ old('suffixname', $user->suffixname) }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">Username</label>
                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" value="{{ old('username', $user->username) }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email Address</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="photo" class="col-md-4 col-form-label text-md-right">Profile Photo</label>
                            <div class="col-md-6">
                                <input id="photo" type="file" class="form-control-file" name="photo" accept="image/*">
                                @if($user->photo)
                                    <img src="{{ asset('storage/' . $user->photo) }}" alt="User Photo" width="100" class="mt-2">
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                    Update User
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
