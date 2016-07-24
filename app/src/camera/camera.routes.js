/**
 * @author    Olivier Parent
 * @copyright Copyright © 2015-2016 Artevelde University College Ghent
 * @license   Apache License, Version 2.0
 */
;(function () {
    'use strict';

    angular.module('app.camera')
        .config(Routes);

    /* @ngInject */
    function Routes(
        // Angular
        $stateProvider
    ) {
        $stateProvider
            .state('camera', {
                controller: 'CameraCtrl as vm',
                templateUrl: 'templates/camera/camera.view.html',
                url: '/camera'
            });
    }

})();