<?php

$pgMulai = (isset($_GET['pg']))?$_GET['pg']:0;
$pgOffset = (isset($_GET['ofset']))?$_GET['ofset']:10;
if(isset($_POST["btnEdit"]))
{
    $koleksi = $klien->sekolah->matkul;

    $dtk = $_POST["txtId"];
    
    $arrAdd["nama"] = $_POST["txtnama"];
    $arrAdd["SKS"] = $_POST["txtsks"];
    $arrAdd["Jurusan"] = $_POST["txtjurusan"];

    $hasil = $koleksi->updateOne(
        ['_id'=> new MongoDB\BSON\ObjectId("$dtk")],
        [ '$set' => $arrAdd]
    );

    //$hasil = $koleksi->updateOne(['_id'=> new MongoDB\BSON\ObjectId("$dtk")], $arrAdd);
}
