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

class BlogGridOne extends PageBuilderBase
{
    use LanguageFallbackForPageBuilder;

    public function preview_image()
    {
       return 'blog-page/blog-grid-01.png';
    }

    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

        $categories = BlogCategory::usingLocale(LanguageHelper::default_slug())->where(['status' => 'publish'])->get()->pluck('title', 'id')->toArray();
        $output .= NiceSelect::get([
            'name' => 'categories',
            'multiple'=> true,
            'label' => __('Category'),
            'placeholder' =>  __('Select Category'),
            'options' => $categories,
            'value' => $widget_saved_values['categories'] ?? null,
            'info' => __('you can select category for blog or leave it empty')
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
            'name' => 'columns',
            'label' => __('Left Section Column'),
            'options' => [
                'col-lg-3' => __('04 Column'),
                'col-lg-4' => __('03 Column'),
                'col-lg-6' => __('02 Column'),
                'col-lg-12' => __('01 Column'),
            ],
            'value' => $widget_saved_values['columns'] ?? null,
            'info' => __('set column')
        ]);


        $output .= ColorPicker::get([
            'name' => 'play_icon_color',
            'label' => __('Play Icon Color'),
            'value' => $widget_saved_values['play_icon_color'] ?? null,

        ]);


        $output .= Notice::get([
            'type' => 'secondary',
            'text' => __('Pagination Settings')
        ]);

        $output .= Switcher::get([
            'name' => 'pagination_status',
            'label' => __('Enable/Disable Pagination'),
            'value' => $widget_saved_values['pagination_status'] ?? null,
            'info' => __('your can show/hide pagination'),
        ]);

        $output .= Select::get([
            'name' => 'pagination_alignment',
            'label' => __('Pagination Alignment'),
            'options' => [
                'text-left' => __('Left'),
                'center-text' => __('Center'),
                'end-text' => __('Right'),
            ],
            'value' => $widget_saved_values['pagination_alignment'] ?? null,
            'info' => __('set pagination alignment'),
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
        $settings = $this->get_settings();
        $current_lang = LanguageHelper::user_lang_slug();
        $section_title = SanitizeInput::esc_html($this->setting_item('section_title_' . $current_lang));
        $categories = $this->setting_item('categories') ?? [];
        $order_by = SanitizeInput::esc_html($this->setting_item('order_by'));
        $order = SanitizeInput::esc_html($this->setting_item('order'));
        $items = SanitizeInput::esc_html($this->setting_item('items'));
        $padding_top = SanitizeInput::esc_html($this->setting_item('padding_top'));
        $padding_bottom = SanitizeInput::esc_html($this->setting_item('padding_bottom'));
        $pagination_alignment = $this->setting_item('pagination_alignment');
        $pagination_status = $this->setting_item('pagination_status') ?? '';
        $columns = $this->setting_item('columns') ?? [];
        $play_icon_color = $this->setting_item('play_icon_color') ?? '';

        $blogs = Blog::usingLocale($current_lang)->query();

        if (!empty($category)){
            $blogs->whereJsonContains('category_id', current($category));
        }
        $blogs =$blogs->orderBy($order_by,$order);
        if(!empty($items)){
            $blogs = $blogs->paginate($items);
        }else{
            $blogs = $blogs->get();

        }

        $pagination_markup = '';
        if (!empty($pagination_status) && !empty($items)){
            $pagination_markup = '<div class="col-lg-12 "><div class="pagination-wrapper '.$pagination_alignment.' ">'.$blogs->links().'</div></div>';
        }

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
            $title = Str::words($item->getTranslation('title', $current_lang),13);
            $date = date('M d, Y', strtotime($item->created_at));
            $category_markup = '';
            foreach ($item->category_id as $cat) {
                $category = $cat->getTranslation('title', $current_lang);
                $category_route = route('frontend.blog.category', ['id' => $cat->id, 'any' => Str::slug($cat->title)]);
                $category_markup .= ' <li class="tag-list"><a class="item" href="' . $category_route . '">' . $category . '</a></li>';
            }

            $video_url =  SanitizeInput::esc_html($item->video_url);
            $video_and_image .= '<a href="' . $video_url . '" class="play-icon videos-play-global videos-play-small" style="color: ' . $play_icon_color . '">
                        <i class="las la-play icon"></i>
                    </a>';
            $video_url_condition = $video_url ? $video_and_image : '';

      $news_markup .= <<<HTML
         <div class="{$columns}">
            <div class="single-news margin-top-30">
                <div class="news-thumb video-parent-global">
                {$image_markup}
                 <div class="popup-videos">{$video_url_condition}</div>
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
       <div class="row">
            {$news_markup}
            {$pagination_markup}
       </div>
    </section>
HTML;

}


    public function addon_title()
    {
        return __('Blog Grid : 01');
    }
}