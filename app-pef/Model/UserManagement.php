<?php
namespace Hagane\Model;

class UserManagement {
	private $db;
	private $auth;

	function __construct(&$auth, &$db) {
		$id = $auth->isAuth();
		if (!empty($id)) {
			$data = array('id' => $id);
			$userArray = $db->getRow('SELECT * from Administrador join User where User.id = Administrador.idUser AND User.id = :id', $data);
			$this->db = $db;
			$this->auth = $auth;
		}
	}

	function getUsers() {
		$users = $this->db->query('SELECT u.user, u.user_type FROM User as u');

		return $users;
	}

	function getAdminUsers() {
		$users = $this->db->query('SELECT u.user, u.user_type, a.* FROM User as u JOIN Administrador as a WHERE a.idUser = u.id');

		return $users;
	}

	function getClientUsers() {
		$users = $this->db->query('SELECT u.user, u.user_type, u.activo, r.*, c.nombre as empresa
			FROM User as u JOIN Responsable as r JOIN Cliente as c
			WHERE r.idUser = u.id
			AND r.idCliente = c.id AND u.activo="y"');

		return $users;
	}

	function getNotActiveClientUsers() {
		$users = $this->db->query('SELECT u.user, u.user_type, r.id as respId, r.*, c.nombre as empresa
			FROM User as u JOIN Responsable as r JOIN Cliente as c
			WHERE r.idUser = u.id
			AND r.idCliente = c.id AND u.activo="n"');

		return $users;
	}

	function getClientUser($id) {
		$users = $this->db->query('SELECT u.user, u.user_type, r.*, c.nombre as empresa, c.*
			FROM User as u JOIN Responsable as r JOIN Cliente as c
			WHERE r.idUser = u.id
			AND r.idCliente = c.id
			AND u.id = '. $id);

		return $users;
	}

	function setCliente($data = array()) {
		$this->db->insert('UPDATE Cliente SET nombre=:nombre, rfc=:rfc, municipio=:municipio, telefono=:telefono, calle=:calle, num_exterior=:num_exterior, num_interior=:num_interior,colonia=:colonia,cp=:cp,email=:email WHERE id=:id', $data);
		$data['success'] = 'true';
		return $data;
	}
	function setClienteColors($data = array()) {
		$this->db->query('UPDATE Cliente SET primary_color=:primary_color, secondary_color=:secondary_color WHERE id=:id', $data);
		$data['success'] = 'true';
		return $data;
	}

	function setAcceptResp($data = array()) {
		$datauser = array(
			'activo' => 'y',
			'id' => $data['idUser']
		);
		$this->db->query('UPDATE User SET activo=:activo WHERE id=:id', $datauser);

		$dataresp = array(
			'nombre' => $data['nombre'],
			'apellido_materno' => $data['apellido_materno'],
			'apellido_paterno' => $data['apellido_paterno'],
			'id' => $data['respId']
		);
		$this->db->query('UPDATE Responsable SET nombre=:nombre,apellido_materno=:apellido_materno, apellido_paterno=:apellido_paterno WHERE id=:id', $dataresp);

		$data['success'] = 'true';
		return $data;
	}

	function setClienteLogo($data = array()) {
		$this->db->query('UPDATE Cliente SET profile_path=:profile_path WHERE id=:id', $data);
		$data['success'] = 'true';
		return $data;
	}

	function setClienteFile($data = array()) {
		$this->db->query('INSERT INTO ClienteFile SET path=:path, idCliente=:idCliente, timestamp=:timestamp', $data);
		$data['success'] = 'true';
		return $data;
	}

	function updateCliente($data = array()) {
		$this->db->query('UPDATE Cliente SET nombre=:nombre, rfc=:rfc, calle=:calle, num_exterior=:num_exterior, num_interior=:num_interior,colonia=:colonia,cp=:cp WHERE id=:id', $data);
	}

	function getEmpresas() {
		$empresas = $this->db->query('SELECT * FROM Cliente');

		return $empresas;
	}

	function setResponsable($data = array()) {
		$lastid = $this->db->insert('INSERT INTO User SET user=:user, password=:password, user_type=:user_type ', $data);

		$data['idUser'] = $lastid;
		$this->db->insert('INSERT INTO Responsable SET nombre=:nombre, apellido_paterno=:apellido_paterno, apellido_materno=:apellido_materno, idCliente=:idCliente, idUser=:idUser ', $data);
	}

	function updateResponsable($data = array()) {
		$userData = array(
			'idUser' => $data['idUser'],
			'user' => $data['user'],
			'user_type' => 'Cliente'
		);

		if (isset($data['password'])) {
			$userData['password'] = $data['password'];
			$this->db->query('UPDATE User SET user=:user, password=:password, activo=:activo WHERE id=:idUser', $userData);

		} else {
			$userData['activo'] = $data['activo'];
			$this->db->query('UPDATE User SET user=:user, user_type=:user_type, activo=:activo WHERE id=:idUser', $userData);
		}

		$responsableData = array(
			'nombre' => $data['nombre'],
			'apellido_paterno' => $data['apellido_paterno'],
			'apellido_materno' => $data['apellido_materno'],
			'idCliente' => $data['idCliente'],
			'idUser' => $data['idUser']
		);
		$this->db->query('UPDATE Responsable SET nombre=:nombre, apellido_paterno=:apellido_paterno, apellido_materno=:apellido_materno, idCliente=:idCliente WHERE idUser=:idUser', $responsableData);
	}

	function setAdmin($username, $password, $nombre, $ap, $am) {
		$data = array('user' => $username,
					'user_type' => 'Administrador',
					'password' => $password);
		$lastid = $this->db->insert('INSERT INTO User SET user=:user, password=:password, user_type=:user_type ', $data);

		$data = array('nombre' => $nombre,
					'apellido_paterno' => $ap,
					'apellido_materno' => $am,
					'idUser' => $lastid);
		$this->db->insert('INSERT INTO Administrador SET nombre=:nombre, apellido_paterno=:apellido_paterno, apellido_materno=:apellido_materno, idUser=:idUser ', $data);
	}
}

?>