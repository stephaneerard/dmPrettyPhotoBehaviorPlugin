<?php

/**
 * Description of dmPrettyPhotoPluginForm
 *
 * @author TheCelavi
 */
class dmPrettyPhotoBehaviorForm extends dmBehaviorForm {
    
    protected $prettyPhotoAnimationSpeed = array(
        'fast'=>'Fast',
        'slow'=>'Slow',
        'normal'=>'Normal'
    );
    protected $prettyPhotoTheme = array(
        'pp_default'=>'Default',
        'light_rounded'=>'Light rounded',
        'dark_rounded'=>'Dark rounded',
        'light_square'=>'Light square',
        'dark_square'=>'Dark square',
        'facebook'=>'Facebook'
    );
    protected $prettyPhotoWmode = array(
        'window'=>'window',
        'direct'=>'direct',
        'opaque'=>'opaque',
        'transparent'=>'transparent',
        'gpu'=>'gpu'
    );
    
    public function configure() {
        parent::configure();
        // Connected to
        $this->widgetSchema['prettyPhotoConnectedTo'] = new sfWidgetFormTextarea(array(), array('style'=>'width:90%'));
        $this->validatorSchema['prettyPhotoConnectedTo'] = new sfValidatorString(array(
            'required'=>false
        ));
        $this->widgetSchema['prettyPhotoConnectedTo']->setLabel('DOM selectors');   
        $this->getWidgetSchema()->setHelp('prettyPhotoConnectedTo', 'Enter DOM selectors for Pretty Photo activation, separate with comma');
        if (!$this->getDefault('prettyPhotoConnectedTo')) $this->setDefault('prettyPhotoConnectedTo', 'a');
        // Gallery name
        $this->widgetSchema['prettyPhotoGalleryName'] = new sfWidgetFormInputText(array(), array('style'=>'width:90%'));
        $this->validatorSchema['prettyPhotoGalleryName'] = new sfValidatorString(array(
            'required'=>false
        ));
        $this->widgetSchema['prettyPhotoGalleryName']->setLabel('Gallery name');   
        $this->getWidgetSchema()->setHelp('prettyPhotoGalleryName', 'Enter name of the gallery for the each item');
        if (!$this->getDefault('prettyPhotoConnectedTo')) $this->setDefault('prettyPhotoConnectedTo', 'pretty_photo_gallery_' . dmString::random(4));
        // Animation speed
        $this->widgetSchema['prettyPhotoAnimationSpeed'] = new sfWidgetFormChoice(
                array('choices'=>$this->prettyPhotoAnimationSpeed)
        );
        $this->validatorSchema['prettyPhotoAnimationSpeed'] = new sfValidatorChoice(
                array('choices'=>  array_keys($this->prettyPhotoAnimationSpeed))
        );
        $this->widgetSchema['prettyPhotoAnimationSpeed']->setLabel('Animation speed');
        if (!$this->getDefault('prettyPhotoAnimationSpeed')) $this->setDefault('prettyPhotoAnimationSpeed', 'normal');
        
        // Slide show
        $this->widgetSchema['prettyPhotoSlideShow'] = new sfWidgetFormInputCheckbox();
        $this->validatorSchema['prettyPhotoSlideShow'] = new sfValidatorBoolean();
        $this->widgetSchema['prettyPhotoSlideShow']->setLabel('Slide show');
        $this->getWidgetSchema()->setHelp('prettyPhotoSlideShow', 'Does Pretty Photo starts with slide show?');
        
        // Slide show speed
        $this->widgetSchema['prettyPhotoSlideShowSpeed'] = new sfWidgetFormInputText();
        $this->validatorSchema['prettyPhotoSlideShowSpeed'] = new sfValidatorInteger(
                array(
                    'min'=>0,
                    'max'=>10000,
                    'required'=>false
                )
        );
        $this->widgetSchema['prettyPhotoSlideShowSpeed']->setLabel('Slide show speed');
        $this->getWidgetSchema()->setHelp('prettyPhotoSlideShowSpeed', 'Speed in ms');
        if (!$this->getDefault('prettyPhotoSlideShowSpeed')) $this->setDefault('prettyPhotoSlideShowSpeed', 3000);
        // Opacity
        $this->widgetSchema['prettyPhotoOpacity'] = new sfWidgetFormInputText();
        $this->validatorSchema['prettyPhotoOpacity'] = new sfValidatorInteger(
                array(
                    'min'=>0,
                    'max'=>100,
                    'required'=>true
                )
        );
        $this->widgetSchema['prettyPhotoOpacity']->setLabel('Opacity');
        if (!$this->getDefault('prettyPhotoOpacity')) $this->setDefault('prettyPhotoOpacity', 80);
        $this->getWidgetSchema()->setHelp('prettyPhotoOpacity', '0 for transparent, 100 for opaque, default 80');
        
        // Show title
        $this->widgetSchema['prettyPhotoShowTitle'] = new sfWidgetFormInputCheckbox();
        $this->validatorSchema['prettyPhotoShowTitle'] = new sfValidatorBoolean();
        $this->widgetSchema['prettyPhotoShowTitle']->setLabel('Show title');
        $this->getWidgetSchema()->setHelp('prettyPhotoShowTitle', 'Display title for each item');
        // Alow resize
        $this->widgetSchema['prettyPhotoAllowResize'] = new sfWidgetFormInputCheckbox();
        $this->validatorSchema['prettyPhotoAllowResize'] = new sfValidatorBoolean();
        $this->widgetSchema['prettyPhotoAllowResize']->setLabel('Allow resize');        
        $this->getWidgetSchema()->setHelp('prettyPhotoAllowResize', 'Resize the photos bigger than viewport');
        // Default width
        $this->widgetSchema['prettyPhotoDefaultWidth'] = new sfWidgetFormInputText();
        $this->validatorSchema['prettyPhotoDefaultWidth'] = new sfValidatorInteger(
                array(
                    'min'=>300,
                    'max'=>2000,
                    'required'=>true
                )
        );
        $this->widgetSchema['prettyPhotoDefaultWidth']->setLabel('Default width');
        if (!$this->getDefault('prettyPhotoDefaultWidth')) $this->setDefault('prettyPhotoDefaultWidth', 500);
        // Default height
        $this->widgetSchema['prettyPhotoDefaultHeight'] = new sfWidgetFormInputText();
        $this->validatorSchema['prettyPhotoDefaultHeight'] = new sfValidatorInteger(
                array(
                    'min'=>150,
                    'max'=>2000,
                    'required'=>true
                )
        );
        $this->widgetSchema['prettyPhotoDefaultHeight']->setLabel('Default height');
        if (!$this->getDefault('prettyPhotoDefaultHeight')) $this->setDefault('prettyPhotoDefaultHeight', 350);
        // Counter separator label
        $this->widgetSchema['prettyPhotoCounterSeparatorLabel'] = new sfWidgetFormInputText();
        $this->validatorSchema['prettyPhotoCounterSeparatorLabel'] = new sfValidatorString(
                array(
                    'required'=>true
                )
        );
        $this->widgetSchema['prettyPhotoCounterSeparatorLabel']->setLabel('Counter separator label');
        $this->getWidgetSchema()->setHelp('prettyPhotoCounterSeparatorLabel', 'The separator for the gallery counter 1 "of" 2');
        if (!$this->getDefault('prettyPhotoCounterSeparatorLabel')) $this->setDefault('prettyPhotoCounterSeparatorLabel', '/');
        
        
        // Theme
        $this->widgetSchema['prettyPhotoTheme'] = new sfWidgetFormChoice(
                array('choices'=>$this->prettyPhotoTheme)
        );
        $this->validatorSchema['prettyPhotoTheme'] = new sfValidatorChoice(
                array('choices'=>  array_keys($this->prettyPhotoTheme))
        );
        $this->widgetSchema['prettyPhotoTheme']->setLabel('Theme');
        if (!$this->getDefault('prettyPhotoTheme')) $this->setDefault('prettyPhotoTheme', 'pp_default');
        // Horizontal padding
        $this->widgetSchema['prettyPhotoHorizontalPadding'] = new sfWidgetFormInputText();
        $this->validatorSchema['prettyPhotoHorizontalPadding'] = new sfValidatorInteger(
                array(
                    'min'=>0,
                    'max'=>100,
                    'required'=>true
                )
        );
        $this->widgetSchema['prettyPhotoHorizontalPadding']->setLabel('Horizontal padding');
        if (!$this->getDefault('prettyPhotoHorizontalPadding')) $this->setDefault('prettyPhotoHorizontalPadding', 20);
        // Hide flash
        $this->widgetSchema['prettyPhotoHideFlash'] = new sfWidgetFormInputCheckbox();
        $this->validatorSchema['prettyPhotoHideFlash'] = new sfValidatorBoolean();
        $this->widgetSchema['prettyPhotoHideFlash']->setLabel('Hide flash');
        // wmode
        $this->widgetSchema['prettyPhotoWmode'] = new sfWidgetFormChoice(
                array('choices'=>$this->prettyPhotoWmode)
        );
        $this->validatorSchema['prettyPhotoWmode'] = new sfValidatorChoice(
                array('choices'=>  array_keys($this->prettyPhotoWmode))
        );
        $this->widgetSchema['prettyPhotoWmode']->setLabel('Flash wmode');
        if (!$this->getDefault('prettyPhotoWmode')) $this->setDefault('prettyPhotoWmode', 'opaque');
        // Auto play
        $this->widgetSchema['prettyPhotoAutoPlay'] = new sfWidgetFormInputCheckbox();
        $this->validatorSchema['prettyPhotoAutoPlay'] = new sfValidatorBoolean();
        $this->widgetSchema['prettyPhotoAutoPlay']->setLabel('Auto play video');
        // Modal
        $this->widgetSchema['prettyPhotoModal'] = new sfWidgetFormInputCheckbox();
        $this->validatorSchema['prettyPhotoModal'] = new sfValidatorBoolean();
        $this->widgetSchema['prettyPhotoModal']->setLabel('Modal window');
        
        // deeplinking
        $this->widgetSchema['prettyPhotoDeeplinking'] = new sfWidgetFormInputCheckbox();
        $this->validatorSchema['prettyPhotoDeeplinking'] = new sfValidatorBoolean();
        $this->widgetSchema['prettyPhotoDeeplinking']->setLabel('Deeplinking');
        
        // overlay_gallery
        $this->widgetSchema['prettyPhotoOverlayGallery'] = new sfWidgetFormInputCheckbox();
        $this->validatorSchema['prettyPhotoOverlayGallery'] = new sfValidatorBoolean();
        $this->widgetSchema['prettyPhotoOverlayGallery']->setLabel('Overlay gallery');
        
        // keyboard_shortcuts
        $this->widgetSchema['prettyPhotoKeyboardShortcuts'] = new sfWidgetFormInputCheckbox();
        $this->validatorSchema['prettyPhotoKeyboardShortcuts'] = new sfValidatorBoolean();
        $this->widgetSchema['prettyPhotoKeyboardShortcuts']->setLabel('Keyboard shortcuts');
        
        // Facebook Like
        $this->widgetSchema['prettyPhotoSocialFacebookLike'] = new sfWidgetFormInputCheckbox();
        $this->validatorSchema['prettyPhotoSocialFacebookLike'] = new sfValidatorBoolean();
        $this->widgetSchema['prettyPhotoSocialFacebookLike']->setLabel('Facebook like');
        $this->getWidgetSchema()->setHelp('prettyPhotoSocialFacebookLike', 'Show Facebook like button');
        
        // Twitter
        $this->widgetSchema['prettyPhotoSocialTwitter'] = new sfWidgetFormInputCheckbox();
        $this->validatorSchema['prettyPhotoSocialTwitter'] = new sfValidatorBoolean();
        $this->widgetSchema['prettyPhotoSocialTwitter']->setLabel('Twitter');
        $this->getWidgetSchema()->setHelp('prettyPhotoSocialTwitter', 'Show Twitter button');
        
    }
    
