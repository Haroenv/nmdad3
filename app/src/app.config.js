/**
 * @author    Olivier Parent
 * @copyright Copyright © 2015-2016 Artevelde University College Ghent
 * @license   Apache License, Version 2.0
 */
;(function () {
    'use strict';

    angular.module('app')
        .config(Config);

    /* @ngInject */
    function Config(
        // Angular
        $compileProvider,
        $httpProvider,
        $urlRouterProvider,
        $ionicConfigProvider
    ) {
        // Allow 'app:' as protocol (for use in Hybrid Mobile apps)
        $compileProvider
            .aHrefSanitizationWhitelist(/^\s*(https?|ftp|mailto|tel|file|app):/)
            .imgSrcSanitizationWhitelist(/^\s*((https?|ftp|file|app):|data:image\/)/)
        ;

        // Basic Auth
        var username = 'nmdad3_gebruiker',
            password = 'nmdad3_wachtwoord',
            credentials = window.btoa(username + ':' + password);
        $httpProvider.defaults.headers.common['Authorization'] = 'Basic ' + credentials;

        // Routes
        $urlRouterProvider.otherwise('/');

        //
        $ionicConfigProvider.tabs.position('bottom');



        // if (this.navbottom === true ) {
        //     this.nav =
        //         "<div class='tabs tabs-icon-top' ng-controller='GeneralCtrl as general'>" +
        //         "<a class='tab-item' ng-repeat='item in general.menu' href='#{{ item.href }}'>" +
        //         "<i class='icon {{ item.icon }}'></i>" +
        //         "{{ item.label }}" +
        //         "</a>" +
        //         "</div>" ;
        // }
    }

})();
