app.controller('appClienteController', function ($scope, $timeout, $mdSidenav, $log, $http, $mdDialog, $mdToast, $sce) {
	//$scope.$parent.loading = 'indeterminate';
	$scope.$parent.toolbar_title = 'Dashboard';
	$scope.message = '';

	$scope.dashboards = [{
		title: 'ventas' ,
		content: $sce.trustAsResourceUrl('http://biinqliksense.cloudapp.net/single/?appid=6916355e-28a4-4779-a173-9d2d3ba5c023&sheet=XXraLcN&select=clearall')
	}];

});