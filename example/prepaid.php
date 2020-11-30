<?php

use ofi\mobilepulsa\mobilepulsa;

/**
 * Refrence to
 * https://developer.mobilepulsa.net/documentation#api-Pre_Paid_Flow
 */

class prepaid {

    protected $client;

    public function __construct()
    {
        $username = '089655541804';
        $apikey = '1195eaba63dc90ee';
        $this->client = new mobilepulsa($username, $apikey);
        return $this->client;
    }

    public function daftarHarga()
    {
        return $this->client->prepaid() -> pricelist('pulsa', 'indosat');
    }

    public function cekIdPemain()
    {
        // contoh, mengecek id pemain free fire (dalam development mode)
        return $this->client->prepaid() -> checkGameId('156378300|8483', 103);
    }

    public function daftarServerGame()
    {
        // cek daftar server game mobile legend
        return $this->client->prepaid() -> gameServerList(103);
    }

}