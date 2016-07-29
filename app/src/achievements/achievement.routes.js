/**
 * @author    Wesley Vanbrabant
 * @copyright Copyright © 2015-2016 Artevelde University College Ghent
 * @license   Apache License, Version 2.0
 */
;(function () {
    'use strict';

    angular.module('app.achievement')
        .config(Routes);

    /* @ngInject */
    function Routes(
        // Angular
        $stateProvider
    ) {
        $stateProvider
            .state('achievement', {
                controller: 'AchievementCtrl as vm',
                templateUrl: 'templates/achievements/achievement.view.html',
                url: '/achievement'
            });
    }

})();