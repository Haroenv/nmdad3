/**
 * @author    Olivier Parent
 * @copyright Copyright © 2015-2016 Artevelde University College Ghent
 * @license   Apache License, Version 2.0
 */
;(function () {
    'use strict';

    var secure = false;

    angular.module('app')
        .constant('config', {
            api: {
                protocol: secure ? 'https' : 'http',
                host    : 'www.trashcam.local',
                path    : '/api/v1/'
            }
        });
})();
