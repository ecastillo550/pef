app.controller('ClienteDashboardController', function ($scope, $timeout, $mdSidenav, $log, $http, $mdDialog, $mdToast) {
	$scope.$parent.loading = 'indeterminate';
	$scope.$parent.toolbar_title = 'Dashboard';
	$scope.message = '';

	$scope.qlik = { "jsonrpc": "2.0", "id": 1, "method": "GetDocList", "handle": -1, "params": [] };

	$http.post('http://biinqliksense.cloudapp.net', $scope.qlik)
	.then(function(response) {
		$scope.message = response.data;
	})
	.finally(function() {
		$scope.$parent.loading = null;
	});
});