<?php


namespace App\PageBuilder\Addons\Blog;
use App\Blog;
use App\BlogCategory;
use App\Helpers\LanguageHelper;
use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\ColorPicker;
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
use Illuminate\Support\Str;

class PopularNewsMasornyOne extends PageBuilderBase
{
    use LanguageFallbackForPageBuilder;

    public function preview_image()
    {
       return 'blog-page/popular_news.jpg';
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
                'name' => 'section_title_'.$lang->slug,
                'label' => __('Section Title'),
                'value' => $widget_saved_values['section_title_' . $lang->slug] ?? null,
            ]);
            $categories = BlogCategory::usingLocale(LanguageHelper::default_slug())->where(['status' => 'publish'])->get()->pluck('title', 'id')->toArray();

            $output .= $this->admin_language_tab_content_end();
        }

        $output .= $this->admin_language_tab_end(); //have to end language tab

        $output .= NiceSelect::get([
            'name' => 'categories',
            'multiple'=> true,
            'label' => __('Category'),
            'placeholder' =>  __('Select Category'),
            'options' => $categories,
            'value' => $widget_saved_values['categories'] ?? null,
            'info' => __('you can select category for blog or leave it empty')
        ]);

        $output .= ColorPicker::get([
            'name' => 'play_icon_color',
            'label' => __('Play Icon Color'),
            'value' => $widget_saved_values['play_icon_color'] ?? null,

        ]);

        $output .= Select::get([
            'name' => 'order_by',
            'label' => __('Order By'),
            'options' => [
                'id' => __('ID'),
                'created_at' => __('Date'),
            ],
            'value' => $widget_saved_values['order_by'] ?? null,
            'info' => __('set order by')
        ]);
        $output .= Select::get([
            'name' => 'order',
            'label' => __('Order'),
            'options' => [
                'asc' => __('Accessing'),
                'desc' => __('Decreasing'),
            ],
            'value' => $widget_saved_values['order'] ?? null,
            'info' => __('set order')
        ]);
        $output .= Number::get([
            'name' => 'items',
            'label' => __('Items'),
            'value' => $widget_saved_values['items'] ?? null,
            'info' => __('enter how many item you want to show in frontend, leave it empty if you want to show all'),
        ]);

        $output .= Select::get([
            'name' => 'section_title_alignment',
            'label' => __('Section Title Alignment'),
            'options' => [
                'left-align' => __('Left Align'),
                'center-align' => __('Center Align'),
                'right-align' => __('Right Align'),
            ],
            'value' => $widget_saved_values['section_title_alignment'] ?? null,
            'info' => __('set alignment of section title')
        ]);


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
        $current_lang = LanguageHelper::user_lang_slug();
        $section_title = SanitizeInput::esc_html($this->setting_item('section_title_' . $current_lang));
        $categories = $this->setting_item('categories') ?? [];
        $order_by = SanitizeInput::esc_html($this->setting_item('order_by'));
        $order = SanitizeInput::esc_html($this->setting_item('order'));
        $items = SanitizeInput::esc_html($this->setting_item('items'));
        $padding_top = SanitizeInput::esc_html($this->setting_item('padding_top'));
        $padding_bottom = SanitizeInput::esc_html($this->setting_item('padding_bottom'));
        $section_title_alignment = SanitizeInput::esc_html($this->setting_item('section_title_alignment'));
        $play_icon_color = $this->setting_item('play_icon_color') ?? '';


        $blogs = Blog::query()->where(['status' => 'publish'])->whereJsonContains('category_id', current($categories));
        $blogs->orderBy($order_by, $order);

        if (!empty($items)) {
            $blogs = $blogs->take($items);
        }
        $blogs = $blogs->get();


        $categoey_headings = BlogCategory::whereIn('id', $categories)->get();
        $category_heading_markup = '';
        foreach ($categoey_headings as $key=> $cate) {
              $category_active_class = $key == 0 ? 'active' : '';
            if (!empty($cate)) {
                $category_heading_markup .= ' <li class="lists list-category '.$category_active_class.'" data-id="' . $cate->id . '">' . $cate->getTranslation('title', $current_lang) . '</li>';
            }
        }

        $news_markup = '';
        foreach ($blogs as $item) {
            $video_and_image = '';
            $image_markup = render_image_markup_by_attachment_id($item->image, '');
            $route = route('frontend.blog.single', $item->slug);
            $title = SanitizeInput::esc_html($item->getTranslation('title', $current_lang) ?? '');
            $date = date('M d, Y', strtotime($item->created_at));
            $category_markup = '';
            foreach ($item->category_id as $cat) {
                $category = $cat->getTranslation('title', $current_lang);
                $category_route = route('frontend.blog.category', ['id' => $cat->id, 'any' => Str::slug($cat->title)]);
                $category_markup .= ' <li class="tag-list"><a class="item" href="' . $category_route . '">' . $category . '</a></li>';
            }

            $video_url = SanitizeInput::esc_html($item->video_url);
            $video_and_image .= '
                   <a href="' . $video_url . '" class="play-icon videos-play-global videos-play-medium" style="color: ' . $play_icon_color . '">
                        <i class="las la-play icon"></i>
                    </a>';
            $video_url_condition = $video_url ? $video_and_image : '';

      $news_markup .= <<<HTML
         <div class="col-lg-6">
            <div class="single-news margin-top-30">
                <div class="news-thumb video-parent-global">
                {$image_markup}
                 <div class="popup-videos"> {$video_url_condition}</div>
                    <ul class="news-date-tag">
                        <li class="tag-list"> $date </li>
                        {$category_markup}
                    </ul>
                </div>
                <div class="news-contents">
                    <a href="{$route}"><h3 class="common-title"> {$title} </h3></a>
                </div>
            </div>
        </div>

HTML;

}

return <<<HTML
    <section class="news-area" data-padding-top="{$padding_top}" data-padding-bottom="{$padding_bottom}">
       <div class="load-ajax-data"></div>
        <div class="row align-items-center">
            <div class="col-lg-4 col-md-12">
                <div class="section-title">
                    <h4 class="title {$section_title_alignment}"> {$section_title} </h4>
                </div>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="news-list">
                    <ul class="news-button-list">
                       {$category_heading_markup}
                    </ul>
                </div>
            </div>
        </div>
            <div class="row home-page-ajax-news-show">
              {$news_markup}
            </div>
    </section>
HTML;

}



    public function addon_title()
    {
        return __('Popular News Masonry: 01');
    }
}