    public function render($attributes = array()) {
        $formRenderer = new dmFrontFormRenderer(array(
            new dmFrontFormSection(
                    array(
                        array("name"=>'prettyPhotoConnectedTo', "is_big"=>true),
                        array("name"=>'prettyPhotoGalleryName', "is_big"=>true)
                        ),
                    'Pretty Photo elements'
                    ),
            new dmFrontFormSection(
                    array(
                        'prettyPhotoTheme',
                        'prettyPhotoAnimationSpeed',
                        'prettyPhotoShowTitle',
                        'prettyPhotoModal',
                        'prettyPhotoDefaultWidth',
                        'prettyPhotoDefaultHeight',
                        'prettyPhotoAllowResize',
                        'prettyPhotoOpacity',
                        'prettyPhotoCounterSeparatorLabel',
                        'prettyPhotoHorizontalPadding'
                        ),
                    'Appearance'
                    ), 
            new dmFrontFormSection(
                    array(
                        'prettyPhotoSlideShow',                        
                        'prettyPhotoSlideShowSpeed'
                        ),
                    'Slide show'
                    ),
            new dmFrontFormSection(
                    array(
                        'prettyPhotoWmode',                        
                        'prettyPhotoHideFlash'
                        ),
                    'Flash'
                    ),            
            new dmFrontFormSection(
                    array(
                        'prettyPhotoAutoPlay',                        
                        'prettyPhotoDeeplinking',
                        'prettyPhotoOverlayGallery',
                        'prettyPhotoKeyboardShortcuts'
                        ),
                    'Utils'
                    ),            
            new dmFrontFormSection(
                    array(
                        'prettyPhotoSocialFacebookLike',                        
                        'prettyPhotoSocialTwitter'
                        ),
                    'Social connect'
                    )
            
            
        ), $this);
        return $formRenderer->render();        
    }
    
    public function getStylesheets() {
        return array_merge(
            parent::getStylesheets(),
            dmFrontFormRenderer::getStylesheets()
        );
    }
    public function getJavaScripts() {
        return array_merge(
            parent::getJavaScripts(),
            dmFrontFormRenderer::getJavascripts()
        );
    }
    
}

?>