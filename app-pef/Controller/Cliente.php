<?php
namespace Hagane\Controller;

class Cliente extends AbstractController{

	function _init() {
		if (!$this->auth->isAuth()) {
			 header("Location: ".$this->config['document_root']."User");
			 die();
		}
		include_once($this->config['appPath'].'Model/UserManagement.php');
		echo $this->db->database_log['error'];
	}

	function index() {
	}

	function config() {
		//$this->print_template = false;
	}

	function dashboard() {

	}

	function subir() {
	}

	function ajaxGetCliente() {
		$this->sendJson = true;
		$this->print_template = false;
		$this->userManager = new \Hagane\Model\UserManagement($this->auth, $this->db);
		echo json_encode($this->userManager->getEmpresas());
	}

	function ajaxGetUsuarioResponsable() {
		$this->sendJson = true;
		$this->print_template = false;
		$this->userManager = new \Hagane\Model\UserManagement($this->auth, $this->db);
		if (isset($_GET['id']) && $_GET['id'] != '') {
			echo json_encode($this->userManager->getClientUser($_GET['id']));
		}
	}
}

?>