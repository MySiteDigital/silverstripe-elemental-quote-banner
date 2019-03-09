<?php

namespace MySiteDigital\Elements;

use MySiteDigital\Elements\ElementalQuoteBannerController;

use DNADesign\Elemental\Models\BaseElement;
use Heyday\ColorPalette\Fields\ColorPaletteField;
use TractorCow\Colorpicker\Color;
use SilverStripe\Core\Config\Configurable;
use SilverStripe\Forms\TextField;

/**
 * Class ElementQuoteBanner.
 */
class ElementQuoteBanner extends BaseElement
{
    /**
     * @var string
     */
    private static $icon = 'font-icon-book-open';

    /**
     * @return string
     */
    private static $singular_name = 'Quote Banner';

    /**
     * @return string
     */
    private static $plural_name = 'Quote Banners';

    /**
     * @var string
     */
    private static $table_name = 'QuoteBanner';

    /**
     * @var class
     */
    private static $controller_class = ElementalQuoteBannerController::class;


    /**
     * @var string
     */
    private static $controller_template = 'ElementQuoteBannerHolder';

    /**
     * @var boolean
     */
    private static $inline_editable = false;

    /**
     * @var array
     */
    private static $db = [
        'QuoteContent' => 'HTMLText',
        'Citation' => 'Varchar',
        'CitationAlignment' => 'Enum("Left,Center,Right")',
        'BgColor' => Color::class,
        'TextColor' => Color::class
    ];

    /**
     * @return \SilverStripe\Forms\FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName('Title');

        $fields->insertBefore(
            TextField::create('Title', 'Title')->setRightTitle('For internal use only, to identify this block with the CMS'),
            'QuoteContent'
        );

        $bgPallette = $this->config()->get('bg_colour_pallette');

        if($bgPallette){
            $fields->replaceField(
            	'BgColor',
            	ColorPaletteField::create(
            		'BgColor',
            		'Background Colour',
                    array_combine(
                        $bgPallette,
                        $bgPallette
                    )
            	)
            );
        }
        else {
            $fields->dataFieldByName('BgColor')->setTitle('Background Colour');
        }


        $textPallette = $this->config()->get('text_colour_pallette');
        if($textPallette){
            $fields->replaceField(
            	'TextColor',
            	ColorPaletteField::create(
            		'TextColor',
            		'Text Colour',
                    array_combine(
                        $textPallette,
                        $textPallette
                    )
                )
            );
        }

        return $fields;
    }


    /**
     * @return string
     */
    public function getType()
    {
        return _t(__CLASS__.'.BlockType', 'Quote Banner');
    }
}
