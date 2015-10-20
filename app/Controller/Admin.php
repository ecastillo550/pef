<?php
namespace Hagane\Controller;

class Admin extends AbstractController{

	function _init() {
		if (!$this->auth->isAuth()) {
			 header("Location: http://hagasoft.mx/User");
			 die();
		}
		include_once($this->config['appPath'].'Model/UserManagement.php');
	}

	function index() {
	}

	function cliente() {
		$this->userManager = new \Hagane\Model\UserManagement($this->auth, $this->db);

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$data = array(
				'nombre' => $_POST['nombre'],
				'rfc' => $_POST['rfc'],
				'calle' => $_POST['calle'],
				'num_exterior' => $_POST['num_exterior'],
				'num_interior' => $_POST['num_interior'],
				'colonia' => $_POST['colonia'],
				'cp' => $_POST['cp']);

				$this->userManager->setCliente($data);
		}
	}

	function users() {
		$this->userManager = new \Hagane\Model\UserManagement($this->auth, $this->db);
		echo $this->db->database_log['error'];

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			if ($_POST['tipo'] == 'cliente') {
				$this->userManager->setResponsable($_POST['username'], $_POST['password'], $_POST['nombre'], $_POST['apellido_paterno'], $_POST['apellido_materno'], $_POST['empresa']);
				$this->clientes = 'active';
			}
			if ($_POST['tipo'] == 'doctor') {
				$this->userManager->setDoctor($_POST['username'], $_POST['password'], $_POST['nombre'], $_POST['apellido_paterno'], $_POST['apellido_materno'], $_POST['cedula']);
				$this->doctores = 'active';
			}
			if ($_POST['tipo'] == 'admin') {
				$this->userManager->setAdmin($_POST['username'], $_POST['password'], $_POST['nombre'], $_POST['apellido_paterno'], $_POST['apellido_materno']);
				$this->admin = 'active';
			}
		}
	}
}

?>