<?php
namespace Hagane\Model;

include_once('UserDefinitions/AdministradorUserModel.php');
include_once('UserDefinitions/ClienteUserModel.php');

class User implements UserInterface {
	private $username;
	private $userType;
	private $imgPath;
	private $admon;
	private $cliente;
	private $activo;

	public function __construct(&$auth, &$db) {
		$id = $auth->isAuth();
		if (!empty($id)) {
			$data = array('id' => $id);
			$userArray = $db->getRow('Select * from User where id = :id', $data);

			$this->username = $userArray['user'];
			$this->userType = $userArray['user_type'];
			$this->imgPath = $userArray['imgPath'];
			$this->activo = $userArray['activo'];
			if ($this->userType == 'Administrador') {
				$this->admon = new \Hagane\Model\Administrador($auth, $db);
			} elseif ($this->userType == 'Cliente') {
				$this->cliente = new \Hagane\Model\Cliente($auth, $db);
			}
		}
	}

	public function getUsername() {
		return $this->username;
	}

	public function getUserType() {
		return $this->userType;
	}

	public function getActivo() {
		return $this->activo;
	}

	public function getImgPath() {
		return $this->imgPath;
	}

	public function getUserObject() {
		if ($this->userType == 'Administrador') {
			return $this->admon;
		} elseif ($this->userType == 'Cliente') {
			return $this->cliente;
		}
	}

	public function getNombreCompleto() {
		if ($this->userType == 'Administrador') {
			return $this->admon->getNombre().' '.$this->admon->getApellidoPaterno().' '.$this->admon->getApellidoMaterno();
		}
	}
}

?>