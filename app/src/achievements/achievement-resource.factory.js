/**
 * @author    Wesley Vanbrabant
 * @copyright Copyright © 2014-2015 Artevelde University College Ghent
 * @license   Apache License, Version 2.0
 */
;(function () {
    'use strict';

    angular.module('app.achievement')
        .factory('AchievementResourceFactory', AchievementResourceFactory);

    /* @ngInject */
    function AchievementResourceFactory(
        // Angular
        $resource,
        // Custom
        UriFactory
    ) {
        var url = UriFactory.getApi('achievements:format');

        var paramDefaults = {
            format    : '.json'
        };

        var actions = {

        };

        return $resource(url, paramDefaults, actions);
    }

})();
