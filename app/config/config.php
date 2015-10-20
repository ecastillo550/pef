<?php
namespace Hagane;

class Config {
	function getConf() {
		return
			array(
				'appPath' => '../app/',
				'template' => 'main',
				'db_engine' => 'mysql',
				'db_server' => 'localhost',
				// 'db_database' => 'pefbicom_pef',
				// 'db_user' => 'pefbicom_erick',
				// 'db_password' => 'Bicarbonato1!',
				'db_database' => 'hagane_pef',
				'db_user' => 'root',
				'db_password' => '',
				'session_time' => 3600
			);
	}

	function getModules() {
		return
			array();
	}
}
?>