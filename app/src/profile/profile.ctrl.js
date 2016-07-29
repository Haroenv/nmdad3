/**
 * @author    Wesley Vanbrabant
 * @copyright Copyright © 2015-2016 Artevelde University College Ghent
 * @license   Apache License, Version 2.0
 */
;(function () {
    'use strict';

    angular.module('app.profile')
        .controller('ProfileCtrl', ProfileCtrl);

    /* @ngInject */
    function ProfileCtrl(
        // Angular
    ) {
        // ViewModel
        // =========
        var vm = this;

        vm.title = 'Profile';

        vm.profile =
            {
             'firstName': 'Wesley',
             'lastName': 'Vanbrabant',
             'email': 'wesley@test.be',
             'score': '100'
            }
        ;
    }

})();
