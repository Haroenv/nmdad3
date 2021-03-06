/**
 * @author    Olivier Parent
 * @copyright Copyright © 2015-2016 Artevelde University College Ghent
 * @license   Apache License, Version 2.0
 */
;(function () {
    'use strict';

    angular.module('app.services')
        .factory('UriFactory', UriFactory);

    /* @ngInject */
    function UriFactory(
        // Angular
        $location,
        // Custom
        config
    ) {
        function getApi(path) {
            var protocol = config.api.protocol ? config.api.protocol : $location.protocol(),
                host     = config.api.host     ? config.api.host     : $location.host(),
                uri      = protocol + '://' + host + config.api.path + path;

            return uri;
        }

        return {
            getApi: getApi
        };
    }

})();
