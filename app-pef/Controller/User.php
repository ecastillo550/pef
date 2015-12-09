<?php
namespace Hagane\Controller;

class User extends AbstractController{
	function _init() {
		include_once($this->config['appPath'].'Model/registroModel.php');
		echo $this->db->database_log['error'];
	}

	function index() {
	}

	function auth() {
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			$this->auth->authenticate($_POST['user'], $_POST['password']);
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
			}
		}
	}

	function registro() {
	}

	function inactivo() {
	}

	function ajaxRegistro() {
		$this->sendJson = true;
		$this->print_template = false;
		$postdata = file_get_contents("php://input"); //recibe los datos de angular
		$request = json_decode($postdata);

		$this->registro = new \Hagane\Model\Registro($this->db);

		$data = array(
			'nombreEmpresa' => $request->nombreEmpresa,
			'rfc' => $request->rfc,
			'calle' => $request->calle,
			'num_exterior' => $request->num_exterior,
			'num_interior' => $request->num_interior,
			'colonia' => $request->colonia,
			'telefono' => $request->telefono,
			'cp' => $request->cp,
			'municipio' => $request->municipio,
			'user' => $request->user,
			'password' => $request->password,
			'nombre' => $request->nombre,
			'apellido_paterno' => $request->apellido_paterno,
			'apellido_materno' => $request->apellido_materno
		);
		echo json_encode($this->registro->newRegistro($data));
	}

	function logout() {
		$this->auth->logout();
		$this->redirect('/User');
		die();
	}
}

?>