<?php
namespace Hagane\Controller;

class Cliente extends AbstractController{

	function _init() {
		if (!$this->auth->isAuth()) {
			 header("Location: /User");
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