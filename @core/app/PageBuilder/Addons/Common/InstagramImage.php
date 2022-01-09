<?php


namespace App\PageBuilder\Addons\Common;
use App\Facades\InstagramFeed;
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

class InstagramImage extends PageBuilderBase
{
    use LanguageFallbackForPageBuilder;

    public function preview_image()
    {
       return 'common/instagram-image.png';
    }

    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

        $output .= $this->admin_language_tab(); //have to start language tab from here on
        $output .= $this->admin_language_tab_start();

        $all_languages = LanguageHelper::all_languages();
        foreach ($all_languages as $key => $lang) {
            $output .= $this->admin_language_tab_content_start([
                'class' => $key == 0 ? 'tab-pane fade show active' : 'tab-pane fade',
                'id' => "nav-home-" . $lang->slug
            ]);
            $output .= Text::get([
                'name' => 'title_text_'.$lang->slug,
                'label' => __('Title Text'),
                'value' => $widget_saved_values['title_text_'.$lang->slug] ?? null,
            ]);


            $output .= $this->admin_language_tab_content_end();
        }

        $output .= $this->admin_language_tab_end(); //have to end language tab

        $output .= Text::get([
            'name' => 'title_url',
            'label' => __('Title Url'),
            'value' => $widget_saved_values['title_url'] ?? null,
        ]);


        $output .= IconPicker::get([
            'name' => 'instagram_icon',
            'label' => __('Category Icon'),
            'value' => $widget_saved_values['instagram_icon'] ?? null,
        ]);

        $output .= Text::get([
            'name' => 'item_show',
            'label' => __('Item Show'),
            'value' => $widget_saved_values['item_show'] ?? null,
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
        $current_lang = LanguageHelper::user_lang_slug();
        $title_text = SanitizeInput::esc_html($this->setting_item('title_text_'.$current_lang) ?? '');
        $title_url =  SanitizeInput::esc_html($this->setting_item('title_url') ?? '');
        $item_show = SanitizeInput::esc_html($this->setting_item('item_show') ?? '');
        $instagram_icon = $this->setting_item('instagram_icon') ?? '';
        $padding_top = SanitizeInput::esc_html($this->setting_item('padding_top'));
        $padding_bottom = SanitizeInput::esc_html($this->setting_item('padding_bottom'));


        try{
            $instagram_data = InstagramFeed::fetch($item_show);
        }catch(\Exception $e){
            return $e->getMessage();
        }

        
        $output= '';
        foreach($instagram_data->data as $item){
            $photo_title_url = $item->permalink;
            $image = '<div class="insta_img"><img src="'.$item->media_url.'"/></div>';


 $output.= <<<CONTENT

    <div class="single-gallery-slider" >
      <a href="{$photo_title_url}"> 
        <div class="single-thumb">
        {$image}
            <div class="gallery-contents-link">
                <a href="{$photo_title_url}"><i class="{$instagram_icon}"></i></a>
                <a href="{$title_url}">
                    <span> {$title_text} </span>
                </a>
            </div>
        </div>
       </a>
    </div>
CONTENT;

 }


  return <<<HTML

    <div class="photo-gallery-area res-padding-reverse lr-margin-120" data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}">
        <div class="container-fluid p-0">
            <div class="gallery-slider slick-slider-four">
                {$output}
            </div>
        </div>
    </div>
HTML;

    }

    public function addon_title()
    {
        return __('Instagram Image');
    }
}