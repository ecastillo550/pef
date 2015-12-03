app.config(function($mdThemingProvider, $sceDelegateProvider) {
	$mdThemingProvider.theme('default')
	.primaryPalette('indigo', {
		'default': '900'
	})
	.accentPalette('deep-purple');

	// $sceDelegateProvider.resourceUrlWhitelist([
	// 	// Allow same origin resource loads.
	// 	'self',
	// 	// Allow loading from our assets domain.  Notice the difference between * and **.
	// 	'http://**',
	// 	'https://**'
	// ]);
});