<?php
class Common_model extends CI_Model {
	
	function __construct(){
        parent::__construct();
        date_default_timezone_set(TIME_ZONE);
        Header(header_allow_origin); //for allow any domain, insecure
        Header(header_allow_headers); //for allow any headers, insecure
        Header(header_allow_methods); //method allowed
    }

	private $prefix_data = [
		KEY_KEYWORD  => UID_PREFIX_KEYWORD,
		KEY_RANKINGS => UID_PREFIX_RANKINGS
	];


	private function uid(){
        return strtoupper(bin2hex(openssl_random_pseudo_bytes(4)));
    }

	public function generate_uid($purpose = null){
        return (array_key_exists($purpose, $this->prefix_data)) ? $this->prefix_data[$purpose] . $this->uid() . date('Ymd') : 0;
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

    public function get_keyWord_dtls($keyWord_id){
        if(!empty($keyWord_id)){
            $keyWord_data = $this->db
                                ->select('*')
                                ->from(TABLE_KEY_WORDS)
                                ->where(COL_UID, $keyWord_id)
                                ->get()
                                ->result_array();
            return !empty($keyWord_data) ? $keyWord_data[0] : null;
        }
        return null;
    }

    public function search_and_insert_rankings($keyWord_id){
        $keyWord_data = $this->get_keyWord_dtls($keyWord_id);
        $domain_data = $this->get_domain_dtls($keyWord_data['domain_id']); 
        
        if(!empty($domain_data) && !empty($keyWord_data)){
            $key_word = urlencode($keyWord_data['key_word']);  
            $search_data = $this->search($key_word,$domain_data['language'],$domain_data['region']);
            $results = $search_data->items;
            $rankInResults = $this->rankInResults($domain_data['name'],$results);
            $rank_data = [
                'uid' => $this->generate_uid(KEY_RANKINGS),
                'key_word_id' => $keyWord_id,
                'rank' => $rankInResults,
                'created_at' => time(),
                'modified_at' => time()
            ];
            $addrank = $this->db->insert(TABLE_RANKINGS, $rank_data);
            return  $addrank;
        }
        return false;     
    }

    public function get_domain_dtls($domain_id){
        if(!empty($domain_id)){
            $domain_data = $this->db
                                ->select('*')
                                ->from(TABLE_DOMAIN)
                                ->where(COL_UID, $domain_id)
                                ->get()
                                ->result_array();
            return !empty($domain_data) ? $domain_data[0] : null;
        }
        return null;
    }

    
    public function rankInResults($domain, $results){
        if(!empty($results)){
            foreach($results as $key => $result){
                if(strpos($result->formattedUrl, $domain) !== false){
                    return $key+1;
                }
            }
            return 0;
        }
    }




}




?>