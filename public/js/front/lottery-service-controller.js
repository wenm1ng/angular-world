(function () {

    angular.module('wc.services').factory('lotteryService', ['$resource', '$q', 'wcConstants', function ($resource, $q, wcConstants) {
        return $resource(wcConstants.BASE_URL + "lottery/:action", {"action": "@action"}, {
            draw: {
                isArray: false,
                params: {action: 'draw'}
            }
        });
    }]);

    angular.module('wc.controllers').controller('lotteryCtrl', function ($scope, lotteryService, $interval) {

        $scope.result = {disable_draw_btn: false};

        $scope.draw = function () {
            if (!$scope.result.disable_draw_btn) {

                lotteryService.draw({game_id: $('#hiddenGameId').val()}, function (data) {

                    if (data.status == 0) {
                        var randomTimes = 0;
                        var liImages = $('#lottery li');

                        var timer = $interval(function () {
                            angular.forEach(liImages, function (e) {
                                $(e).removeClass('acti');
                            });

                            var randomImg = $(liImages[Math.floor((Math.random() * 6))]);
                            randomImg.addClass('acti');

                            if (randomTimes > 20) {
                                if (parseInt($(randomImg.children()[0]).attr('data')) == data.data.result) {
                                    $interval.cancel(timer);

                                    if (data.data.result == 0) {
                                        $('.no-win').show();
                                    } else {
                                        $('#bMsg').html(data.data.remark);
                                        $('.win').show();
                                    }
                                }
                            }
                            randomTimes++;
                        }, 150);
                    } else {
                        $scope.result.tip = data.msg;
                    }
                });

                $scope.result.disable_draw_btn = true;
            }
        };
    });
})();
