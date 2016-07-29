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
        $log,
        //custom
        AchievementResourceFactory

    ) {
        // ViewModel
        // =========

        var vm = this;
        vm.title = 'Achievements';
        vm.loading = true;
        vm.achievements = getAchievements();

        function chunk(arr, size) {
            var newArr = [];
            for (var i=0; i<arr.length; i+=size) {
                newArr.push(arr.slice(i, i+size));
            }
            return newArr;
        }

        function getAchievements() {
            return AchievementResourceFactory
                .query(
                    success,
                    error
                );

            function error(error) {
                $log.error('getArticles Error:', error);
            }

            function success(resource, responseHeader) {
                $log.log('getArticles Success:', resource, responseHeader());
                vm.loading = false;
            }
        }
        
        vm.data = chunk(vm.achievements, 2);
    }

})();
