/**
 * @author    Olivier Parent
 * @copyright Copyright © 2015-2016 Artevelde University College Ghent
 * @license   Apache License, Version 2.0
 */
;(function () {
    'use strict';

    angular.module('app.camera')
        .controller('CameraCtrl', CameraCtrl);

    /* @ngInject */
    function CameraCtrl(
        // Angular
        $log,
        // ngCordova
        $cordovaCamera
    ) {
        // ViewModel
        // =========
        var vm = this;

        vm.getPhoto = getPhoto;
        vm.lastPhoto = null;
        vm.title = 'Camera Demo';
        vm.navbottom = true;

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
            }

            function success(imageUri) {
                $log.log(imageUri);
                vm.lastPhoto = imageUri;
            }
        }
        

    }

})();
