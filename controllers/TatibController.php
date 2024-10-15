<?php
require_once 'models/Tatib.php';

class TatibController
{
    public function index()
    {
        $model = new Tatib();

        // Fetch data without filtering by default
        $tingkat = isset($_GET['tingkat']) ? htmlspecialchars($_GET['tingkat'], ENT_QUOTES, 'UTF-8') : null;

        // Get data tatib by tingkat, if $tingkat is null, it fetches all records
        $dataTatib = $model->getTatibByTingkat($tingkat);

        // Check if the view file exists and include it
        $viewFile = 'views/tataTertib.php';
        if (file_exists($viewFile)) {
            // Pass data to the view
            include $viewFile; // $tingkat and $dataTatib will be available in the view
        } else {
            echo "View file not found!";
        }
    }
}
