<?php

$pgMulai = (isset($_GET['pg']))?$_GET['pg']:0;
$pgOffset = (isset($_GET['ofset']))?$_GET['ofset']:10;
if(isset($_POST["btnDel"]))
{
    $koleksi = $klien->sekolah->matkul;

    $dtk = $_POST["txtId"];

    $hasil = $koleksi->deleteOne(['_id'=> new MongoDB\BSON\ObjectId("$dtk")]);
}