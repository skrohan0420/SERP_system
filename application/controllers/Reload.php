<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once(APPPATH."controllers/Common.php");


class Reload extends Common{
    function __construct(){
        parent::__construct();
        date_default_timezone_set(TIME_ZONE);
        Header(header_allow_origin); //for allow any domain, insecure
        Header(header_allow_headers); //for allow any headers, insecure
        Header(header_allow_methods); //method allowed
    }

    

}