(function () {

    angular.module('wc.services').factory('teamService', ['$resource', '$q', 'wcConstants', function ($resource, $q, wcConstants) {
        return $resource(wcConstants.BASE_URL + "admin/team/:action", {"action": "@action"}, {
            listTeams: {
                isArray: true,
                params: {action: 'list'}
            },
            deleteTeam: {
                method: 'POST',
                isArray: false,
                params: {action: 'delete'}
            }
        });
    }]);

    angular.module('wc.controllers').controller('teamCtrl', function ($scope, Upload, teamService, wcConstants) {

        $scope.teams = [];
        $scope.listTeams = function () {
            teamService.listTeams({}, function (data) {
                $scope.teams = data;
            });
        };

        $scope.selectedTeam = {};
        $scope.openTeamForm = function (o) {
            if (null != o) {
                $scope.selectedTeam = o;
            } else {
                $scope.selectedTeam = {};
            }
            $('#team-form').modal('show');
        };


        $scope.saveTeam = function (flagFile) {
            $scope.selectedTeam.flag_url = flagFile;

            if (flagFile == null) {
                flagFile = {};
            }

            flagFile.upload = Upload.upload({
                url: wcConstants.BASE_URL + 'admin/team/save',
                data: $scope.selectedTeam
            }).then(function (result) {
                if (result.data.status == 0) {
                    teamService.listTeams({}, function (data) {
                        $scope.teams = data;
                        $('#team-form').modal('hide');
                    });
                }
            }, null, null);
        };
        $scope.deleteTeam = function (m) {
            if (confirm('确定删除该条记录')) {
                teamService.deleteTeam(m, function (data) {
                    if (data.status == 0) {
                        alert('删除成功');
                        teamService.listTeams({}, function (data) {
                            $scope.teams = data;
                        });
                    }
                });
            }
        };

    });
})();
