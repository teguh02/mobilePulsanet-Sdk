<?php

use ofi\mobilepulsa\mobilepulsa;

/**
 * Refrensi postpaid
 * https://developer.mobilepulsa.net/documentation#api-post_paid
 */

class postpaid {

    protected $client;

    public function __construct()
    {
        $username = '089655541804';
        $apikey = '1195eaba63dc90ee';
        $this->client = new mobilepulsa($username, $apikey);
        return $this->client;
    }

    /**
     * Refrensi daftar harga
     * https://developer.mobilepulsa.net/documentation#pascaType
     * https://developer.mobilepulsa.net/documentation#api-Price_List_post
     */
    public function daftarHarga()
    {
        /**
         * Available Category type
         * pdam
         * bpjs
         * internet
         * pajak-kendaraan
         * finance
         * hp
         * estate
         * emoney
         * kereta
         * tv
         * airline
         * o2o
         * pbb
         * gas
         * pajak-daerah
         * pln
         * pasar
         * retribusi
         * pendidikan
         */

         $type = 'pdam';
         $province_for_pdam = 'jawa tengah';
         return $this->client->postpaid() -> pricelistPasca($type, $province_for_pdam);
    }

    /**
     * Refrensi daftar harga
     * https://developer.mobilepulsa.net/documentation#pascaType
     * https://developer.mobilepulsa.net/documentation#api-Price_List_post
     */
    public function daftarHargaBPJS()
    {
        /**
         * Available Category type
         * pdam
         * bpjs
         * internet
         * pajak-kendaraan
         * finance
         * hp
         * estate
         * emoney
         * kereta
         * tv
         * airline
         * o2o
         * pbb
         * gas
         * pajak-daerah
         * pln
         * pasar
         * retribusi
         * pendidikan
         */

         $type = 'bpjs';
         return $this->client->postpaid() -> pricelistPasca($type);
    }

}