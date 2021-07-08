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
				$this->generateMenu();

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
		$this->load->model("Menu_model");
				
		$modulos = $this->Menu_model->modulos();
		if ($modulos->num_rows() > 0)
		{
			$menu1desc = array();
			$menu2desc = array();
			$j = 0;
			$k = 0;
			foreach($modulos->result() as $mod):
				$menu1desc[$j]['idmodulo'] = $mod->idmodulo;
				$menu1desc[$j]['descripcion'] = $mod->descripcion;
				$menu1desc[$j]['menu'] = $mod->menu;
				$menu1desc[$j]['icono'] = $mod->icono;
				$menu1desc[$j]['activo'] = $mod->activo;
				$this->Menu_model->setIdModulo($mod->idmodulo);
				$submenu = $this->Menu_model->submenu();
				foreach($submenu->result() as $sub):
					$menu2desc[$k]['idmodulo'] = $sub->idmodulo;
					$menu2desc[$k]['idmenu'] = $sub->idmenu;
					$menu2desc[$k]['descripcion'] = $sub->descripcion;
					$menu2desc[$k]['href'] = $sub->url;
					$menu2desc[$k]['nivel'] = $sub->nivel;
					$menu2desc[$k]['activo'] = $sub->activo;
					$k++;
				endforeach;
				$j++;
			endforeach;
		}
		$this->session->set_userdata("modulos", $menu1desc);
		$this->session->set_userdata("submenus", $menu2desc);
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
