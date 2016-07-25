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

        function chunk(arr, size) {
            var newArr = [];
            for (var i=0; i<arr.length; i+=size) {
                newArr.push(arr.slice(i, i+size));
            }
            return newArr;
        }

        vm.achievements = [
            {
                'image': 'http://placehold.it/125x125',
                'title': 'Spotter',
                'body': 'hey, you spotted so much, cool!'
            },
            {
                'image': 'http://placehold.it/125x125',
                'title': 'Cool badge',
                'body': 'hey, you spotted so much, cool!'
            },
            {
                'image': 'http://placehold.it/125x125',
                'title': 'noice badge',
                'body': 'hey, you spotted so much, cool!' 
            },
            {
                'image': 'http://placehold.it/125x125',
                'title': 'Aha badge',
                'body': 'hey, you spotted so much, cool!'
            },
            {
                'image': 'http://placehold.it/125x125',
                'title': 'Cool badge',
                'body': 'hey, you spotted so much, cool!'
            },
            {
                'image': 'http://placehold.it/125x125',
                'title': 'noice badge',
                'body': 'hey, you spotted so much, cool!'
            },
            {
                'image': 'http://placehold.it/125x125',
                'title': 'Spotter',
                'body': 'hey, you spotted so much, cool!'
            },
            {
                'image': 'http://placehold.it/125x125',
                'title': 'Cool badge',
                'body': 'hey, you spotted so much, cool!'
            }
        ];

        vm.data = chunk(vm.achievements, 2);


    }

})();
