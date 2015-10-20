<?php
namespace Hagane\Controller;

class Cliente extends AbstractController{

	function _init() {
		if (!$this->auth->isAuth()) {
			 header("Location: http://hagasoft.mx/User");
			 die();
		}
	}

	function index() {
	}

	function config() {
	}

	function dashboard() {
	}

	function subir() {
	}
}

?>