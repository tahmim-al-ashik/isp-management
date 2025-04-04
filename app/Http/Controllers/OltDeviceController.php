<?php

namespace App\Http\Controllers;

use App\Models\OltDevice;
use Illuminate\Http\Request;

class OltDeviceController extends Controller
{
    // Show all OLT devices
    public function showDevices()
    {
        $oltDevices = OltDevice::all();  // Get all OLT devices from the database
        return view('admin.olt_devices', compact('oltDevices'));
    }
    public function addDeviceForm()
    {
        return view('admin.add_olt_device'); // This is the form to add an OLT device
    }
    // Add a new OLT device
    public function addDevice(Request $request)
    {
        // Validate form input
        $request->validate([
            'name' => 'required',
            'ip_address' => 'required|ip',
            'api_url' => 'required|url',
            'username' => 'required',
            'password' => 'required',
        ]);

        // Create new OLT device in the database
        OltDevice::create([
            'name' => $request->name,
            'ip_address' => $request->ip_address,
            'api_url' => $request->api_url,
            'username' => $request->username,
            'password' => $request->password,
        ]);

        // Redirect to the devices page
        return redirect()->route('admin.olt.devices')->with('success', 'OLT Device added successfully');
    }

    // Show a specific OLT device details (usage/reports)
    public function showOltStats($deviceId)
    {
        $oltDevice = OltDevice::findOrFail($deviceId);

        // You can implement further logic here to interact with the OLT device via its API
        // For now, we'll just pass the device info to the view
        return view('admin.olt_stats', compact('oltDevice'));
    }

    // Edit OLT device
    public function editDevice($deviceId)
    {
        $oltDevice = OltDevice::findOrFail($deviceId);
        return view('admin.edit_olt_device', compact('oltDevice'));
    }

    // Update OLT device
    public function updateDevice(Request $request, $deviceId)
    {
        $request->validate([
            'name' => 'required',
            'ip_address' => 'required|ip',
            'api_url' => 'required|url',
            'username' => 'required',
            'password' => 'required',
        ]);

        $oltDevice = OltDevice::findOrFail($deviceId);
        $oltDevice->update($request->all());

        return redirect()->route('admin.olt.devices')->with('success', 'OLT Device Updated');
    }

    // Delete an OLT device
    public function deleteDevice($deviceId)
    {
        $oltDevice = OltDevice::findOrFail($deviceId);
        $oltDevice->delete();

        return redirect()->route('admin.olt.devices')->with('success', 'OLT Device Deleted');
    }
}
