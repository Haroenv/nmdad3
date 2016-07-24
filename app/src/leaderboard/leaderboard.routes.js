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
            .state('leaderboard', {
                controller: 'LeaderboardCtrl as vm',
                templateUrl: 'templates/leaderboard/leaderboard.view.html',
                url: '/leaderboard'
            });
    }

})();