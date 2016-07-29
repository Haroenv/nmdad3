/**
 * @author    Wesley Vanbrabant
 * @copyright Copyright © 2015-2016 Artevelde University College Ghent
 * @license   Apache License, Version 2.0
 */
;(function () {
    'use strict';

    angular.module('app.register')
        .controller('RegisterCtrl', RegisterCtrl);

    /* @ngInject */
    function RegisterCtrl(
        // Angular
        $log
    ) {
        // ViewModel
        // =========
        var vm = this;

        vm.title = 'Register';

    }

})();
