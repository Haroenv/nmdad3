/**
 * @author    Olivier Parent
 * @copyright Copyright © 2015-2016 Artevelde University College Ghent
 * @license   Apache License, Version 2.0
 */
;(function () {
    'use strict';

    angular.module('app.leaderboard')
        .controller('LeaderboardCtrl', LeaderboardCtrl);

    /* @ngInject */
    function LeaderboardCtrl(
        // Angular
        $log
    ) {
        // ViewModel
        // =========
        var vm = this;

        vm.title = 'Leaderboard';

        vm.scores = [
            {
                'name': 'Wesley',
                'score': '100'
            },
            {
                'name': 'Thomas',
                'score': '90'
            },
            {
                'name': 'Mathias',
                'score': '75'
            },
            {
                'name': 'Patrick',
                'score': '65'
            },
            {
                'name': 'John',
                'score': '45'
            }
        ];
    }

})();
