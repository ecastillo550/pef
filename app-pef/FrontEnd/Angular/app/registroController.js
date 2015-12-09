app.controller('registroController', function ($scope, $timeout, $mdSidenav, $log, $http, $mdDialog, $mdToast, $sce, Upload, $window) {
	//$scope.$parent.loading = 'indeterminate';
	$scope.$parent.toolbar_title = 'Registro';
	$scope.registroFormData = {};
	$scope.selectedIndex = 0;
	$scope.estados = ['Aguascalientes','Baja California','Baja California Sur','Campeche','Chiapas','Chihuahua','Coahuila','Colima','Distrito Federal','Durango','Estado de México','Guanajuato','Guerrero','Hidalgo','Jalisco','Michoacán','Morelos','Nayarit','Nuevo León','Oaxaca','Puebla','Querétaro','Quintana Roo','San Luis Potosí','Sinaloa','Sonora','Tabasco','Tamaulipas','Tlaxcala','Veracruz','Yucatán','Zacatecas'];

	$scope.siguiente = function () {
		$scope.selectedIndex++;
	}

	$scope.anterior = function () {
		$scope.selectedIndex--;
	}

	$scope.setRegistro = function () {
		$http.post('User/ajaxRegistro', $scope.registroFormData)
		.then(function(response) {
			if (response.data.success == 'true') {
				titulo = '¡Enhorabuena!';
				contenido = 'Hemos recibido tu información y nos pondremos en contacto lo más pronto posible.';
			} else if (response.data.duplicate == 'true') {
				titulo = 'Lo sentimos';
				contenido = 'El nombre de usuario no se encuentra disponible.';
			} else {
				titulo = 'Lo sentimos';
				contenido = 'No ha sido posible realizar su registro, por favor intente más tarde.';
			}
			$mdDialog.show(
			  $mdDialog.alert()
				.parent(angular.element(document.querySelector('#popupContainer')))
				.clickOutsideToClose(true)
				.title(titulo)
				.textContent(contenido)
				.ariaLabel('Resultado de Registro')
				.ok('Aceptar')
			);
		});
	}
});