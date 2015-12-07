<?php
namespace Hagane\Controller;

class Cliente extends AbstractController{

	function _init() {
		if (!$this->auth->isAuth()) {
			$this->redirect('/User');
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

	function uploadLogo() {
		$this->sendJson = true;
		$this->print_template = false;

		$target_path = $this->config['appPath'] . '/FrontEnd/userImages/';

		$timestamp = time();
		$salt = mt_rand(1,500);
		$ext = substr(strrchr($_FILES['file']['name'], '.'), 1);
		$target_path = $target_path . $timestamp . '-' . $salt . '.' . $ext;

		//$target_path = $target_path . basename( $_FILES['file']['name']);
		if(!move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
			$data['message'] = 'error al subir el archivo';
			echo json_encode($data);
			die();
		}
		$target_path = str_replace($this->config['appPath'], '', $target_path);
		if (substr($target_path, 0, 1) == '/') {
			$target_path = substr($target_path, 1);
		}

		$this->userManager = new \Hagane\Model\UserManagement($this->auth, $this->db);
		$clientArray = $this->userManager->getClientUser($this->auth->isAuth());
		$data = array(
			'id' => $clientArray[0]['idCliente'],
			'profile_path' => $target_path
		);
		echo json_encode($this->userManager->setClienteLogo($data));
	}

	function uploadFile() {
		$this->sendJson = true;
		$this->print_template = false;

		$target_path = $this->config['appPath'] . '/FrontEnd/Excel/';

		$timestamp = time();
		$salt = mt_rand(1,500);
		$ext = substr(strrchr($_FILES['file']['name'], '.'), 1);
		$target_path = $target_path . $timestamp . '-' . $salt . '.' . $ext;

		//$target_path = $target_path . basename( $_FILES['file']['name']);
		if(!move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
			$data['message'] = 'error al subir el archivo';
			echo json_encode($data);
			die();
		}
		$target_path = str_replace($this->config['appPath'], '', $target_path);
		if (substr($target_path, 0, 1) == '/') {
			$target_path = substr($target_path, 1);
		}

		$this->userManager = new \Hagane\Model\UserManagement($this->auth, $this->db);
		$clientArray = $this->userManager->getClientUser($this->auth->isAuth());
		$data = array(
			'idCliente' => $clientArray[0]['idCliente'],
			'path' => $target_path,
			'timestamp' => date_create()->format('Y-m-d H:i:s')
		);
		echo json_encode($this->userManager->setClienteFile($data));
	}

	function uploadColors() {
		$this->sendJson = true;
		$this->print_template = false;
		$postdata = file_get_contents("php://input"); //recibe los datos de angular
		$request = json_decode($postdata);

		$this->userManager = new \Hagane\Model\UserManagement($this->auth, $this->db);
		$clientArray = $this->userManager->getClientUser($this->auth->isAuth());

		$data = array(
			'id' => $clientArray[0]['idCliente'],
			'primary_color' => $request->primary_color,
			'secondary_color' => $request->secondary_color
		);
		echo json_encode($this->userManager->setClienteColors($data));
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