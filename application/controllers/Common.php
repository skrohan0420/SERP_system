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

    private $prefix_data = [
		KEY_DOMAIN  => UID_PREFIX_DOMAIN,
	];


    private function uid(){
        return strtoupper(bin2hex(openssl_random_pseudo_bytes(4)));
    }

	public function generate_uid($purpose = null){
          return (array_key_exists($purpose, $this->prefix_data)) ? $this->prefix_data[$purpose] . $this->uid() . date('Ymd') : 0;
	}




    public function response($data, $status){
        if(!empty($data) && !empty($status)){
            return $this->output->set_content_type("application/json")->set_status_header($status)->set_output(json_encode($data));
        }
    }
    

    public function search($query,$hl,$gl){
        $pages = !empty($pages) ? $pages: 1;
        $gl    = !empty($gl)    ? $gl   : "us";
        $hl    = !empty($hl)    ? $hl   : "en";
        $query = !empty($query) ? $query : "null"; 
        $data  = []; 

        $apiurl = sprintf('https://www.googleapis.com/customsearch/v1?q=%s&cx=%s&key=%s&hl=%s&gl=%s&start=%d', $query, GOOGLE_CSE_CX, GOOGLE_SEARCH_API_KEY, $hl, $gl, (PAGE_LIMIT - 1) * 10 + 1);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiurl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $json = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'cURL error: ' . curl_error($ch);
            // Handle the error here if needed.
        }
        curl_close($ch);
        $obj = json_decode($json);
        array_push($data, $obj);
        
        return !empty($obj) ? $obj : null;
    }

    public function innit_model($model){
        $this->load->model($model);
    }


   


}

?>