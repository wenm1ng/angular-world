(function () {

    angular.module('wc.services').factory('gameService', ['$resource', '$q', 'wcConstants', function ($resource, $q, wcConstants) {
        return $resource(wcConstants.BASE_URL + "admin/game/:action", {"action": "@action"}, {
            listGames: {
                isArray: false,
                params: {action: 'list'}
            },
            saveGame: {
                method: 'POST',
                isArray: false,
                params: {action: 'save'}
            },
            deleteGame: {
                method: 'POST',
                isArray: false,
                params: {action: 'delete'}
            },
            listGuesses: {
                isArray: true,
                params: {action: 'guesses'}
            },
            deleteLottery: {
                method: 'POST',
                isArray: false,
                params: {action: 'delete_lottery'}
            },
            saveLottery: {
                method: 'POST',
                isArray: false,
                params: {action: 'save_lottery'}
            }
        });
    }]);

    angular.module('wc.controllers').controller('gameCtrl', function ($scope, Upload, gameService, teamService, wcConstants) {

        $scope.teams = teamService.listTeams();

        $scope.pagingInfo = {per_page: wcConstants.PAGE_SIZE, current_page: 1};
        $scope.search = {status: -1};
        $scope.games = [];
        $scope.listGames = function (page) {
            if (page != null) {
                $scope.pagingInfo.current_page = page;
            }
            $scope.search.current_page = $scope.pagingInfo.current_page;
            gameService.listGames($scope.search, function (data) {
                $scope.games = data.data;
                $scope.pagingInfo.total = data.total;
            });
        };

        $scope.gameOptions = [{id: 0, text: '未开放'}, {id: 1, text: '开放'}, {id: 3, text: '抽奖中'}, {id: 2, text: '关闭'}];
        $scope.selectedGame = {};
        $scope.openEditForm = function (o) {
            if (null != o) {
                $scope.selectedGame = o;
            } else {
                $scope.selectedGame = {};
            }
            $('#game-form').modal('show');
        };

        $scope.getStatusName = function (s) {
            switch (s) {
                case 0:return '未开放';
                case 1:return '开放';
                case 2:return '关闭';
                case 3:return '抽奖中';
            }
            return '';
        };

        $scope.saveGame = function () {
            gameService.saveGame($scope.selectedGame, function (data) {
                if (data.status == 0) {
                    $('#game-form').modal('hide');
                    $scope.listGames();
                }
            });
        };

        $scope.deleteGame = function (m) {
            if (confirm('确定删除该条记录')) {
                gameService.deleteGame(m, function (data) {
                    if (data.status == 0) {
                        alert('删除成功');
                        $scope.listGames();
                    }
                });
            }
        };
    });
})();
