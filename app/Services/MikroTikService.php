<?php

namespace App\Services;

use RouterOS\Client;
use RouterOS\Query;

class MikroTikService
{
    protected $API;
    public function __construct($host, $user, $pass, $port = 8728)
    {
        $this->API = new Client([
            'host' => $host,
            'user' => $user,
            'pass' => $pass,
            'port' => $port,
        ]);
    }

    /**
     * Connect to the MikroTik router
     */
    public function connect()
    {
        return $this->API->connect();
    }

    /**
     * Get active connections from MikroTik router
     */
    public function getActiveConnections()
    {
        if ($this->connect()) {
            $query = new Query('/interface/print');  // Query to fetch active connections
            $response = $this->API->query($query)->read();
            $this->API->disconnect();
            return $response;
        }

        return 'Error: Unable to connect to MikroTik Router';
    }

    /**
     * Get bandwidth usage data from MikroTik router
     */
    public function getBandwidthUsage()
    {
        if ($this->connect()) {
            $query = new Query('/interface/ethernet/print');  // Query for Ethernet interface stats
            $response = $this->API->query($query)->read();
            $this->API->disconnect();
            return $response;
        }

        return 'Error: Unable to fetch bandwidth data';
    }

    /**
     * Add user to the MikroTik router
     */
    public function addUser($username, $password, $profile)
    {
        if ($this->connect()) {
            $query = new Query('/ppp/secret/add');
            $query->equal('name', $username);
            $query->equal('password', $password);
            $query->equal('profile', $profile);  // e.g., 'default' profile
            $this->API->query($query);
            $this->API->disconnect();
        }
    }

    /**
     * Delete a user from MikroTik router
     */
    public function deleteUser($username)
    {
        if ($this->connect()) {
            $query = new Query('/ppp/secret/remove');
            $query->equal('name', $username);
            $this->API->query($query);
            $this->API->disconnect();
        }
    }
}
