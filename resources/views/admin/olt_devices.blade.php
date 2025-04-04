@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>OLT Devices</h1>

        <a href="{{ route('admin.olt.device.add') }}" class="btn btn-primary">Add OLT Device</a>

        <h3>Existing OLT Devices</h3>
        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>IP Address</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($oltDevices as $oltDevice)
                <tr>
                    <td>{{ $oltDevice->name }}</td>
                    <td>{{ $oltDevice->ip_address }}</td>
                    <td>
                        <a href="{{ route('admin.olt.device.stats', $oltDevice->id) }}" class="btn btn-info">View Stats</a>
                        <a href="{{ route('admin.olt.device.edit', $oltDevice->id) }}" class="btn btn-warning">Edit</a>
                        <a href="{{ route('admin.olt.device.delete', $oltDevice->id) }}" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
