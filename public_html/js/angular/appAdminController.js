app.controller('AdminUserController', function ($scope, $timeout, $mdSidenav, $log, $http, $mdDialog, $mdToast) {
	$scope.$parent.loading = 'indeterminate';
	$scope.usuariosAdmin = [];
	$scope.usuariosPyme = [];
	$scope.$parent.toolbar_title = 'Gestión de usuarios';
	$scope.usuarioPymeForm = null;

	$http.post('/Admin/ajaxGetUsuarioAdmin', {})
	.then(function(response) {
		$scope.usuariosAdmin = response.data;
	})
	.finally(function() {
		$scope.$parent.loading = null;
	});

	$http.post('/Admin/ajaxGetUsuarioResponsable', {})
	.then(function(response) {
		$scope.usuariosPyme = response.data;
	})
	.finally(function() {
		$scope.$parent.loading = null;
	});

	$scope.modDialog = function(ev, index) {
		$scope.usuarioPymeForm = $scope.usuariosPyme[index];
		$mdDialog.show({
			controller: DialogController,
			templateUrl: '../Templates/modificarUsuarioPyme.html',
			parent: angular.element(document.body),
			targetEvent: ev,
			clickOutsideToClose:false,
			scope: $scope,
			preserveScope: true
		})
		.then(function(resp) { //se guarda el cambio
			if (resp) {
				$http.post('/Admin/ajaxUpdateUsuarioResponsable', $scope.usuarioPymeForm)
				.then(function(response) {
					$mdToast.show(
						$mdToast.simple()
						.position('right')
						.content('Guardado')
						.parent(document.querySelector( '#pagecontent' ))
						.hideDelay(3000)
					);
				});
			}
		});
	};
})
.controller('AdminClientesController', function ($scope, $timeout, $mdSidenav, $log, $http) {
	$scope.$parent.loading = 'indeterminate';
	$scope.clientes = [];
	$scope.$parent.toolbar_title = 'Gestión de clientes';

	$http.post('/Admin/ajaxGetCliente', {})
	.then(function(response) {
		$scope.clientes = response.data;
	})
	.finally(function() {
		$scope.$parent.loading = null;
	});
});