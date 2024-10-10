<?php
require_once 'models/tatib.php';

class TatibController
{
    public function index()
    {
        $model = new Tatib();
        // Dapatkan data tata tertib dari model
        $tingkat = isset($_GET['tingkat']) ? $_GET['tingkat'] : null;
        $dataTatib = $model->getTatibByTingkat($tingkat);

        // Kirim data ke view
        require 'views/peraturan/AturanTatib.php';
    }
}
