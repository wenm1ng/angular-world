<?php $__env->startSection('content'); ?>
    <div class="message" ng-app="wcapp" ng-controller="talkCtrl">
        <form>
            <textarea ng-model="talk.content" placeholder="请输入留言内容"></textarea><br/>
            <input type="submit" value="提交" ng-click="addTalk()"/>
        </form>
        <div class="mess-col">
            <div class="mess-list">
                <ul id="ul_scroll">
                    <li ng-repeat="m in talks">
                        <h4>
                            <img src="{{ m.user.avatar }}" alt=""/>
                        </h4>
                        <div>
                            <p>
                                {{ m.content }}
                                <i>{{ m.user.name }}</i>
                            </p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-scripts'); ?>
    <script src="<?php echo e(asset('js/pulltorefresh.js')); ?>"></script>
    <script type="text/javascript">
        var a = PullToRefresh.init({
            mainElement: '#ul_scroll',
            triggerElement: '#ul_scroll',
            onRefresh: function (cb) {
              setTimeout(function () {
                cb();
                var appElement = document.querySelector('[ng-controller=talkCtrl]');
                var $scope = angular.element(appElement).scope();
                    $scope.listTalks($scope.pagingInfo.current_page + 1);
              }, 1500);
            }
        });

        $("#ul_scroll").scroll(function(event) {
            if($(this).scrollTop() +  $(this).height() +50 >= document.getElementById("ul_scroll").scrollHeight){
                var appElement = document.querySelector('[ng-controller=talkCtrl]');
                var $scope = angular.element(appElement).scope();
                $scope.listTalks($scope.pagingInfo.current_page + 1);
            }
        });
    </script>
    <script src="<?php echo e(asset('js/front/talk-service-controller.js')); ?>"></script>
    <script>
        $('.title ul').children().eq(2).addClass('acti');
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.front', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>