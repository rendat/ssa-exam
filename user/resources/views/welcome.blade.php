@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>

    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Main Content -->
    <div class="container d-flex flex-column justify-content-center align-items-center min-vh-100">
        <h1 class="display-4 mb-4">Welcome to SSA-Examination</h1>
        <p class="lead mb-4">Please choose an option to proceed:</p>
        <a href="{{ route('login') }}" class="btn btn-primary btn-lg mb-2" role="button">Login</a>
        <a href="{{ route('register') }}" class="btn btn-secondary btn-lg" role="button">Register</a>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
</body>
</html>
@endsection
