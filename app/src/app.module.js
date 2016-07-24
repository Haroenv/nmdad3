/**
 * @author    Olivier Parent
 * @copyright Copyright © 2015-2016 Artevelde University College Ghent
 * @license   Apache License, Version 2.0
 */
;(function () {
    'use strict';

    // Module declarations
    angular.module('app', [
        'ionic',
        'ngCordova',
        'ngResource',
        // Modules
        'app.general',
        'app.common',
        'app.camera',
        'app.services'
    ]);

})();
