<?php
namespace Hagane\Controller;

class Index extends AbstractController{

	function _init() {
		echo $this->db->database_log['error'];
	}

	function index() {
		$this->redirect('/User');
		die();
	}

	function contacto() {
	}

	function conocenos() {
		//print_r($result);
	}
}

?>