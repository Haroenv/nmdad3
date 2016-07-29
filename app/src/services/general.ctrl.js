/**
 * @author    Wesley Vanbrabant
 * @copyright Copyright © 2015-2016 Artevelde University College Ghent
 * @license   Apache License, Version 2.0
 */
;(function () {
    'use strict';

    angular.module('app.general')
        .controller('GeneralCtrl', GeneralCtrl);

    /* @ngInject */
    function GeneralCtrl(
        // Angular
        $log,
        $cordovaCamera
    ) {
        // ViewModel
        // =========
        var vm = this;
        vm.getPhoto = getPhoto;
        vm.lastPhoto = null;

        // Functions
        // =========
       function getPhoto() {
            var cameraOptions = {
                quality: 75,
                targetWidth: 320,
                targetHeight: 320,
                saveToPhotoAlbum: false
            };

            $cordovaCamera
                .getPicture(cameraOptions)
                .then(success, error);

            function error(error) {
                $log.error(error);
                vm.lastPhoto = 'error';
                console.log('fck');
            }

            function success(imageUri) {
                $log.log(imageUri);
                vm.lastPhoto = imageUri;
                console.log("works");
            }

        }

        vm.menu = [
            {
                'href' : '#/',
                'label': 'Home',
                'icon': 'ion-ios-home-outline',
                'icon-hover': 'ion-ios-home'
            },
            {
                'href' : '#/leaderboard',
                'label': 'Leaderboard',
                'icon': 'ion-ios-people-outline',
                'icon-hover': 'ion-ios-people'
            },
            {
                'href': 'javascript:void(0)',
                'label': 'Camera',
                'icon': 'ion-ios-camera-outline',
                'function': 'general.getPhoto()'
            },
            {
                'href' : '#/achievement',
                'label': 'Achievements',
                'icon': 'ion-ios-game-controller-a-outline'
            },
            {
                'href' : '#/profile',
                'label': 'Profile',
                'icon': 'ion-ios-person-outline'
            }
        ];
    }



})();
