app.controller('ClienteController', function ($scope, $timeout, $mdSidenav, $log, $http, $mdDialog, $mdToast, $sce) {
	//$scope.$parent.loading = 'indeterminate';
	$scope.$parent.toolbar_title = 'Dashboard';
	$scope.message = '';
	$scope.usuarioPyme = null;
	$clienteFormData = {};
	$clienteFormData.croppedDataUrl = '';

	$scope.dashboards = [{
		title: 'ventas' ,
		content: $sce.trustAsResourceUrl('http://biinqliksense.cloudapp.net/single/?appid=6916355e-28a4-4779-a173-9d2d3ba5c023&sheet=XXraLcN&select=clearall')
	}];

	$http.get('Cliente/ajaxGetUsuarioResponsable?id='+userId)
	.then(function(response) {
		$scope.usuarioPyme = response.data[0];
	})
	.finally(function() {
		$scope.$parent.loading = null;
		$clienteFormData = {};
		$clienteFormData.croppedDataUrl = '';
	});

	 $scope.uploadLogo = function () {
	 	$scope.cropped = $scope.mentorFormData.croppedDataUrl;
		$scope.mentorFormData.croppedDataUrl = null;
		var blobFile = Upload.dataUrltoBlob($scope.cropped, $scope.mentorFormData.file.name);

		Upload.upload({
			url: '<?=$this->config['document_root']?>Cliente/config',
			method: 'POST',
			fields: $scope.mentorFormData,
			file: blobFile,
			fileFormDataName: 'profile_path'
		})
		.then(function (response) {
			$scope.result = response.data;
			$clienteFormData = {};
			$clienteFormData.croppedDataUrl = '';
		});
	}
});