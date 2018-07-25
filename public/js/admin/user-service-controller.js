(function () {

    angular.module('wc.services').factory('userService', ['$resource', '$q', 'wcConstants', function ($resource, $q, wcConstants) {
        return $resource(wcConstants.BASE_URL + "admin_list/user/:action", {"action": "@action"}, {
            listUsers: {
                isArray: true,
                params: {action: 'list'}
            }
        });
    }]);

    angular.module('wc.controllers').controller('userCtrl', function ($scope, userService) {

        $scope.users = [];
        $scope.listUsers = function () {
            userService.listUsers({}, function (data) {
                $scope.users = data;
            });
        };
    });
})();
