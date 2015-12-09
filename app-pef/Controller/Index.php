<?php
namespace Hagane\Controller;

class Index extends AbstractController{

	function _init() {
		echo $this->db->database_log['error'];
	}

	function index() {
		if ($this->auth->isAuth()) {
			$this->user = new \Hagane\Model\User($this->auth, $this->db);
			if ($this->user->getActivo() == 'y') {
				if ($this->user->getUserType() == 'Administrador') {
					$this->redirect('Admin/index');
					die();
				}
				if ($this->user->getUserType() == 'Cliente') {
					$this->redirect('Cliente/index');
					die();
				}
			} else {
				$this->auth->logout();
				$this->redirect('User/inactivo');
				die();
			}
		} else {
			$this->redirect('/User');
			die();
		}
	}

	function contacto() {
	}

	function conocenos() {
		//print_r($result);
	}
}

?>