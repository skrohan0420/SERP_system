<?php

class Domain_model extends CI_Model {
    
    public function __construct(){
		parent::__construct();
		date_default_timezone_set(TIME_ZONE);
	}

    public function add_domain(){
        return true;
    }

    public function add_keyword(){
        return true;
    }



}