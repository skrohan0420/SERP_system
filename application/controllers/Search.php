<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH."controllers/Common.php");

class Search extends Common {
    function __construct(){
        parent::__construct();
        date_default_timezone_set(TIME_ZONE);
        Header(header_allow_origin); //for allow any domain, insecure
        Header(header_allow_headers); //for allow any headers, insecure
        Header(header_allow_methods); //method allowed
    }

    public function custom_search(){
        $gl = !empty($this->input->get('country'))? $this->input->get('country') :"us";
        $hl = !empty($this->input->get('language'))? $this->input->get('language') :"en";
        $query = $this->input->get('keyWords');
        $data = $this->search($query,$hl,$gl);      
        $this->response($data, 200);
    }








}


?>