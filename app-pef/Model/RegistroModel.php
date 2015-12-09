<?php
namespace Hagane\Model;

class Registro {
	private $db;

	function __construct(&$db) {
		$this->db = $db;
	}

	function newRegistro($data = array()) {
		$newUserData = array(
			'user' => $data['user']
		);
		$result = $this->db->query('SELECT user FROM User WHERE user=:user', $newUserData);

		if (empty($result)) {
			$newClienteData = array(
				'nombre' => $data['nombreEmpresa'],
				'rfc' => $data['rfc'],
				'calle' => $data['calle'],
				'num_exterior' => $data['num_exterior'],
				'num_interior' => $data['num_interior'],
				'colonia' => $data['colonia'],
				'email' => $data['email'],
				'cp' => $data['cp'],
				'telefono' => $data['telefono'],
				'municipio' => $data['municipio']
			);
			$newClienteId = $this->db->insert('INSERT INTO Cliente SET nombre=:nombre, rfc=:rfc, calle=:calle, num_exterior=:num_exterior, num_interior=:num_interior, colonia=:colonia, email=:email, cp=:cp, telefono=:telefono, municipio=:municipio', $newClienteData);

			$newUserData = array(
				'user' => $data['user'],
				'password' => $data['password'],
				'user_type' => 'Cliente'
			);
			$newUserId = $this->db->insert('INSERT INTO User SET user=:user, password=:password, user_type=:user_type', $newUserData);

			$newResponsableData = array(
				'nombre' => $data['nombre'],
				'apellido_paterno' => $data['apellido_paterno'],
				'apellido_materno' => $data['apellido_materno'],
				'idUser' => $newUserId,
				'idCliente' => $newClienteId
			);
			$newRespId = $this->db->insert('INSERT INTO Responsable SET nombre=:nombre, apellido_paterno=:apellido_paterno, apellido_materno=:apellido_materno, idUser=:idUser, idCliente=:idCliente', $newResponsableData);

			if (isset($newRespId)) {
				$data['success'] = 'true';
			}
		} else {
			$data['duplicate'] = 'true';
		}


		return $data;
	}
}

?>