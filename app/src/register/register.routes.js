/**
 * @author    Wesley Vanbrabant
 * @copyright Copyright © 2015-2016 Artevelde University College Ghent
 * @license   Apache License, Version 2.0
 */
;(function () {
    'use strict';

    angular.module('app.register')
        .config(Routes);

    /* @ngInject */
    function Routes(
        // Angular
        $stateProvider
    ) {
        $stateProvider
            .state('register', {
                controller: 'RegisterCtrl as vm',
                templateUrl: 'templates/register/register.view.html',
                url: '/register'
            });
    }

})();