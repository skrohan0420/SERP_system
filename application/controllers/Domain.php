<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once(APPPATH."controllers/Common.php");

class Domain extends Common{

    function __construct(){
        parent::__construct();
        date_default_timezone_set(TIME_ZONE);
        Header(header_allow_origin); //for allow any domain, insecure
        Header(header_allow_headers); //for allow any headers, insecure
        Header(header_allow_methods); //method allowed
    }


    public function add_domain(){
        $resp = [
            "status" => true,
            "message" => '',
            "isInserted" => false
        ];

        $domain      = $this->input->post('domain');
        $domain_name = $this->input->post('domain_name');
        $keyWords    = $this->input->post('keyWords');
        $language    = $this->input->post('language');
        $region      = $this->input->post('country');

        $domain_id =  $this->generate_uid(KEY_DOMAIN);

        $domain_data = [
            'uid'  =>  $domain_id,
            'name' => $domain_name,
            'url'  => $domain,
            'language' => $language,
            'region' => $region,
            'created_at' => time(),
            'modified_at' => time()
        ];


        $this->innit_model(MODEL_DOMAIN);
        $domain_add = $this->Domain_model->add_domain($domain_data);
        $keyword_add = $this->Domain_model->add_keyword($keyWords,$domain_id);
        $resp['isInserted'] = $domain_add && $keyword_add;
        $resp['message'] = $resp['isInserted'] ? 'domain added to the server' : 'Error something went wrong';
        $this->response($resp, 200);        
    }
}