<?php

use ofi\mobilepulsa\mobilepulsa;

class checkBalance {

    protected $client;

    public function __construct()
    {
        $username = '089655541804';
        $apikey = '1195eaba63dc90ee';
        $this->client = new mobilepulsa($username, $apikey);
        return $this->client;
    }

    /**
     * Cek saldo saat ini
    * Refrensi
    * https://developer.mobilepulsa.net/documentation#api-Check_Balance
    */
    public function cekSaldo()
    {
        return $this->client -> checkBalance();
    }

}