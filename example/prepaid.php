<?php

use ofi\mobilepulsa\mobilepulsa;

/**
 * Refrensi prepaid
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

    /**
     * Daftar harga prepaid
     * Refrensi
     * https://developer.mobilepulsa.net/documentation#api-Price_List
     */
    public function daftarHarga()
    {
        return $this->client->prepaid() 
                            -> pricelist('game', 'dragon_nest_m_-_sea');
    }

    /**
     * Cek id pemain game prepaid
     * Refrensi
     * https://developer.mobilepulsa.net/documentation#api-Check_Game_ID
     */
    public function cekIdPemain()
    {
        // contoh, mengecek id pemain free fire (dalam development mode)
        return $this->client->prepaid() 
                            -> checkGameId('156378300|8483', 103);
    }

    /**
     * Cek daftar server game prepaid
     * Refrensi
     * https://developer.mobilepulsa.net/documentation#api-Game_Server_List
     */
    public function daftarServerGame()
    {
        // cek daftar server game Dragon Nest (development mode)
        return $this->client->prepaid() 
                            -> gameServerList(142);
    }

    /**
     * Isi pulsa prepaid
     * Refrensi
     * https://developer.mobilepulsa.net/documentation#api-Top_Up_Request
     */
    public function topUpPulsa()
    {
        // contoh top up pulsa xl 5 rb
        $order_no = "order1";
        return $this->client->prepaid() 
                            -> topUpRequest('xld5000', '0817777215', $order_no);
    }

    /**
     * Top up voucher game prepaid
     * Refrensi
     * https://developer.mobilepulsa.net/documentation#api-Top_Up_Request
     */
    public function topUpVoucherGame()
    {
        // contoh top up voucher game dragon nest 180 Berlian (development mode)
        $order_no = "order6"; // harus diisi berbeda beda per orderan
        return $this->client->prepaid() 
                            -> topUpRequest('dragonnest180', '156378300|8483', $order_no);
    }

    /**
     * Top up voucher alfamart prepaid
     * Refrensi
     * https://developer.mobilepulsa.net/documentation#api-Top_Up_Request
     */
    public function topUpVoucherAlfamart()
    {
        $order_no = "orderVoucherAlfamart50"; // harus diisi berbeda beda per orderan
        return $this->client->prepaid() 
                            -> topUpRequest('alfamart50', '0817777215', $order_no);
    }

    /**
     * Menampilkan pricelist yang ada di deteksi 
     * operator otomatis prepaid
     * Refrensi
     * https://developer.mobilepulsa.net/documentation#api-Auto_Detect_Operator
     */
    public function autoDetectOperatorPriceList()
    {
        // menampilkan daftar harga pada auto detect operator
        return $this->client->prepaid() 
                            -> autoDetectOperator();
    }

    /**
     * Periksa status transaski prepaid
     * Refrensi
     * https://developer.mobilepulsa.net/documentation#api-Inquiry_Pre_Paid
     */
    public function cekStatusTransaksi()
    {
        $order_id = "order001";
        return $this->client->prepaid() 
                            -> checkStatus($order_id);
    }

    /**
     * Cek informasi pelanggan pln prepaid
     * Refrensi
     * https://developer.mobilepulsa.net/documentation#api-Inquiry-GetInquiryPlnToken
     */
    public function cekPelangganPLN()
    {
        $subscriber_id = "12345678901";
        return $this->client->prepaid()    
                            -> checkPlnSubscriber($subscriber_id);
    }

    /**
     * Tampilkan semua kode respon yang ada di prepaid
     */
    public function kodeRespon()
    {
        return $this->client->prepaid() 
                            -> responseCode();
    }
}