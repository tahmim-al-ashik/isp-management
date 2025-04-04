<!-- resources/views/admin/mikrotik_stats.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Stats for {{ $device->name }} ({{ $device->ip_address }})</h1>

        <h3>Active Connections</h3>
        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>IP Address</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach($activeConnections as $connection)
                <tr>
                    <td>{{ $connection['name'] }}</td>
                    <td>{{ $connection['address'] ?? 'N/A' }}</td>
                    <td>{{ $connection['status'] == 1 ? 'Active' : 'Inactive' }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <h3>Bandwidth Usage</h3>
        <table class="table">
            <thead>
            <tr>
                <th>Interface</th>
                <th>Received (Bytes)</th>
                <th>Sent (Bytes)</th>
            </tr>
            </thead>
            <tbody>
            @foreach($bandwidthUsage as $usage)
                <tr>
                    <td>{{ $usage['name'] }}</td>
                    <td>{{ $usage['rx-byte'] ?? 'N/A' }}</td>
                    <td>{{ $usage['tx-byte'] ?? 'N/A' }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
