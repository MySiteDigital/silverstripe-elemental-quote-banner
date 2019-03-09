<?php

namespace MySiteDigital\Elements;

use MySiteDigital\Elements\ElementalQuoteBanner;

use DNADesign\Elemental\Controllers\ElementController;
use SilverStripe\View\Requirements;

/**
 * Class ElementalQuoteBannerController.
 */
class ElementalQuoteBannerController extends ElementController {

    /**
     * Renders the managed {@link BaseElement} wrapped with the current
     * {@link ElementController}.
     *
     * @return string HTML
     */
    public function forTemplate()
    {
        Requirements::css('mysite-digital/silverstripe-elemental-quote-banner:css/element-quote-banner.css');

        $template = $this->element->config()->get('controller_template');

        return $this->renderWith(
            [
                'type' => 'Layout',
                'MySiteDigital\\'.$template
            ]
        );
    }

    /**
     * @return string
     */
    public function ElementColours(){
        $style = "";
        if($this->BgColor || $this->TextColor){
            $style = 'style=';
        }

        if($this->BgColor){
            $style .= 'background-color:#' . str_replace('#', '', $this->BgColor) . ';';
        }

        if($this->TextColor){
            $style .= 'color:#' . str_replace('#', '', $this->TextColor) . ';';
        }
        return $style;
    }
}
