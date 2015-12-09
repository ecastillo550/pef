app.controller('ClienteController', function ($scope, $timeout, $mdSidenav, $log, $http, $mdDialog, $mdToast, $sce, Upload, $window) {
	//$scope.$parent.loading = 'indeterminate';
	$scope.$parent.toolbar_title = 'Dashboard';
	$scope.message = '';
	$scope.usuarioPyme = {};
	$logoFormData = {};
	$logoFormData.croppedDataUrl = '';
	$cargaFormData = {};

	$scope.dashboards = [{
		title: 'ventas' ,
		content: $sce.trustAsResourceUrl('http://biinqliksense.cloudapp.net/single/?appid=6916355e-28a4-4779-a173-9d2d3ba5c023&sheet=XXraLcN&select=clearall')
	}];

	$http.get('Cliente/ajaxGetUsuarioResponsable?id='+userId)
	.then(function(response) {
		$scope.usuarioPyme = response.data[0];
		$scope.usuarioPymeForm = $scope.usuarioPyme;
		$scope.clienteForm = $scope.usuarioPyme;
	})
	.finally(function() {
		$scope.$parent.loading = null;
		$logoFormData = {};
		$logoFormData.croppedDataUrl = '';
	});

	$scope.uploadLogo = function () {
		$scope.cropped = $scope.logoFormData.croppedDataUrl;
		$scope.logoFormData.croppedDataUrl = null;
		var blobFile = Upload.dataUrltoBlob($scope.cropped, $scope.logoFormData.file.name);

		Upload.upload({
			url: '<?=$this->config['document_root']?>Cliente/uploadLogo',
			method: 'POST',
			fields: $scope.logoFormData,
			file: blobFile,
			fileFormDataName: 'profile_path'
		})
		.then(function (response) {
			if (response.data.success == 'true') {
				$mdToast.show(
					$mdToast.simple()
					.position('right')
					.content('Logo actualizado')
					.parent(document.querySelector( '#pagecontent' ))
					.hideDelay(3000)
				);
				$window.location.reload();
			}
		});
	}
	$scope.uploadExcel = function () {
		Upload.upload({
			url: '<?=$this->config['document_root']?>Cliente/uploadFile',
			method: 'POST',
            fields: $scope.cargaFormData,
			file: $cargaFormData.file
		})
		.then(function (response) {
			if (response.data.success == 'true') {
				$mdToast.show(
					$mdToast.simple()
					.position('right')
					.content('Archivo recibido')
					.parent(document.querySelector( '#pagecontent' ))
					.hideDelay(3000)
				);
				$scope.result = response.data;
				$logoFormData = {};
				$logoFormData.croppedDataUrl = '';
			}
		});
	}

	$scope.uploadColors = function () {
		$http({
			method  : 'POST',
			url     : '<?=$this->config['document_root']?>Cliente/uploadColors',
			data    : $scope.usuarioPyme,
			headers : { 'Content-Type': 'application/x-www-form-urlencoded' }
		})
		.then(function(response) {
			if (response.data.success) {
				$mdToast.show(
					$mdToast.simple()
					.position('right')
					.content('Colores actualizados')
					.parent(document.querySelector( '#pagecontent' ))
					.hideDelay(3000)
				);
			$window.location.reload();
			}
		});
	}

	$scope.modClienteDialog = function(ev) {
		$mdDialog.show({
			controller: DialogController,
			template: `<?=$this->renderView('AngularModal/modificarCliente.phtml')?>`,
			parent: angular.element(document.body),
			targetEvent: ev,
			clickOutsideToClose:false,
			scope: $scope,
			preserveScope: true
		})
		.then(function(resp) { //se guarda el cambio
			if (resp) {
				$http.post('Admin/ajaxSetCliente', $scope.clienteForm)
				.then(function(response) {
					$mdToast.show(
						$mdToast.simple()
						.position('right')
						.content('Guardada empresa')
						.parent(document.querySelector( '#pagecontent' ))
						.hideDelay(3000)
					);
				});
			}
		});
	};

	$scope.modPymeDialog = function(ev) {
		$mdDialog.show({
			controller: DialogController,
			template: `<?=$this->renderView('AngularModal/modificarUsuarioPyme.phtml')?>`,
			parent: angular.element(document.body),
			targetEvent: ev,
			clickOutsideToClose:false,
			scope: $scope,
			preserveScope: true
		})
		.then(function(resp) { //se guarda el cambio
			if (resp) {
				$http.post('Admin/ajaxUpdateUsuarioResponsable', $scope.usuarioPymeForm)
				.then(function(response) {
					$mdToast.show(
						$mdToast.simple()
						.position('right')
						.content('Guardado Usuario Pyme')
						.parent(document.querySelector( '#pagecontent' ))
						.hideDelay(3000)
					);
				});
			}
		});
	};
});