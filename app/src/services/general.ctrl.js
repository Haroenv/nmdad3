/**
 * @author    Wesley Vanbrabant
 * @copyright Copyright © 2015-2016 Artevelde University College Ghent
 * @license   Apache License, Version 2.0
 */
;(function () {
    'use strict';

    angular.module('app.general')
        .controller('GeneralCtrl', GeneralCtrl);

    /* @ngInject */
    function GeneralCtrl(
        // Angular
    ) {
        // ViewModel
        // =========
        var vm = this;

        vm.menu = [
            {
                'href' : '/camera',
                'label': 'Camera',
                'icon': 'ion-ios-camera'
            },
            {
                'href' : '/leaderboard',
                'label': 'Leaderboard',
                'icon': 'ion-ios-people'
            },
            {
                'href' : '/achievements',
                'label': 'Achievements',
                'icon': 'ion-ribbon-b'
            },
            {
                'href' : '/profile',
                'label': 'Profile',
                'icon': 'ion-person'
            }
        ];
    }

})();
