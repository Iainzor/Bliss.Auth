bliss.controller("user.SignInCtrl", ["$scope", "$location", "user.Account", "unifiedUI.Layout", "unifiedUI.Navigation", function($scope, $location, Account, Layout, Nav) {
	Layout.shrink();
	Layout.menu.disable();
	
	console.log(Nav.page());
	console.log(Nav.pages());
	
	$scope.user = {
		email: null,
		password: null
	};
	$scope.error = {open:false};
	
	var frame = document.getElementById("signInFrame");
	var form = document.getElementById("signInForm");
	form.onsubmit = function() {
		$scope.$apply(function() {
			$scope.loading(true);
			$scope.error.open = false;
		});
	};
	frame.onload = function() {
		var frame = this;
		
		$scope.$apply(function() {
			$scope.loading(false);

			var body = frame.contentDocument.body;
			var json = body.innerText;
			var response = angular.fromJson(json);

			if (response.result === "error") {
				$scope.error = response;
				$scope.error.open = true;
			} else {
				Account.user(response.user);
				$location.path("/");
			}
		});
	};
}]);