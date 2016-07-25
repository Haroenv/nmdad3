/**
 * @author    Olivier Parent
 * @copyright Copyright © 2015-2016 Artevelde University College Ghent
 * @license   Apache License, Version 2.0
 */
;(function () {
    'use strict';

    angular.module('app.common')
        .controller('HomeCtrl', HomeCtrl);

    /* @ngInject */
    function HomeCtrl(
        // Angular
        $log
    ) {
        // ViewModel
        // =========
        var vm = this;

        vm.title = 'Home';

        vm.links = [
            {
                'href' : '/camera',
                'label': 'Camera',
                'color': '#1DB8D1'
            },
            {
                'href' : '/leaderboard',
                'label': 'Leaderboard',
                'color': '#F49719'
            },
            {
                'href' : '/achievement',
                'label': 'Achievements',
                'color': '#1DB8D1'
            },
            {
                'href' : '/profile',
                'label': 'Profile',
                'color': '#F49719'
            }
        ];
    }

})();
