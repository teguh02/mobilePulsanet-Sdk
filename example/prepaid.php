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
        return $this->client->prepaid() -> pricelist('game', 'dragon_nest_m_-_sea');
    }

    public function cekIdPemain()
    {
        // contoh, mengecek id pemain free fire (dalam development mode)
        return $this->client->prepaid() -> checkGameId('156378300|8483', 103);
    }

    public function daftarServerGame()
    {
        // cek daftar server game Dragon Nest (development mode)
        return $this->client->prepaid() -> gameServerList(142);
    }

    public function topUpPulsa()
    {
        // contoh top up pulsa xl 5 rb
        $order_no = "order1";
        return $this->client->prepaid() -> topUpRequest('xld5000', '0817777215', $order_no);
    }

    public function topUpVoucherGame()
    {
        // contoh top up voucher game dragon nest 180 Berlian (development mode)
        $order_no = "order6"; // harus diisi berbeda beda per orderan
        return $this->client->prepaid() -> topUpRequest('dragonnest180', '156378300|8483', $order_no);
    }

}