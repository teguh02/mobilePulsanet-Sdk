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
include __DIR__ . '/example/postpaid.php';
include __DIR__ . '/example/train.php';

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

// daftar harga postpaid (daftar harga pln)
// print_r($postpaid -> daftarHarga());

// tampilkan daftar harga postpaid (daftar harga bpjs)
// print_r($postpaid -> daftarHargaBPJS());

// # membuat tagihan atau inquiry
// print_r($postpaid->buatTagihanBPJS());
// print_r($postpaid->buatTagihanGasNegara());
// print_r($postpaid->buatTagihanMULTIFINANCENONFNADIRA());
// print_r($postpaid->buatTagihanPDAM());
// print_r($postpaid->buatTagihanPLN());
// print_r($postpaid->buatTagihanTvNontelkomVision());
// print_r($postpaid->buatTagihanTvtelkomVision());
// print_r($postpaid->buatTagihanTelpPasca());
// print_r($postpaid->buatTagihanInternetNonTelkom());
// print_r($postpaid->buatTagihanInternetTelkomPSTN());
// print_r($postpaid->buatTagihanEsamsat());

// membayar transaksi dari proses inquiry
// print_r($postpaid->bayarTagihan());

// download struk dari transaksi yang dilakukan sebelumnya
// print_r($postpaid->downloadStruk());

// cek transaksi postpaid
// print_r($postpaid->cekTransaksi());

// tampilkan semua response code yang ada di postpaid
// print_r($postpaid->responseCode());

// @ train section
$train = new train;

// menampilkan daftar harga booking kereta
print_r($train->daftarHarga());

// cetak daftar harga
// print_r($train->daftarStasiunKereta());
echo "</pre>";