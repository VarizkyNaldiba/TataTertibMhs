<?php
require_once '../Models/Tatib.php';
require_once '../Models/Sanksi.php';

class TatibController {
    private $tatibModel;
    private $sanksiModel;

    public function __construct() {
        $this->tatibModel = new Tatib();
        $this->sanksiModel = new Sanksi();
    }

    public function ReadTatib() {
        return $this->tatibModel->getAllTatib();
    }

    public function ReadSanksi() {
        return $this->sanksiModel->getAllSanksi();
    }

    public function store($admin, $deskripsi, $tingkat, $poin) {
        $result = $this->tatibModel->insertTatib(
            $admin, 
            $deskripsi, 
            $tingkat, 
            $poin
        );
    }

    public function update($id, $admin, $deskripsi, $tingkat, $poin) {
        $result = $this->tatibModel->updateTatib(
            $id,
            $admin, 
            $deskripsi, 
            $tingkat, 
            $poin
        );
    }

    public function delete($id) {
        $result = $this->tatibModel->deleteTatib($id);
    }

    public function getTatibDetail($id_tata_tertib) {
        return $this->tatibModel->getTatibById($id_tata_tertib);
    }
}

?>