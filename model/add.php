<?php

$pgMulai = (isset($_GET['pg']))?$_GET['pg']:0;
$pgOffset = (isset($_GET['ofset']))?$_GET['ofset']:10;
if(isset($_POST["btnAdd"]))
{
    $koleksi = $klien->sekolah->matkul;

    $arrAdd = array();
    $arrAdd["nama"] = $_POST["txtnama"];
    $arrAdd["SKS"] = $_POST["txtsks"];
    $arrAdd["Jurusan"] = $_POST["txtjurusan"];

    $hasil = $koleksi->insertOne($arrAdd);
}