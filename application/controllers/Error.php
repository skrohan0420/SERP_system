<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH."controllers/Common.php");

class Error extends Common {

    function __construct(){
        parent::__construct();
        date_default_timezone_set(TIME_ZONE);
        Header(header_allow_origin); //for allow any domain, insecure
        Header(header_allow_headers); //for allow any headers, insecure
        Header(header_allow_methods); //method allowed
    }

    public function error404(){
        $this->output->set_status_header(404);
        $this->load->view('errors/html/error_404');
    }
}


?>