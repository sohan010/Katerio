<?php


namespace App\PageBuilder\Addons\Common;
use App\Helpers\LanguageHelper;
use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\IconPicker;
use App\PageBuilder\Fields\Image;
use App\PageBuilder\Fields\Number;
use App\PageBuilder\Fields\Select;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Fields\Textarea;
use App\PageBuilder\PageBuilderBase;
use App\PageBuilder\Traits\LanguageFallbackForPageBuilder;
use App\ProductCategory;

class BannerOne extends PageBuilderBase
{
    use LanguageFallbackForPageBuilder;

    public function preview_image()
    {
       return 'common/banner.jpg';
    }

    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();


        $output .= Image::get([
            'name' => 'image',
            'label' => __('Banner'),
            'value' => $widget_saved_values['image'] ?? null,
        ]);
        $output .= Text::get([
            'name' => 'image_url',
            'label' => __(' Banner Url'),
            'value' => $widget_saved_values['image_url'] ?? null,
        ]);

        $output .= Slider::get([
            'name' => 'padding_top',
            'label' => __('Padding Top'),
            'value' => $widget_saved_values['padding_top'] ?? 60,
            'max' => 200,
        ]);
        $output .= Slider::get([
            'name' => 'padding_bottom',
            'label' => __('Padding Bottom'),
            'value' => $widget_saved_values['padding_bottom'] ?? 60,
            'max' => 200,
        ]);


        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    public function frontend_render()
    {
        $settings = $this->get_settings();
        $current_lang = LanguageHelper::user_lang_slug();
        $padding_top = SanitizeInput::esc_html($this->setting_item('padding_top'));
        $padding_bottom = SanitizeInput::esc_html($this->setting_item('padding_bottom'));
        $image_id = SanitizeInput::esc_html($this->setting_item('image'));
        $image_url = SanitizeInput::esc_html($this->setting_item('image_url'));
        $image_markup = render_image_markup_by_attachment_id($image_id,null,'full');


   return <<<HTML
<div class="banner-ads-area wow animated zoomIn" data-wow-delay=".3s"data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}">
    <div class="banner-ads-slider">
        <div class="single-banner-ads">
            <a href="{$image_url}" class="banner-link"> {$image_markup} </a>
        </div>
    </div>
</div>

HTML;

    }

    public function addon_title()
    {
        return __('Banner: 01');
    }
}