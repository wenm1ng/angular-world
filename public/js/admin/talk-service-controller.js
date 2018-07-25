(function () {

    angular.module('wc.services').factory('talkService', ['$resource', '$q', 'wcConstants', function ($resource, $q, wcConstants) {
        return $resource(wcConstants.BASE_URL + "admin/talk/:action", {"action": "@action"}, {
            listTalks: {
                isArray: false,
                params: {action: 'list'}
            },
            deleteTalk: {
                method: 'POST',
                isArray: false,
                params: {action: 'delete'}
            }
        });
    }]);

    angular.module('wc.controllers').controller('talkCtrl', function ($scope, talkService,wcConstants) {

        $scope.pagingInfo = {per_page: wcConstants.PAGE_SIZE, current_page: 1};
        $scope.talks = [];
        $scope.listTalks = function (page) {
            if (page != null) {
                $scope.pagingInfo.current_page = page;
            }
            talkService.listTalks($scope.pagingInfo, function (data) {
                $scope.talks = data.data;
                $scope.pagingInfo.total = data.total;
            });
        };

        $scope.deleteTalk = function (m) {
            if (confirm('确定删除该条记录')) {
                talkService.deleteTalk(m, function (data) {
                    if (data.status == 0) {
                        alert('删除成功');
                        $scope.listTalks();
                    }
                });
            }
        };
    });
})();
