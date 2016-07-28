/**
 * @author    Wesley Vanbrabant
 * @copyright Copyright © 2015-2016 Artevelde University College Ghent
 * @license   Apache License, Version 2.0
 */
;(function () {
    'use strict';

    angular.module('app.leaderboard')
        .config(Routes);

    /* @ngInject */
    function Routes(
        // Angular
        $stateProvider
    ) {
        $stateProvider
            .state('profile', {
                controller: 'ProfileCtrl as vm',
                templateUrl: 'templates/profile/profile.view.html',
                url: '/profile'
            });
    }

})();