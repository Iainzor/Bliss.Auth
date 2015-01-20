bliss.service("user.User", ["$resource", function($resource) {
	return $resource("./user/:path/:action.json", {}, {
		signIn: {
			method: "POST",
			params: {
				path: "auth",
				action: "sign-in"
			}
		}
	});
}]);