function initializePrettyPhotoBehavior($context) {
    var $settings = $context.find('.dm_widget_inner.behaviorable');
    if ($settings.length == 0) return;
    $settings = $settings.metadata();
    if ($settings.prettyPhoto != undefined) {
        $.each($settings.prettyPhoto, function(){
            var galleryName = 'prettyPhoto';
            if (this.prettyPhotoGalleryName != undefined && this.prettyPhotoGalleryName != '') galleryName = 'prettyPhoto[' + this.prettyPhotoGalleryName + ']'; 
            $context.find(this.prettyPhotoConnectedTo).not('.dm.dm_widget_edit').attr('rel', galleryName).prettyPhoto({
                animation_speed:                    this.prettyPhotoAnimationSpeed,
                slideshow:                          this.prettyPhotoSlideShowSpeed,
                autoplay_slideshow:                 this.prettyPhotoAutoplaySlideShow,
                opacity:                            this.prettyPhotoOpacity,
                show_title:                         this.prettyPhotoShowTitle,
                allow_resize:                       this.prettyPhotoAllowResize,
                default_width:                      this.prettyPhotoDefaultWidth,
                default_height:                     this.prettyPhotoDefaultHeight,
                counter_separator_label:            this.prettyPhotoCounterSeparatorLabel,
                theme:                              this.prettyPhotoTheme,
                horizontal_padding:                 this.prettyPhotoHorizontalPadding,
                hideflash:                          this.prettyPhotoHideFlash,
                wmode:                              this.prettyPhotoWmode,
                autoplay:                           this.prettyPhotoAutoPlay,
                modal:                              this.prettyPhotoModal,
                deeplinking:                        this.prettyPhotoDeeplinking,
                overlay_gallery:                    this.prettyPhotoOverlayGallery,
                keyboard_shortcuts:                 this.prettyPhotoKeyboardShortcuts,
                social_tools:                       this.prettyPhotoSocialConnectButtons
            });              
        });
    };
};


(function($) {
    $('#dm_page div.dm_widget').bind('dmWidgetLaunch', function() {
        initializePrettyPhotoBehavior($(this));        
    });
})(jQuery);