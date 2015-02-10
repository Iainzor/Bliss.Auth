bliss.controller("user.SignUpCtrl", ["$scope", "unifiedUI.Layout", "user.User", function($scope, Layout, User) {
	Layout.shrink();
	
	$scope.user = {};
	$scope.errors = [];
	
	$scope.submit = function() {
		$scope.loading(true);
		$scope.errors = [];
		
		User.create({
			user: $scope.user
		}, function(response) {
			$scope.loading(false);
			
			if (response.result === "error") {
				$scope.errors = response.errors;
			}
		}, function(error) {
			$scope.loading(false);
			$scope.errors = [
				error.data.message
			];
			console.error(error.data);
		});
	};
}]);