bliss.controller("user.MenuWidgetCtrl", ["$scope", "user.Account", function($scope, Account) {
	$scope.$watch(function() { return Account.user(); }, function(user) {
		$scope.user = user;
	}, true);
}]);