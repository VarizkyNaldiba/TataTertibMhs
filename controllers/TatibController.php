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
}
?>