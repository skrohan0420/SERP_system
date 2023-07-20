<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once(APPPATH."controllers/Common.php");


class Load extends Common{
    function __construct(){
        parent::__construct();
        date_default_timezone_set(TIME_ZONE);
        Header(header_allow_origin); //for allow any domain, insecure
        Header(header_allow_headers); //for allow any headers, insecure
        Header(header_allow_methods); //method allowed
    }

    public function headers($data){   
        $this->load->view('inc/header_link', $data['header_link']);
        $this->load->view('inc/sidebar', $data['sidebar']);
        $this->load->view('inc/header');
       
    }

    public function footers($data){
        $this->load->view('inc/footer');
        $this->load->view('inc/footer_link', $data['footer']);
    }

    public function rankings(){
        $data_header = [
            'header_link' => [
                'title' => 'rankings'
            ],
            'sidebar' => [
                'rankings' => true
            ],
            'header' => []
        ];
        $data_footer = [
            'footer' => []
        ];
        $this->headers($data_header);
        $this->load->view('rankings');
        $this->load->view('inc/js/rankings_js');
        $this->footers($data_footer);
    }

    public function add_domain(){
        $data_header = [
            'header_link' => [
                'title' => 'add domain'
            ],
            'sidebar' => [
                'add_domain' => true
            ],
            'header' => []
        ];
        $data_footer = [
            'footer' => []
        ];
        $this->headers($data_header);
        $this->load->view('add_domain');
        $this->load->view('inc/js/add_domain_js');
        $this->footers($data_footer);
    }

    public function single_search(){
        $data_header = [
            'header_link' => [
                'title' => 'custom search'
            ],
            'sidebar' => [
                'search' => true
            ],
            'header' => []
        ];
        $data_footer = [
            'footer' => []
        ];
        $this->headers($data_header);
        $this->load->view('search_by_keyword');
        $this->load->view('inc/js/search_by_keyword_js');
        $this->footers($data_footer);

    }

    public function key_words(){
        $this->innit_model(MODEL_DOMAIN);
        $doamin_id = $this->uri->segment(3);
        $doamin_data = $this->Domain_model->get_domain_byId($doamin_id);

        $data_header = [
            'header_link' => [
                'title' => 'keywords rankings'
            ],
            'sidebar' => [
                'search' => true
            ],
            'header' => []
        ];
        $data = [
            "domain_id" => $doamin_id,
            "doamin_data" => $doamin_data
        ];
        $data_footer = [
            'footer' => []
        ];
        $this->load->view('inc/header_link', $data_header['header_link']);
        $this->load->view('inc/header');
        $this->load->view('key_word_ranks',$data);
        $this->load->view('inc/js/key_word_ranks_js',$data);
        $this->footers($data_footer);

    }




}