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
		$users = $this->db->query('SELECT u.user, u.user_type, r.*, c.nombre as empresa
			FROM User as u JOIN Responsable as r JOIN Cliente as c
			WHERE r.idUser = u.id
			AND r.idCliente = c.id');

		return $users;
	}

	function setCliente($data = array()) {
		$this->db->insert('INSERT INTO Cliente SET nombre=:nombre, rfc=:rfc, calle=:calle, num_exterior=:num_exterior, num_interior=:num_interior,colonia=:colonia,cp=:cp ', $data);
	}

	function getEmpresas() {
		$empresas = $this->db->query('SELECT * FROM Cliente');

		return $empresas;
	}

	function setResponsable($username, $password, $nombre, $ap, $am, $empresa) {
		$data = array('user' => $username,
					'user_type' => 'Cliente',
					'password' => $password);
		$lastid = $this->db->insert('INSERT INTO User SET user=:user, password=:password, user_type=:user_type ', $data);

		$data = array('nombre' => $nombre,
					'apellido_paterno' => $ap,
					'apellido_materno' => $am,
					'idCliente' => $empresa,
					'idUser' => $lastid);
		$this->db->insert('INSERT INTO Responsable SET nombre=:nombre, apellido_paterno=:apellido_paterno, apellido_materno=:apellido_materno, idCliente=:idCliente, idUser=:idUser ', $data);
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