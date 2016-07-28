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
                'image': 'http://placehold.it/75x75',
                'title': 'Spotter'
            },
            {
                'image': 'http://placehold.it/75x75',
                'title': 'Cool badge'
            },
            {
                'image': 'http://placehold.it/75x75',
                'title': 'noice badge'

            },
            {
                'image': 'http://placehold.it/75x75',
                'title': 'Aha badge'
            },
            {
                'image': 'http://placehold.it/75x75',
                'title': 'Cool badge'
            },
            {
                'image': 'http://placehold.it/75x75',
                'title': 'noice badge'
            },
            {
                'image': 'http://placehold.it/75x75',
                'title': 'Spotter'
            },
            {
                'image': 'http://placehold.it/75x75',
                'title': 'Cool badge'
            }
        ];

        vm.data = chunk(vm.achievements, 2);


    }

})();
