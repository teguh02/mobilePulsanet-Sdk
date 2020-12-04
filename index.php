<?php

// import autoload
include __DIR__ . '/vendor/autoload.php';

// import package ofi\mobilepulsa
use ofi\mobilepulsa\mobilepulsa;

/**
 * Import class class contoh (di dalam folder example)
 */
include __DIR__ . '/example/checkBalance.php';
include __DIR__ . '/example/prepaid.php';
include __DIR__ . '/example/callbackSample.php';

// Jangan lupa import class postpaid disini
include __DIR__ . '/example/postpaid.php';

echo "<pre>";

// untuk mengecek saldo, pertama buat instance baru
// dari class checkBalance
$checkBalance = new checkBalance;
// tampilkan hasilnya
// print_r($checkBalance->cekSaldo());

// @ prepaid section
// Buat instance baru class prepaid
$prepaid = new prepaid;

// kamu bisa menampilkan hasilnya seperti ini
// silahkan uncomment saja kode dibawah ini 
// supaya hasilnya muncul :)

// print_r($prepaid->daftarHarga());
// print_r($prepaid->cekIdPemain());
// print_r($prepaid->daftarServerGame());
// print_r($prepaid->topUpPulsa());
// print_r($prepaid->topUpVoucherGame());
// print_r($prepaid->topUpVoucherAlfamart());
// print_r($prepaid->autoDetectOperatorPriceList());

// deteksi jenis operator nomor hp
// print_r(mobilepulsa::deteksiOperatorNoHp('08986642927'));

// tangkap semua response dari callback
// pertama buat instance callbackSample terlebih dahulu
$callbackSample = new callbackSample;
// cetak hasil
// print_r($callbackSample->tangkapCallback());

// atau kamu bisa menyimpannya menjadi log txt
// print_r($callbackSample->simpanSebagaiLogTxt());

// cek status transaksi
// print_r($prepaid -> cekStatusTransaksi());

// cek informasi pelanggan pln
// print_r($prepaid->cekPelangganPLN());

// mencetak prepaid response kode  
// print_r($prepaid->kodeRespon());

// @ postpaid section
$postpaid = new postpaid;

// daftar harga
print_r($postpaid -> daftarHarga());

echo "</pre>";