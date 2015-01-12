bliss.controller("user.SignInCtrl", ["$scope", "user.User", function($scope, User) {
	$scope.user = {
		email: null,
		password: null,
		remember: true
	};
	
	$scope.signIn = function() {
		User.signIn($scope.user, function(response) {
			console.log(response);
		});
	};
}]);