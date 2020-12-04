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
                            -> inq_Multifinance_Non_FNADIRA($contract_number, $product_code);
    }

    /**
     * Membuat tagihan PDAM
     * https://developer.mobilepulsa.net/documentation#api-Inquiry-GetInquiryPDAM
     */
    public function buatTagihanPDAM()
    {
        $pdam_participant_number = "10202001";
        $product_code = "PDAMKOTA.SURABAYA";
        return $this->client -> postpaid()
                             -> inquiry()
                             -> inq_PDAM($pdam_participant_number, $product_code);
    }

    /**
     * Membuat tagihan PLN
     * https://developer.mobilepulsa.net/documentation#api-Inquiry-GetInquiryPLNPOSTPAID
     */
    public function buatTagihanPLN()
    {
        $pln_participant_number = "530000000001";
        $product_code = "PLNPOSTPAID";
        return $this->client -> postpaid()
                             -> inquiry()
                             -> inq_PLN($pln_participant_number, $product_code);
    }

    /**
     * Membuat tagihan Tv Berlangganan non Telkom vision
     * https://developer.mobilepulsa.net/documentation#api-Inquiry-GetInquiryTVBIG
     */
    public function buatTagihanTvNontelkomVision()
    {
        $tv_berlangganan_participant_number = "1072161401";
        $product_code = "TVBIG";
        return $this->client -> postpaid()
                             -> inquiry()
                             -> inq_Tv($tv_berlangganan_participant_number, $product_code);
    }

    /**
     * Membuat tagihan Tv Berlangganan Telkom vision
     * https://developer.mobilepulsa.net/documentation#api-Inquiry-GetInquiryTVLKMV
     */
    public function buatTagihanTvtelkomVision()
    {
        $tv_berlangganan_participant_number = "127246500101";
        $product_code = "TVTLKMV";
        return $this->client -> postpaid()
                             -> inquiry()
                             -> inq_Tv($tv_berlangganan_participant_number, $product_code);
    }

    /**
     * Membuat tagihan Telp Pasca
     * https://developer.mobilepulsa.net/documentation#api-Inquiry-GetInquiryTeleponPascabayar
     */
    public function buatTagihanTelpPasca()
    {
        $telepon_pasca_participant_number = "08991234501";
        $product_code = "HPTHREE";
        return $this->client -> postpaid()
                             -> inquiry()
                             -> inq_TelpPasca($telepon_pasca_participant_number, $product_code);
    }

    /**
     * Membuat tagihan Internet non telkom speedy dan Telkom PSTN
     * https://developer.mobilepulsa.net/documentation#api-Inquiry-GetInquiryCBN
     */
    public function buatTagihanInternetNonTelkom()
    {
        $internet_registered_participant_number = "01927101";
        $product_code = "CBN";
        return $this->client -> postpaid()
                             -> inquiry()
                             -> inq_Internet($internet_registered_participant_number, $product_code);
    }

    /**
     * Membuat tagihan Internet non telkom speedy dan Telkom PTSN
     * https://developer.mobilepulsa.net/documentation#api-Inquiry-GetInquiryTELKOMPSTN
     */
    public function buatTagihanInternetTelkomPSTN()
    {
        $internet_registered_participant_number = "6391601201   ";
        $product_code = "TELKOMPSTN";
        return $this->client -> postpaid()
                             -> inquiry()
                             -> inq_Internet($internet_registered_participant_number, $product_code);
    }

}