app.config(function($mdThemingProvider, $sceDelegateProvider) {
	// $mdThemingProvider.theme('default')
	// .primaryPalette('indigo', {
	// 	'default': '900'
	// })
	// .accentPalette('deep-purple');
<?php
include_once($this->config['appPath'].'Model/UserManagement.php');
$id = $this->auth->isAuth();
if (isset($id) && $id != '') {
	$this->userManager = new \Hagane\Model\UserManagement($this->auth, $this->db);
	$clientArray = $this->userManager->getClientUser($id);
}
?>

var userPallete = $mdThemingProvider.extendPalette('red', {
	'500': '<?=$clientArray[0]['primary_color']?>'
});
var userAccentPallete = $mdThemingProvider.extendPalette('pink', {
	'A200': '<?=$clientArray[0]['secondary_color']?>'
});
$mdThemingProvider.definePalette('userPallete', userPallete);
$mdThemingProvider.definePalette('userAccentPallete', userAccentPallete);

$mdThemingProvider.theme('default')
	.primaryPalette('userPallete')
	.accentPalette('userAccentPallete');



});