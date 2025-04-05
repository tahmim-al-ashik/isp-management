<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class OltDeviceService
{
    protected $apiUrl;
    protected $username;
    protected $password;

    public function __construct($apiUrl, $username, $password)
    {
        $this->apiUrl = $apiUrl;
        $this->username = $username;
        $this->password = $password;
    }

    // Fetch OLT device stats
    public function getStats()
    {

        $response = Http::withBasicAuth($this->username, $this->password)
            ->get($this->apiUrl . '/api/v1/stats'); // Assuming a REST API endpoint

        // Check if the request was successful
        if ($response->successful()) {
            return $response->json(); // Return the response data
        }

        // Return null or handle the error in case of failure
        return null;
    }
}
