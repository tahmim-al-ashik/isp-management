<!-- resources/views/admin/mikrotik_devices.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>MikroTik Devices</h1>

        <a href="{{ route('admin.mikrotik.device.add') }}" class="btn btn-primary">Add MikroTik Device</a>

        <h3>Existing MikroTik Devices</h3>
        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>IP Address</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($devices as $device)
                <tr>
                    <td>{{ $device->name }}</td>
                    <td>{{ $device->ip_address }}</td>
                    <td>
                        <a href="{{ route('admin.mikrotik.stats', $device->id) }}" class="btn btn-info">View Stats</a>
                        <a href="#" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
