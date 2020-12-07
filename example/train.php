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
     * Pricelist booking kereta
     * Refrensi
     * https://developer.mobilepulsa.net/documentation#kai-price-list
     */

    public function daftarHarga()
    {
        return $this->client -> train()
                             -> priceListBookTrain();
    }

    /**
     * Daftar stasiun yang ada
     * Refrensi
     * https://developer.mobilepulsa.net/documentation#kai-price-list
     */
    public function daftarStasiunKereta()
    {
        return $this->client -> train()
                             -> stationList();
    }

    /**
     * Cari kereta
     * Refrensi
     * https://developer.mobilepulsa.net/documentation#kai-search-train
     */
    public function cariKereta()
    {
        $org = "GMR"; //Origin Station Code (GAMBIR)
        $dest = "BD"; //Destination Station Code (BANDUNG)
        $date = '2019-11-29'; //Departure Date
        return $this->client -> train()
                             -> searchTrain($org, $dest, $date);
    }

}