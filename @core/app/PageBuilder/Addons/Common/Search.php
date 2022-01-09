<?php


namespace App\PageBuilder\Addons\Common;
use App\Blog;
use App\BlogCategory;
use App\Helpers\LanguageHelper;
use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\IconPicker;
use App\PageBuilder\Fields\Image;
use App\PageBuilder\Fields\NiceSelect;
use App\PageBuilder\Fields\Notice;
use App\PageBuilder\Fields\Number;
use App\PageBuilder\Fields\Select;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Switcher;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Fields\Textarea;
use App\PageBuilder\PageBuilderBase;
use App\PageBuilder\Traits\LanguageFallbackForPageBuilder;
use App\Tag;
use Illuminate\Support\Str;

class Search extends PageBuilderBase
{
    use LanguageFallbackForPageBuilder;

    public function preview_image()
    {
        return 'common/search.jpg';
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
                'name' => 'tag_title'.$lang->slug,
                'label' => __('Tag Title'),
                'value' => $widget_saved_values['tag_title'.$lang->slug] ?? null,
            ]);


            $output .= $this->admin_language_tab_content_end();
        }

        $output .= $this->admin_language_tab_end(); //have to end language tab


        $output .= Slider::get([
            'name' => 'padding_top',
            'label' => __('Padding Top'),
            'value' => $widget_saved_values['padding_top'] ?? 110,
            'max' => 200,
        ]);
        $output .= Slider::get([
            'name' => 'padding_bottom',
            'label' => __('Padding Bottom'),
            'value' => $widget_saved_values['padding_bottom'] ?? 110,
            'max' => 200,
        ]);

        // add padding option

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
        $tag_title = SanitizeInput::esc_html($this->setting_item('tag_title'.$current_lang));

        $tags = Tag::where(['status'=> 'publish'])->inRandomOrder()->take(5)->get();
        $search_route = route('frontend.blog.search');

        $tag_markup = '';
        foreach ($tags as $tag){
            $tag_markup.= '<li> <a href="'.route('frontend.blog.tags.page', ['any' => $tag->name]).'" class="tag">'.$tag->getTranslation('name',$current_lang).'</a></li>';
        }


 return <<<HTML

    <div class="search-area padding-top-100 padding-bottom-50" data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="search-contents">
                        <form class="search-form" action="{$search_route}">
                            <div class="single-form">
                                <div class="single-form-control">
                                    <input class="form--control" type="text" name="search" placeholder="Search News, Post & People">
                                    <div class="icon"><i class="las la-search"></i></div>
                                </div>
                                <button type="submit"> Search </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="keywords-area padding-top-50 padding-bottom-95">
        <div class="container">
            <div class="keyword-contents">
                <h3 class="keyword-title"> {$tag_title} </h3>
                <ul class="keyword-list">
                       {$tag_markup}
                </ul>
            </div>
        </div>
    </div>


HTML;

    }

    public function addon_title()
    {
        return __('Search');
    }
}