<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function login()
	{
		$this->load->view('login');
	}
	
	public function doLogin()
	{

		$user = $this->input->post("user");
		$password = $this->input->post("password");

		if (!empty($user) and !empty($password))
		{
			$result = $this->findUser($user, $password);
			if ($result->num_rows() > 0)
			{
				$this->session->set_userdata("token", $result->first_row());
				header("location:" . $this->config->item('path_url') . "main");
			} else
			{
				$this->session->set_flashdata('error', 'Usuario o contraseña incorrectos');
			}
		}
		else
		{
			$this->session->set_flashdata('error', 'Ingrese usuario y contraseña');
		}

		$this->load->view('login');

	}

	private function generateMenu()
	{
		
	}

	public function logout()
	{
		$this->session->unset_userdata("token");
		header("location:" . $this->config->item('path_url') . "auth/login");
	}

	private function findUser($user, $password)
	{
		$this->load->model('User');
		$this->User->setUser($user);
		$this->User->setPassword($password);
		
		return $this->User->login();
	}
}
