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
         return $this->client->postpaid()  
                            -> pricelistPasca($type, $province_for_pdam);
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
         return $this->client->postpaid() 
                            -> pricelistPasca($type);
    }

    // inquiry

    /**
     * membuat tagihan bpjs (misalkan ingin membayar langsung 2 bulan)
     * Refrensi
     * https://developer.mobilepulsa.net/documentation#api-Inquiry-GetInquiryBpjs
     */
    public function buatTagihanBPJS()
    {
        $bpjs_participant_number = "8801234560001";
        $month = 2;
        $product_code = "BPJS"; // product code
        return $this->client->postpaid() 
                            -> inquiry() 
                            -> inq_BPJS($bpjs_participant_number, $product_code, $month);
    }

    /**
     * Membuat tagihan gasNegara
     * https://developer.mobilepulsa.net/documentation#api-Inquiry-GetInquiryGasNegara
     */
    public function buatTagihanGasNegara()
    {
        $gas_participant_number = "0110014601";
        $product_code = "PGAS";
        return $this->client->postpaid() 
                            -> inquiry() 
                            -> inq_GasNegara($gas_participant_number, $product_code);
    }

    /**
     * Membuat tagihan MULTIFINANCE (NON FNADIRA)
     * https://developer.mobilepulsa.net/documentation#api-Inquiry-GetInquiryGasNegara
     */
    public function buatTagihanMULTIFINANCENONFNADIRA()
    {
        $contract_number = "6391601201";
        $product_code = "FNMEGA";
        return $this->client->postpaid() 
                            -> inquiry() 
                            -> inq_GasNegara($contract_number, $product_code);
    }

}