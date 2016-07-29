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

        vm.reports = [
            {
                'name' : 'Wesley',
                'location': 'coolstraat 1',
                'city': 'Ghent',
                'image': 'http://placehold.it/500x500',
                'description': 'lorem ipsum doler matum',
                'time': '22 minutes ago'
            },
            {
                'name' : 'Wesley',
                'location': 'coolstraat 1',
                'city': 'Diksmuide',
                'image': 'http://placehold.it/500x500',
                'description': 'lorem ipsum doler matum',
                'time': '22 minutes ago'
            },
            {
                'name' : 'Wesley',
                'location': 'coolstraat 1',
                'city': 'Lichtervelde',
                'image': 'http://placehold.it/500x500',
                'description': 'lorem ipsum doler matum',
                'time': '22 minutes ago'
            },
            {
                'name' : 'Wesley',
                'location': 'coolstraat 1',
                'city': 'Cooltown',
                'image': 'http://placehold.it/500x500',
                'description': 'lorem ipsum doler matum',
                'time': '22 minutes ago'
            }
        ];
    }

})();
