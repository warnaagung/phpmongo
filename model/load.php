<?PHP
$koleksi = $klien->sekolah->matkul;

$pgMulai = (isset($_GET['pg']))?$_GET['pg']:0;
$pgOffset = (isset($_GET['ofset']))?$_GET['ofset']:5;

$filter = [];
$opt = [
    'skip' => (int)$pgMulai ,
    'limit' => (int)$pgOffset
];

$hasil = $koleksi->find($filter, $opt);
$arrdb = array();

foreach ($hasil as $entri){
    array_push($arrdb,$entri);
    //echo $entri['_id'] . " - " . $entri['nama'] . " - " . $entri['SKS'] . "\n";
}

//$strjson = json_encode($arrdb);

$jmlhasil=count($arrdb);