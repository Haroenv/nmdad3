/**
 * @author    Olivier Parent
 * @copyright Copyright © 2015-2016 Artevelde University College Ghent
 * @license   Apache License, Version 2.0
 */
;(function () {
    'use strict';

    angular.module('app.achievement')
        .controller('AchievementCtrl', AchievementCtrl);

    /* @ngInject */
    function AchievementCtrl(
        // Angular
        $log
    ) {
        // ViewModel
        // =========

        var vm = this;
        vm.title = 'Achievements';


        vm.achievements = [
            {
                'image': 'http://placehold.it/125x125',
                'label': 'Spotter',
                'body': 'hey, you spotted so much, cool!'
            },
            {
                'image': 'http://placehold.it/125x125',
                'label': 'Cool badge',
                'body': 'hey, you spotted so much, cool!'
            },
            {
                'image': 'http://placehold.it/125x125',
                'label': 'noice badge 3',
                'body': 'hey, you spotted so much, cool!' 
            },
            {
                'image': 'http://placehold.it/125x125',
                'label': 'Aha badge',
                'body': 'hey, you spotted so much, cool!'
            }
        ];

    }

})();
