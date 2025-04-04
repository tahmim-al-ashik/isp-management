<?php

namespace App\Http\Controllers;

use App\Models\MikroTikDevice;
use App\Services\MikroTikService;
use Illuminate\Http\Request;

class MikroTikController extends Controller
{
    // Show all MikroTik devices
    public function showDevices()
    {
        $devices = MikroTikDevice::all();  // Get all MikroTik devices from the database
        return view('admin.mikrotik_devices', compact('devices'));
    }

    public function addDeviceForm()
    {
        return view('admin.add_mikrotik_device'); // This is the form to add a MikroTik device
    }
    public function addDevice(Request $request)
    {
        // Validate form input
        $request->validate([
            'name' => 'required',
            'ip_address' => 'required|ip',
            'username' => 'required',
            'password' => 'required',
            'port' => 'required|integer',
        ]);

        // Create new MikroTik device in the database
        MikroTikDevice::create([
            'name' => $request->name,
            'ip_address' => $request->ip_address,
            'username' => $request->username,
            'password' => $request->password,
            'port' => $request->port,
        ]);

        // Redirect to the devices page
        return redirect()->route('admin.mikrotik.devices')->with('success', 'MikroTik Device added successfully');
    }
    // Show MikroTik device stats (active connections, bandwidth usage, etc.)
    public function showMikrotikStats($deviceId)
    {
        // Get the selected MikroTik device's configuration
        $device = MikroTikDevice::findOrFail($deviceId);

        // Use the MikroTikService to interact with the MikroTik router
        $mikrotikService = new MikroTikService($device->ip_address, $device->username, $device->password, $device->port);
        $activeConnections = $mikrotikService->getActiveConnections();
        $bandwidthUsage = $mikrotikService->getBandwidthUsage();

        return view('admin.mikrotik_stats', compact('activeConnections', 'bandwidthUsage', 'device'));
    }

    // Add a user to a MikroTik device
    public function addUserToMikrotik(Request $request)
    {
        // Validate user input
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'mikrotik_device_id' => 'required|exists:mikrotik_devices,id',
        ]);

        $device = MikroTikDevice::find($request->mikrotik_device_id);
        $mikrotikService = new MikroTikService($device->ip_address, $device->username, $device->password, $device->port);

        // Add the user to the MikroTik device
        $mikrotikService->addUser($request->username, $request->password, 'default');  // 'default' profile for example

        // Redirect to the devices page
        return redirect()->route('admin.mikrotik.devices')->with('success', 'User added successfully');
    }

    // Delete a user from MikroTik device
    public function deleteUserFromMikrotik($username)
    {
        // Find the MikroTik device and delete the user
        $device = MikroTikDevice::first();  // For simplicity, using the first device; can be dynamic
        $mikrotikService = new MikroTikService($device->ip_address, $device->username, $device->password, $device->port);

        $mikrotikService->deleteUser($username);

        return redirect()->route('admin.mikrotik.devices')->with('success', 'User deleted successfully');
    }

    // Show MikroTik device usage stats (optional - for user usage or statistics)
    public function showUserStats($deviceId)
    {
        $device = MikroTikDevice::findOrFail($deviceId);

        $mikrotikService = new MikroTikService($device->ip_address, $device->username, $device->password, $device->port);
        $usageStats = $mikrotikService->getUsageStats(); // Example method for usage stats

        return view('admin.mikrotik_user_stats', compact('usageStats', 'device'));
    }
}
