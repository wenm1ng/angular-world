(function () {

    angular.module('wc.services').factory('talkService', ['$resource', '$q', 'wcConstants', function ($resource, $q, wcConstants) {
        return $resource(wcConstants.BASE_URL + "talk/:action", {"action": "@action"}, {
            listTalks: {
                isArray: true,
                params: {action: 'list'}
            },
            talk: {
                method: 'POST',
                isArray: false,
                params: {action: 'talk'}
            }
        });
    }]);

    angular.module('wc.controllers').controller('talkCtrl', function ($scope, talkService, wcConstants) {

        $scope.pagingInfo = {per_page: wcConstants.PAGE_SIZE, current_page: 1};
        $scope.talks = [];
        $scope.listTalks = function (page, type) {
            $scope.pagingInfo.current_page = page;

            talkService.listTalks($scope.pagingInfo, function (data) {
                $scope.talks = data;

                if (type == 'add') {
                    $("#ul_scroll").animate({scrollTop: 0}, 500);
                    $(window).scrollTop(0);
                }
            });

        };
        $scope.listTalks(1, 'list');

        $scope.talk = {};
        $scope.addTalk = function () {
            talkService.talk($scope.talk, function (data) {
                if (data.status == 0) {
                    $scope.listTalks($scope.pagingInfo.current_page, 'add');
                    $scope.talk.content = '';
                }
            });
        };

        window.setInterval(function () {
            $scope.listTalks($scope.pagingInfo.current_page);
        }, 1000 * 15);
    });
})();
