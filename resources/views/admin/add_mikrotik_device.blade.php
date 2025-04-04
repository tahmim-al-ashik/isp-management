@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add MikroTik Device</h1>

        <form action="{{ route('admin.mikrotik.device.store') }}" method="POST">
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
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="port">Port</label>
                <input type="text" name="port" id="port" class="form-control" value="8728" required>
            </div>

            <button type="submit" class="btn btn-success">Add Device</button>
        </form>
    </div>
@endsection
