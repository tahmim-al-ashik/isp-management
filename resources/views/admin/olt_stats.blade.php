@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>OLT Device Stats</h1>

        <h3>Device Name: {{ $oltDevice->name }}</h3>
        <p>IP Address: {{ $oltDevice->ip_address }}</p>
        <p>API URL: {{ $oltDevice->api_url }}</p>

        <h4>Stats:</h4>
        @if ($stats)
            <ul>
                <li>Uptime: {{ $stats['uptime'] }}</li>
                <li>Throughput: {{ $stats['throughput'] }}</li>
                <li>Latency: {{ $stats['latency'] }}</li>
                <li>Packet Loss: {{ $stats['packet_loss'] }}</li>
            </ul>
        @else
            <p>No stats available or error fetching data from OLT device.</p>
        @endif
    </div>
@endsection
