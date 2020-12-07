<?php

use ofi\mobilepulsa\mobilepulsa;

/**
 * Refrensi
 * https://developer.mobilepulsa.net/documentation#kai-section
 */

class train {

    protected $client;

    public function __construct()
    {
        $username = '089655541804';
        $apikey = '1195eaba63dc90ee';
        $this->client = new mobilepulsa($username, $apikey);
        return $this->client;
    }

    /**
     * Refrensi
     * https://developer.mobilepulsa.net/documentation#kai-price-list
     */
    public function daftarStasiunKereta()
    {
        return $this->client -> train()
                             -> stationList();
    }

}