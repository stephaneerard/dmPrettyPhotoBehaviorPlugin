<?php
/**
 * Description of dmPrettyPhotoPluginView
 *
 * @author TheCelavi
 */
class dmPrettyPhotoBehaviorView extends dmBehaviorView {
    
    public function filterSettings($settings) {
        $settings = parent::filterSettings($settings);
        $settings['prettyPhotoSlideShowSpeed'] = (isset($settings['prettyPhotoSlideShow']) && $settings['prettyPhotoSlideShow']) ? $settings['prettyPhotoSlideShowSpeed'] : false;
        $settings['prettyPhotoAutoplaySlideShow'] = (isset($settings['prettyPhotoSlideShow'])) ? $settings['prettyPhotoSlideShow'] : false;
        $settings['prettyPhotoOpacity'] = round($settings['prettyPhotoOpacity'] / 100, 2);
        $settings['prettyPhotoShowTitle'] = (isset ($settings['prettyPhotoShowTitle'])) ? $settings['prettyPhotoShowTitle'] : false;
        $settings['prettyPhotoAllowResize'] = (isset($settings['prettyPhotoAllowResize'])) ? $settings['prettyPhotoAllowResize'] : false;
        $settings['prettyPhotoHideFlash'] = (isset ($settings['prettyPhotoHideFlash'])) ? $settings['prettyPhotoHideFlash'] : false;
        $settings['prettyPhotoAutoPlay'] = (isset ($settings['prettyPhotoAutoPlay'])) ? $settings['prettyPhotoAutoPlay'] : false;
        $settings['prettyPhotoModal'] = (isset ($settings['prettyPhotoModal'])) ? $settings['prettyPhotoModal'] : false;
        $settings['prettyPhotoDeeplinking'] = (isset ($settings['prettyPhotoDeeplinking'])) ? $settings['prettyPhotoDeeplinking'] : false;
        $settings['prettyPhotoOverlayGallery'] = (isset ($settings['prettyPhotoOverlayGallery'])) ? $settings['prettyPhotoOverlayGallery'] : false;
        $settings['prettyPhotoKeyboardShortcuts'] = (isset ($settings['prettyPhotoKeyboardShortcuts'])) ? $settings['prettyPhotoKeyboardShortcuts'] : false;        
        
        $socialHTML = '';
        
        if (isset ($settings['prettyPhotoSocialFacebookLike']) && $settings['prettyPhotoSocialFacebookLike']) $socialHTML .= $this->getFBLikeHtml();
        unset ($settings['prettyPhotoSocialFacebookLike']);
        if (isset ($settings['prettyPhotoSocialTwitter']) && $settings['prettyPhotoSocialTwitter']) $socialHTML .= $this->getTwitterHtml();
        unset ($settings['prettyPhotoSocialTwitter']);
        
        $settings['prettyPhotoSocialConnectButtons'] = ($socialHTML != '') ? '<div class="pp_social">'.$socialHTML.'</div>' : false;
                
        return $settings;
    }

    public function getJavascripts() {
        return array_merge(
            parent::getJavascripts(),            
            array(
                '/dmPrettyPhotoBehaviorPlugin/js/jquery.prettyPhoto.js',
                '/dmPrettyPhotoBehaviorPlugin/js/launch.js'            
            )
        );
    }
    
    public function getStylesheets() {
        return array_merge(
            parent::getStylesheets(),
            array(
                '/dmPrettyPhotoBehaviorPlugin/css/prettyPhoto.css'
            )
        );
    }
    
    private function getTwitterHtml() {
        return 
            '<div class="twitter">
                <a href="http://twitter.com/share" class="twitter-share-button" data-count="none">Tweet</a>
                <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
             </div>';
    }
    
    private function getFBLikeHtml() {
        return 
            '<div class="facebook">
                <iframe src="http://www.facebook.com/plugins/like.php?locale=en_US&href=\'+location.href+\'&amp;layout=button_count&amp;show_faces=true&amp;width=500&amp;action=like&amp;font&amp;colorscheme=light&amp;height=23" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:500px; height:23px;" allowTransparency="true"></iframe>
            </div>';
    }
    //<div class="pp_social"></div>
}

