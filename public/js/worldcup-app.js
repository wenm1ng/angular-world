(function () {

    angular.module('wc.services', ['ngResource']);
    angular.module('wc.controllers', []);
    angular.module('wc.filters', []);
    angular.module('wc.directives', []);
    angular.module('wc.constants', []).constant('wcConstants', {
        //BASE_URL: 'http://ui.ybf-china.com/',
        // BASE_URL: 'http://worldcup.flower-wine.com/',
        // BASE_URL: 'http://worldcup.com:8099/',
        // BASE_URL: 'http://www.wc.com/',
        BASE_URL: 'http://chat-room.com/',
        PAGE_SIZE: 15
    });

    angular.module('wcapp', ['wc.services', 'wc.controllers', 'wc.constants', 'wc.directives','wc.filters',"bw.paging",'ngFileUpload']);

}());


