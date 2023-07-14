<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Common extends CI_Controller{
    function __construct(){
        parent::__construct();
        date_default_timezone_set(TIME_ZONE);
        Header(header_allow_origin); //for allow any domain, insecure
        Header(header_allow_headers); //for allow any headers, insecure
        Header(header_allow_methods); //method allowed
    }


    public function response($data, $status){
        if(!empty($data) && !empty($status)){
            return $this->output->set_content_type("application/json")->set_status_header($status)->set_output(json_encode($data));
        }
    }
    


}

?>