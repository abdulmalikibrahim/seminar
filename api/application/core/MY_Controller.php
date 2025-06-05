<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
require 'vendor/autoload.php';
class MY_Controller extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    
        // CORS Headers
        header("Access-Control-Allow-Origin: *"); // Ganti dengan domain React.js
        header("Access-Control-Allow-Credentials: true");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
    
        // Tangani preflight request (OPTIONS)
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            http_response_code(200); // Set status 200 OK untuk preflight request
            exit();
        }
    }    

    function fb($array)
    {
        http_response_code(!empty($array["statusCode"]) ? $array["statusCode"] : 200);
        echo json_encode($array);
        die();   
    }
}
?>