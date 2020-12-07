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

    /**
     * Booking kereta api (masih bug)
     * https://developer.mobilepulsa.net/documentation#kai-booking
     */
    public function bookingKereta()
    {
        $product_code = "KAI";  
        $contact_phone = "089655123123";
        $fareId = "e1839293e40fbb5a4127652547e5d28c086bf40a"; // id from searchtrain  
        $orderId = 'orderkereta';

        // Deskripsi booking
        $desc = [
            'contactName'       => "Teguh Rijanandi",
            'contactEmail'      => "teguhrijanandi02@gmail.com",
            'fareId'            => $fareId, // Train Schedule Fare ID 
            'adult'             => 1, //Number of adult passenger

            // passengger details
            'passenger'         => [
                [
                    'id'        => '003312312344556', // passengger id (No KTP)
                    'name'      => "Rifqi Alfinur",
                    'category'  => 'A' //Passenger category (A for adult or I for infant / bayi) 
                ],
                [
                    'id'        => '12312344123',
                    'name'      => 'Nama Bayi Disini',
                    'category'  => 'I' // bayi
                ]
            ]
        ];        

        return $this->client -> train()
                             -> bookingTrain(
                                 $product_code,
                                 $contact_phone,
                                 $desc,
                                 $orderId
                                );
    }

    /**
     * Untuk menampilkan setmap berdasarkan tiket (masih bug)
     * https://developer.mobilepulsa.net/documentation#kai-seat-map
     */
    public function seatMap()
    {
        $ticketNumber = "TIKET_2305X2L28TZ1";
        $tr_id = "41775971";
        return $this->client -> train()
                             -> seatMap($tr_id, $ticketNumber);
    }

    /**
     * Mengganti seatmap (masih bug)
     * https://developer.mobilepulsa.net/documentation#kai-change-seat
     */
    public function gantiSeatMap()
    {
        $ticketNumber = "TIKET_2305X2L28TZ1";
        $tr_id = "41775971";
        $newSeatId = '10731852';
        return $this->client -> train()
                             -> changeSeatMap($tr_id, $ticketNumber, $newSeatId);
    }

    /**
     * Membatalkan pesanan kereta
     * https://developer.mobilepulsa.net/documentation#kai-cancel-booking
     */
    public function batalkanPemesananKereta()
    {
        $tr_id = "41775971";
        return $this->client -> train()
                             -> cancelBookingTrain($tr_id);
    }

    /**
     * Membayar pemesanan kereta (masih bug)
     * https://developer.mobilepulsa.net/documentation#kai-cancel-booking
     */
    public function bayarPemesananKereta()
    {
        $tr_id = "41775971";
        return $this->client -> train()
                             -> bookingPayment($tr_id);
    }

}