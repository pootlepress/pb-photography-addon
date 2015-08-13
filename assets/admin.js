/**
 * Plugin admin end scripts
 *
 * @package pootle_page_builder_for_photography
 * @version 1.0.0
 */
jQuery(function ($) {
    var ppbPhoto = {};
    ppbPhoto.dlog = $('#photo-filter-dialog')

    ppbPhoto.dlog.ppbDialog({
        dialogClass: 'image-filter-dialog ppb-cool-panel-container',
        autoOpen: false,
        draggable: false,
        resizable: false,
        title: ppbPhoto.dlog.attr('data-title'),
        height: $(window).height()-50,
        width: $(window).width()-50,
        open: function () {
            var $t = $(this),
                url = ppbPhoto.field.val();
            Caman('#ppb-photo-canvas-0', url, function () {
                this.render(function(){
                    console.log('Done');
                })
            });
            Caman('#ppb-photo-canvas-1', url, function () {
                this.motionBlur();
                this.render(function(){
                    console.log('motionBlur');
                })
            });
            Caman('#ppb-photo-canvas-2', url, function () {
                this.sharpen();
                this.render(function(){
                    console.log('sharpen');
                })
            });
            Caman('#ppb-photo-canvas-3', url, function () {
                this.tiltShift();
                this.render(function(){
                    console.log('tiltShift');
                })
            });
            Caman('#ppb-photo-canvas-4', url, function () {
                this.radialBlur();
                this.render(function(){
                    console.log('radialBlur');
                })
            });
            Caman('#ppb-photo-canvas-5', url, function () {
                this.edgeEnhance();
                this.render(function(){
                    console.log('edgeEnhance');
                })
            });
            Caman('#ppb-photo-canvas-6', url, function () {
                this.edgeDetect();
                this.render(function(){
                    console.log('edgeDetect');
                })
            });
            Caman('#ppb-photo-canvas-7', url, function () {
                this.emboss();
                this.render(function(){
                    console.log('emboss');
                })
            });
            Caman('#ppb-photo-canvas-8', url, function () {
                this.posterize();
                this.render(function(){
                    console.log('posterize');
                })
            });
            Caman('#ppb-photo-canvas-9', url, function () {
                this.vintage();
                this.render(function(){
                    console.log('vintage');
                })
            });
            Caman('#ppb-photo-canvas-10', url, function () {
                this.lomo();
                this.render(function(){
                    console.log('lomo');
                })
            });
            Caman('#ppb-photo-canvas-11', url, function () {
                this.clarity();
                this.render(function(){
                    console.log('clarity');
                })
            });
            Caman('#ppb-photo-canvas-12', url, function () {
                this.sinCity();
                this.render(function(){
                    console.log('sinCity');
                })
            });
            Caman('#ppb-photo-canvas-13', url, function () {
                this.sunrise();
                this.render(function(){
                    console.log('sunrise');
                })
            });
            Caman('#ppb-photo-canvas-14', url, function () {
                this.crossProcess();
                this.render(function(){
                    console.log('crossProcess');
                })
            });
            Caman('#ppb-photo-canvas-15', url, function () {
                this.orangePeel();
                this.render(function(){
                    console.log('orangePeel');
                })
            });
            Caman('#ppb-photo-canvas-16', url, function () {
                this.love();
                this.render(function(){
                    console.log('love');
                })
            });
            Caman('#ppb-photo-canvas-17', url, function () {
                this.grungy();
                this.render(function(){
                    console.log('grungy');
                })
            });
            Caman('#ppb-photo-canvas-18', url, function () {
                this.jarques();
                this.render(function(){
                    console.log('jarques');
                })
            });
            Caman('#ppb-photo-canvas-19', url, function () {
                this.pinhole();
                this.render(function(){
                    console.log('pinhole');
                })
            });
            Caman('#ppb-photo-canvas-20', url, function () {
                this.oldBoot();
                this.render(function(){
                    console.log('oldBoot');
                })
            });
            Caman('#ppb-photo-canvas-21', url, function () {
                this.glowingSun();
                this.render(function(){
                    console.log('glowingSun');
                })
            });
            Caman('#ppb-photo-canvas-22', url, function () {
                this.hazyDays();
                this.render(function(){
                    console.log('hazyDays');
                })
            });
            Caman('#ppb-photo-canvas-23', url, function () {
                this.herMajesty();
                this.render(function(){
                    console.log('herMajesty');
                })
            });
            Caman('#ppb-photo-canvas-24', url, function () {
                this.nostalgia();
                this.render(function(){
                    console.log('nostalgia');
                })
            });
            Caman('#ppb-photo-canvas-25', url, function () {
                this.hemingway();
                this.render(function(){
                    console.log('hemingway');
                })
            });

            Caman('#ppb-photo-canvas-1', url, function () {

            });
            Caman('#ppb-photo-canvas-2', url, function () {
                this.vintage().render();
            });
            Caman('#ppb-photo-canvas-3', url, function () {
                this.lomo().render();
            });
            Caman('#ppb-photo-canvas-4', url, function () {
                this.sinCity().render();
            });
            Caman('#ppb-photo-canvas-5', url, function () {
                this.lomo().render();
            });
            Caman('#ppb-photo-canvas-6', url, function () {
                this.love().render();
            });
            Caman('#ppb-photo-canvas-7', url, function () {
                this.sunrise().render();
            });
            Caman('#ppb-photo-canvas-8', url, function () {
                this.orangePeel().render();
            });
        },
        close: function () {

        },
        buttons: {
            Ok : function(){
                alert('yo')
            }
        }
    })

    $('html').on('pootlepb_admin_input_field_event_handlers', function ( e, $this ) {
        var $$ = $this.find('.filter-button');
        $$.click(function() {
            ppbPhoto.field = $(this).siblings('input');
            ppbPhoto.dlog.ppbDialog('open');
        });
    });
});