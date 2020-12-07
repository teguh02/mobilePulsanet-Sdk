<?php

namespace ofi\mobilepulsa\trainRequest;
use Exception;
use ofi\mobilepulsa\helper\httpRequest;
use ofi\mobilepulsa\helper\signGenerator;

/**
 * Kereta API Section
 * https://developer.mobilepulsa.net/documentation#kai-section
 */

trait train {

    protected static $train_status = false;

    /**
     * To start train chain method
     */

    public function train()
    {
        self::$train_status = true;
        return $this;
    }

    /**
     * To print all Booking Price List Train
     */
    public function priceListBookTrain()
    {
        self::cekTrain();
        $pricelist = [
            array('product_code' => 'KAI', 'product_name' => 'TIKET KERETA API', 'fee' => '7500', 'commission' => '3500', 'status' => 'active'),
        ];

        return ['data' => $pricelist, 'env' => self::$env];
    }

    /**
     * To print all train station
     * https://developer.mobilepulsa.net/documentation#kai-station-list
     */
    public function stationList()
    {
        self::cekTrain();
        return httpRequest::postTrain([
            'commands' => 'station-list',
            'username' => self::$username,
            'sign' => md5('IsYk1?2P3De/')
        ], '/api/v1/tiketv2');
    }

    /**
     * To Search a train
     * https://developer.mobilepulsa.net/documentation#kai-search-train
     */
    public function searchTrain($origin_station, $destination_station, $departure_date)
    {
        self::cekTrain();
        return httpRequest::postTrain([
            'commands' => 'search-train',
            'username' => self::$username,
            'org' => $origin_station,
            'dest' => $destination_station,   
            'date' => $departure_date,   
            'sign' => signGenerator::generate('st')
        ], '/api/v1/tiketv2');
    }

    /**
     * To booking a train
     * https://developer.mobilepulsa.net/documentation#kai-booking
     */
    public function bookingTrain(String $product_code, String $contact_phone, Array $desc, $ref_id = null)
    {
        self::cekTrain();
        $order_id = $ref_id ?? time();
        $array = [
            'commands' => 'inq-pasca',
            'username' => self::$username,
            'ref_id' => $order_id,
            'code' => $product_code,
            'hp' => $contact_phone,
            'desc' => $desc,
            'sign' => signGenerator::generate($order_id)
        ];

        return httpRequest::postTrain($array, '/api/v1/tiketv2');
    }

    /**
     * To show all seat map
     * https://developer.mobilepulsa.net/documentation#api-Seat
     */
    public function seatMap($tr_id, $ticketNumber)
    {
        self::cekTrain();
        return httpRequest::postTrain([
            'commands' => 'seat-map',
            'username' => self::$username,
            'tr_id' => $tr_id,
            'ticketNumber' => $ticketNumber,
            'sign' => signGenerator::generate($tr_id)
        ], '/api/v1/tiketv2');
    }

    /**
     * To change seat map
     * https://developer.mobilepulsa.net/documentation#api-Seat
     */
    public function changeSeatMap($tr_id, $ticketNumber, $newSeatId)
    {
        self::cekTrain();
        return httpRequest::postTrain([
            'commands' => 'change-seat',
            'username' => self::$username,
            'tr_id' => $tr_id,
            'ticketNumber' => $ticketNumber,
            'newSeatId' => $newSeatId,
            'sign' => signGenerator::generate($tr_id)
        ], '/api/v1/tiketv2');
    }

    /**
     * To cancel inquiry from booking train proccess
     * https://developer.mobilepulsa.net/documentation#kai-cancel-booking
     */
    public function cancelBookingTrain($tr_id)
    {
        self::cekTrain();
        return httpRequest::postTrain([
            'commands' => 'cancel-book',
            'username' => self::$username,
            'tr_id' => $tr_id,
            'sign' => signGenerator::generate($tr_id)
        ], '/api/v1/tiketv2');
    }

    /**
     * To cancel inquiry from booking train proccess
     * https://developer.mobilepulsa.net/documentation#kai-cancel-booking
     */
    public function bookingPayment($tr_id)
    {
        self::cekTrain();
        return httpRequest::postTrain([
            'commands' => 'pay-pasca',
            'username' => self::$username,
            'tr_id' => $tr_id,
            'sign' => signGenerator::generate($tr_id)
        ], '/api/v1/tiketv2');
    }

    /**
     * To print all response code from train section
     * https://developer.mobilepulsa.net/documentation#api-Response_code_kai
     */
    public function trainResponseCode(): array
    {
        $response_code = array(
            array('response_code' => '00', 'description' => 'SUCCESS', 'transaction_status' => 'Success'),
            array('response_code' => '07', 'description' => 'TRANSAKSI GAGAL', 'transaction_status' => 'Failed'),
            array('response_code' => '39', 'description' => 'PENDING / TRANSAKSI SEDANG DIPROSES', 'transaction_status' => 'Pending'),
            array('response_code' => '50', 'description' => 'MASKAPAI TIDAK TERSEDIA', 'transaction_status' => 'Failed'),
            array('response_code' => '52', 'description' => 'DATA TIDAK LENGKAP / TIDAK VALID', 'transaction_status' => 'Failed'),
            array('response_code' => '53', 'description' => 'KODE BOOKING TIDAK TERSEDIA', 'transaction_status' => 'Failed'),
            array('response_code' => '54', 'description' => 'TRANSAKSI TIDAK DAPAT DILAKUKAN. SILAHKAN HUBUNGI CUSTOMER SUPPORT', 'transaction_status' => 'Failed'),
            array('response_code' => '55', 'description' => 'TIKET SUDAH TERISUED', 'transaction_status' => 'Failed'),
            array('response_code' => '56', 'description' => 'RUTE DITUTUP', 'transaction_status' => 'Failed'),
            array('response_code' => '57', 'description' => 'SUBCLASS TIDAK TERSEDIA', 'transaction_status' => 'Failed'),
            array('response_code' => '58', 'description' => 'RUTE TIDAK TERSEDIA', 'transaction_status' => 'Failed'),
            array('response_code' => '60', 'description' => 'FARE ID TIDAK DITEMUKAN', 'transaction_status' => 'Failed'),
            array('response_code' => '61', 'description' => 'PENCARIAN TERJADI KESALAHAN', 'transaction_status' => 'Failed'),
            array('response_code' => '62', 'description' => 'GAGAL MEMPROSES NOMOR KURSI', 'transaction_status' => 'Failed'),
            array('response_code' => '103', 'description' => 'TIMEOUT', 'transaction_status' => 'Failed'),
        );

        return ['data' => $response_code, 'env' => self::$env];
    }

    protected static function cekTrain()
    {
        if(self::$train_status == false) {
            throw new Exception("Please call train() method first");
        }

        return true;
    }

}