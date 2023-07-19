<?php

defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH."controllers/Common.php");

class Rankings extends Common {
    
    function __construct(){
        parent::__construct();
        date_default_timezone_set(TIME_ZONE);
        Header(header_allow_origin); //for allow any domain, insecure
        Header(header_allow_headers); //for allow any headers, insecure
        Header(header_allow_methods); //method allowed
    }


    public function get_all_domains(){
        $resp = [
            "status" => true,
            "message" => "",
            "data" => null
        ];

        $this->innit_model(MODEL_DOMAIN);
        $domains = $this->Domain_model->get_all_domains();
        $resp['message'] = !empty($domains) ? "data found" : "error somenth wrong hapeend";
        $resp['data'] = $domains;
        $this->response($resp, 200);
    }



}

?>