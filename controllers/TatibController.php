<?php
require_once 'models/tatib.php';

class TatibController
{
    public function index()
    {
        $model = new Tatib();

        // Fetch data using the model, sanitizing the input
        $tingkat = isset($_GET['tingkat']) ? htmlspecialchars($_GET['tingkat'], ENT_QUOTES, 'UTF-8') : null;
        $dataTatib = $model->getTatibByTingkat($tingkat);

        // Check if the view file exists and include it
        $viewFile = 'views/tataTertib.php';
        if (file_exists($viewFile)) {
            // Pass data to the view
            include $viewFile; // The variable $tingkat will now be accessible in the view
        } else {
            echo "View file not found!";
        }
    }
}
