(function () {

    angular.module('wc.services').factory('addressService', ['$resource', '$q', 'wcConstants', function ($resource, $q, wcConstants) {
        return $resource(wcConstants.BASE_URL + "address/:action", {"action": "@action"}, {
            load: {
                isArray: false,
                params: {action: 'load'}
            },
            save: {
                method: 'POST',
                isArray: false,
                params: {action: 'save'}
            }
        });
    }]);

    angular.module('wc.controllers').controller('addressCtrl', function ($scope, addressService) {

        $scope.user = addressService.load();

        $scope.saveAddress = function () {
            if($("#name").val() == ""){
                alert('请输入姓名');return false;
            }
            if($("#iphone").val() == ""){
                alert('请输入手机号码');return false;
            }
            if($("#iphone").length > 11){
                alert('请输入正确的手机号码');return false;
            }
            if($("#address").val() == ""){
                alert('请输入奖品收货地址');return false;
            }

            addressService.save($scope.user,function (data) {
                if (data.status == 0) {
                    alert('保存成功');
                    setTimeout(function(){
                        window.location.href = '/';
                    }, 1500)
                }
            });
        };
    });
})();
