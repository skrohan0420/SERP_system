<?php
include_once(APPPATH."models/Common_model.php");
class Domain_model extends Common_model {
    
    public function __construct(){
		parent::__construct();
		date_default_timezone_set(TIME_ZONE);
	}

    public function add_domain($domain_data){
        $add_domain = $this->db
                        ->insert(TABLE_DOMAIN,$domain_data);
        return $add_domain;
    }

    public function add_keyword($keyWords,$domain_id){
        if(!empty($keyWords)){
            foreach($keyWords as $key => $word){
                $key_word_id =  $this->generate_uid(KEY_KEYWORD);
                $keyWord_data = [
                    "uid" => $key_word_id,
                    "domain_id" =>  $domain_id,
                    "key_word" => $word,
                    "created_at" => time(),
                    "modified_at" => time()
                ];
                $add_keyword = $this->db
                                    ->insert(TABLE_KEY_WORDS, $keyWord_data);
                if($add_keyword){
                    $add_rankings = $this->search_and_insert_rankings($key_word_id);
                }
            }
            return $add_keyword && $add_rankings;
        }
        return false;
    }

    public function get_all_domains(){
        $data = $this->db
                    ->select('*')
                    ->from(TABLE_DOMAIN)
                    ->get()
                    ->result_array();

        return !empty($data) ? $data : null ; 
    }


   

   

    





}