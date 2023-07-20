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
        $resp['message'] = !empty($domains) ? "data found" : "error something went wrong";
        if(!empty($domains)){
            foreach($domains as $key => $domain){
                $key_words = $this->Domain_model->get_all_keyWords($domain['uid']);
                $domains[$key]['key_words'] = !empty($key_words) ? count($key_words) : 0 ;
            }
            $resp['data'] = $domains;
        }
        $this->response($resp, 200);
    }

    public function get_key_word_rankings(){
        $resp = [
            "status"  => true,
            "message" => "",
            "data"    => null
        ]; 
        $doamin_id = $this->input->get('domain_id');
        if(!empty($doamin_id)){
            $this->innit_model(MODEL_DOMAIN);
            $key_words_data = $this->Domain_model->get_all_keyWords($doamin_id);
            if(!empty($key_words_data)){
                foreach($key_words_data as $key => $key_word){
                    $key_words_data[$key]['current_rank']  = $this->Domain_model->get_current_rank($key_word['uid']);
                    $key_words_data[$key]['previous_rank'] = $this->Domain_model->get_previous_rank($key_word['uid']);
                }
            }
            $resp['message'] = !empty($key_words_data) ? 'data found' : 'data not found';
            $resp['data']   = $key_words_data ;  
            $this->response($resp, 200);
        }
        $resp['message'] = 'data not found';
        $this->response($resp, 200);
    }



}

?>