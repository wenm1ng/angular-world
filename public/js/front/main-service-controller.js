(function () {

    angular.module('wc.services').factory('betService', ['$resource', '$q', 'wcConstants', function ($resource, $q, wcConstants) {
        return $resource(wcConstants.BASE_URL + "game/:action", {"action": "@action"}, {
            bet: {
                method: 'POST',
                isArray: false,
                params: {action: 'bet'}
            }
        });
    }]);

    angular.module('wc.controllers').controller('mainCtrl', function ($scope, betService) {

        $scope.showRule = function () {
            $('.alert').show();
            $('.rules').slideDown();
        };
        $scope.hideRule = function () {
            $('.alert').hide();
            $('.rules').hide();
        };

        $scope.betInfo = {};
        $scope.openBetForm = function (game) {
            $scope.betInfo = game;
            $('.alert').show();
            $('.betting').slideDown();
        };
        $scope.doBet = function () {
            betService.bet($scope.betInfo, function (data) {
                $scope.hideBetForm();
                if (data.status == 0) {
                    showTipForm('竞猜成功',function () {
                        window.location.reload();
                    });
                } else {
                    showTipForm(data.msg);
                }
            });
        };
        $scope.hideBetForm = function () {
            $('.betting').hide();
            $('.alert').hide();
        };

        $scope.hideTipForm = function () {
            $('.used').hide();
            $('.alert').hide();
            window.location.reload();
        };

        var showTipForm = function (tip,func) {
            $scope.betInfo.tip = tip;
            $('.alert').show();
            $('.used').slideDown();
        };
        // showTipForm('二维码失效');

        $scope.jumpToLottery = function (shouldJump, toUrl) {
            if (shouldJump) {
                window.location.href = toUrl;
            }
        };
    });
})();
