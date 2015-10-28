<?php
namespace Hagane\Controller;

class Admin extends AbstractController{

	function _init() {
		if (!$this->auth->isAuth()) {
			 header("Location: /User");
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

	function ajaxSetCliente() {
		$this->print_template = false;
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

	function ajaxUpdateUsuarioResponsable() {
		$postdata = file_get_contents("php://input"); //recibe los datos de angular
		$request = json_decode($postdata);

		$this->print_template = false;
		$this->userManager = new \Hagane\Model\UserManagement($this->auth, $this->db);

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$data = array(
				'id' => $request->id,
				'idUser' => $request->idUser,
				'user' => $request->user,
				'user_type' => 'Cliente',
				'nombre' => $request->nombre,
				'apellido_paterno' => $request->apellido_paterno,
				'apellido_materno' => $request->apellido_materno,
				'idCliente' => $request->idCliente);

			$this->userManager->updateResponsable($data);
		}
	}

	function ajaxSetUsuarioAdmin() {
		$this->print_template = false;
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

	function ajaxGetCliente() {
		$this->print_template = false;
		$this->userManager = new \Hagane\Model\UserManagement($this->auth, $this->db);
		echo json_encode($this->userManager->getEmpresas());
	}

	function ajaxGetUsuarioResponsable() {
		$this->print_template = false;
		$this->userManager = new \Hagane\Model\UserManagement($this->auth, $this->db);
		echo json_encode($this->userManager->getClientUsers());
	}

	function ajaxGetUsuarioAdmin() {
		$this->print_template = false;
		$this->userManager = new \Hagane\Model\UserManagement($this->auth, $this->db);
		echo json_encode($this->userManager->getAdminUsers());
	}

	function users() {
		$this->userManager = new \Hagane\Model\UserManagement($this->auth, $this->db);
		echo $this->db->database_log['error'];

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			if ($_POST['tipo'] == 'cliente') {
				$this->userManager->setResponsable($_POST['username'], $_POST['password'], $_POST['nombre'], $_POST['apellido_paterno'], $_POST['apellido_materno'], $_POST['empresa']);
				$this->clientes = 'active';
			}
			if ($_POST['tipo'] == 'admin') {
				$this->userManager->setAdmin($_POST['username'], $_POST['password'], $_POST['nombre'], $_POST['apellido_paterno'], $_POST['apellido_materno']);
				$this->admin = 'active';
			}
		}
	}
}

?>