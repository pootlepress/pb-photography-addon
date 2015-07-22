/**
 * Plugin front end scripts
 *
 * @package pootle_page_builder_for_photography
 * @version 0.1.0
 */

/**
 * Created by shramee on 16/6/15.
 */
jQuery(function ($) {

    $(document).ready(function () {

        /**
         * Adds Ken Burns functionality
         */
        ppbxPhotoKenBurns = function () {
            $('.ppbx-photo-ken-burns').each(function () {
                var $t = $(this);

                var image_url = $t.attr('data-ken-burns-img');
                var image_url2 = $t.attr('data-ken-burns-img2');

                ppbxPhotoKenBImgReady(image_url2, $t, 2);
                ppbxPhotoKenBImgReady(image_url, $t, 1);

            });
        };

        ppbxPhotoKenBImgReady = function (image_url, $t, img_i) {

            if (image_url) {

                if ($t.data('kenB' + img_i + '$img')) {
                    image = $t.data('kenB' + img_i + '$img');

                    ppbxPhotoKenBimgHiWit(image, $t);
                    return;

                }
                image = $('<img src="' + image_url + '" class="ppbx-photo-ken-b ppbx-photo-ken-burns' + img_i + '">');

                $t.prepend(image);

                // just in case it is not already loaded
                image.load(function () {

                    var image = $(this);

                    $t.data('kenB' + img_i + '$img', $(this));

                    ppbxPhotoKenBimgHiWit(image, $t);

                });

                image.src = image_url;
            }
        };

        ppbxPhotoKenBimgHiWit = function (image, $t) {

            var ratio = image.width() / image.height(),
                minWid = $t.outerWidth() + 50;

            if (( minWid / ratio ) > $t.outerHeight()) {
                image.css({
                    height: 'auto',
                    width: (minWid) + 'px'
                });
            } else {
                image.css({
                    height: '100%',
                    width: 'auto'
                });
            }
        };

        $('.panel-grid').each(function () {

            var $t = $(this);
            $t.imagesLoaded().always(function (instance) {


                $t.find('.ppbx-photo-ken-b').addClass('ppbx-photo-ken-burns');
                ppbxPhotoKenBImgtoggle();
            });
        });

        ppbxPhotoKenBImgtoggle = function () {

            setTimeout(ppdKenBShowImg2, 8000)

        };

        ppdKenBHideImg2 = function () {

            $('.ppbx-photo-ken-burns2').fadeTo(500, 0, function () {
                setTimeout(ppdKenBShowImg2, 7500)
            });

        };
        ppdKenBShowImg2 = function () {

            $('.ppbx-photo-ken-burns2').fadeTo(500, 1, function () {
                setTimeout(ppdKenBHideImg2, 7500)
            });

        };

        ppbxPhotoCorrectOnResize = function () {
            ppbxPhotoKenBurns();
        };

        $(window).resize(ppbxPhotoCorrectOnResize);
        ppbxPhotoCorrectOnResize();

    });
});