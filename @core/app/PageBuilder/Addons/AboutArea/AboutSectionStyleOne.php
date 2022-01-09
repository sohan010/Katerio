<?php


namespace App\PageBuilder\Addons\AboutArea;


use App\Helpers\LanguageHelper;
use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\IconPicker;
use App\PageBuilder\Fields\Image;
use App\PageBuilder\Fields\Repeater;
use App\PageBuilder\Fields\Select;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Summernote;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Fields\Textarea;
use App\PageBuilder\Helpers\RepeaterField;
use App\PageBuilder\Helpers\Traits\RepeaterHelper;
use App\PageBuilder\PageBuilderBase;

class AboutSectionStyleOne extends PageBuilderBase
{

    public function preview_image()
    {
        return 'about-section/01.jpg';
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
                'name' => 'title_'.$lang->slug,
                'label' => __('Title'),
                'value' => $widget_saved_values['title_' . $lang->slug] ?? null,
            ]);

            $output .= Summernote::get([
                'name' => 'description_'.$lang->slug,
                'label' => __('Description'),
                'value' => $widget_saved_values['description_' . $lang->slug] ?? null,
            ]);
            $output .= Image::get([
                'name' => 'image_'.$lang->slug,
                'label' => __('Image'),
                'value' => $widget_saved_values['image_' . $lang->slug] ?? null,
                'dimensions' => '1109x672px'
            ]);
            $output .= $this->admin_language_tab_content_end();
        }

        $output .= $this->admin_language_tab_end(); //have to end language tab


        $output .= Slider::get([
            'name' => 'padding_top',
            'label' => __('Padding Top'),
            'value' => $widget_saved_values['padding_top'] ?? 120,
            'max' => 500,
        ]);
        $output .= Slider::get([
            'name' => 'padding_bottom',
            'label' => __('Padding Bottom'),
            'value' => $widget_saved_values['padding_bottom'] ?? 120,
            'max' => 500,
        ]);
        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    public function frontend_render(): string
    {
        $settings = $this->get_settings();
        $current_lang = LanguageHelper::user_lang_slug();
        $padding_top = SanitizeInput::esc_html($settings['padding_top']);
        $padding_bottom = SanitizeInput::esc_html($settings['padding_bottom']);
        $title = SanitizeInput::esc_html($settings['title_'.$current_lang]);

        $description = SanitizeInput::kses_basic($settings['description_'.$current_lang]);
        $image = render_image_markup_by_attachment_id($settings['image_'.$current_lang],'','full');


        $right_content_markup = '';
        if (!empty($right_image)){
            $right_content_markup = <<<HTML
 <div class="right-content-area">
        {$right_image}
</div>
HTML;
        }

return <<<HTML
    <section class="about-area" data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}">
        <div class="container">
            <div class="about-wrapper">
                <div class="about-thumb">
                    {$image}
                </div>
                <div class="about-contents">
                    <h2 class="about-title"> {$title} </h2>
                    <p class="common-para">{$description}</p>
      
                </div>
            </div>
        </div>
    </section>
HTML;

    }

    public function addon_title()
    {
        return __('About Area: 01');
    }

}