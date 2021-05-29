<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $token = $this->session->userdata("token");
        if (empty($token))
        {
            header("location:" . base_url() . "auth/login");
        }
	}

	public function index()
	{
		$this->load->view('home');
	}
}
