<?php

namespace App\Controllers;

class Proyectos extends BaseController
{
    private $session;
    private $db;

    function __construct(){
        $this->session = session();
        $this->db = db_connect();
    }

    public function index()
	{
        
	}

    

    
    
}