@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add OLT Device</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('admin.olt.device.store') }}" method="POST">


            @csrf
            <div class="form-group">
                <label for="name">Device Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="ip_address">IP Address</label>
                <input type="text" name="ip_address" id="ip_address" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="api_url">API URL</label>
                <input type="text" name="api_url" id="api_url" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success">Add Device</button>
        </form>
    </div>
@endsection
