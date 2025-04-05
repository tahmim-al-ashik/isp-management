<?php

namespace App\Http\Controllers;

use App\Models\OltDevice;
use App\Services\OltDeviceService;
use Illuminate\Http\Request;

class OltDeviceController extends Controller
{
    public function showDevices()
    {
        $oltDevices = OltDevice::all();  // Get all OLT devices from the database
        return view('admin.olt_devices', compact('oltDevices'));
    }

    // Show OLT stats
    public function showOltStats($deviceId)
    {
        // Get the OLT device by ID
        $oltDevice = OltDevice::findOrFail($deviceId);

        // Instantiate the OltDeviceService to interact with the OLT API
        $oltService = new OltDeviceService(
            $oltDevice->api_url,
            $oltDevice->username,
            $oltDevice->password
        );

        // Fetch OLT stats
        $stats = $oltService->getStats();

        // Pass stats to the view
        return view('admin.olt_stats', compact('oltDevice', 'stats'));
    }

    // Add OLT Device
    public function addDevice(Request $request)
    {
        // Validate the form input
        $request->validate([
            'name' => 'required',
            'ip_address' => 'required|ip',
            'api_url' => 'required|url',
            'username' => 'required',
            'password' => 'required',
        ]);

        // Create new OLT device in the database
        OltDevice::create($request->all());

        // Redirect to the devices page
        return redirect()->route('admin.olt.devices');
    }
    public function addDeviceForm()
    {
        return view('admin.add_olt_device'); // This is the form to add an OLT device
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
