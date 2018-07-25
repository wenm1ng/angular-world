(function () {

    angular.module('wc.controllers').controller('guessCtrl', function ($scope, Upload, gameService, $location) {

        $scope.guesses = [];
        $scope.listGuesses = function () {
            gameService.listGuesses({game: $('#passedGameId').val(),team:$('#passedTeamId').val()}, function (data) {
                $scope.guesses = data;
            });
        };
        $scope.listGuesses();

        $scope.lotteries = [{id: 0, name: '无'},{id: 1, name: '一等奖'}, {id: 2, name: '二等奖'}, {id: 3, name: '三等奖'}, {id: 4, name: '四等奖'}, {id: 5, name: '五等奖'}];
        $scope.selectedLottery = { result: 0  };
        $scope.openLotteryForm = function (m) {
            $scope.selectedLottery = m;
            $('#lottery-form').modal('show');
        };

        $scope.saveLottery = function () {
            gameService.saveLottery($scope.selectedLottery, function (data) {
                if (data.status == 0) {
                    $scope.listGuesses();
                }
            });
        };

        $scope.deleteLottery = function (m) {
            if (confirm('确定删除该条记录')) {
                gameService.deleteLottery({ id: m }, function (data) {
                    if (data.status == 0) {
                        alert('删除成功');
                        $scope.listGuesses();
                    }
                });
            }
        };
    });
})();
