<?php


namespace App\WidgetsBuilder\Widgets;


use App\Blog;
use App\BlogCategory;
use App\Helpers\LanguageHelper;
use App\Language;
use App\PageBuilder\Fields\Number;
use App\PageBuilder\Fields\Select;
use App\PageBuilder\Fields\Text;
use App\WidgetsBuilder\WidgetBase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Vedmant\FeedReader\Facades\FeedReader;
use Vedmant\FeedReader\FeedReaderServiceProvider;

class RssBlogFeed extends WidgetBase
{

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
                'name' => 'heading_text_'.$lang->slug,
                'label' => __('Heading Text'),
                'value' => $widget_saved_values['heading_text_' . $lang->slug] ?? null,
            ]);
            $output .= $this->admin_language_tab_content_end();
        }
        $output .= $this->admin_language_tab_end(); //have to end language tab

        $output .= Text::get([
            'name' => 'feed_url',
            'label' => __('Feed URL'),
            'value' => $widget_saved_values['feed_url'] ?? null,
        ]);

        $output .= Select::get([
            'name' => 'header_style',
            'label' => __('Header Style'),
            'options' => [
                '1' => __('Style One'),
                '2' => __('Style Two'),
                '4' => __('Style Three'),
            ],
            'value' => $widget_saved_values['header_style'] ?? null,
            'info' => __('You can change header style from here')
        ]);

        $output .= Number::get([
            'name' => 'items',
            'label' => __('Feed Items'),
            'value' => $widget_saved_values['items'] ?? null,
        ]);

        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    public function frontend_render()
    {
        $settings = $this->get_settings();
        $user_selected_language = get_user_lang();

        $widget_title = $settings['heading_text_' . $user_selected_language] ?? '';
        $header_style = $settings['header_style'] ?? '';
        $feed_url = $settings['feed_url'] ?? '';
        $feed_items = $settings['items'] ?? '';

        $response = Http::get($feed_url);
        $body = $response->body() ?? [];
        $xmlObject = simplexml_load_string($body);
        $json = json_encode($xmlObject);
        $phpArray = json_decode($json, true);

        $all_items = $phpArray['channel']['item'];

        $output_arr = [];
        for ($i=0; $i<$feed_items; $i++) {
            $output_arr[] = $all_items[$i];
        }

        $feed_markup = '';
        foreach ($output_arr ?? [] as $item){
            $title = Str::words($item['title'],12) ?? '' ;
            $link = $item['link'] ?? '';
            $published_date = $item['pubDate'] ?? '';
            $desc = $item['description'] ?? '';
            $explode = $desc ? explode('/>',$desc) : '' ;
            $feed_image = $explode ? $explode[0] . '/>'  : '';

//            $js = explode('src',$desc);
//            $ex2 = $js[1];
//            $ex3 = explode('=',$ex2);
//            $data = $ex3[1];
//            $ex4 = explode('/>',$data);
//            $ex5 =  explode('"',$ex4[0]);
//            $test = $ex5[1];
//            $finale_bg_image = 'style="background-image: url(' . $ex5[1]. ');"';

        $feed_markup.= <<<LIST

          <li class="single-blog-post-item">
            <div class="thumb newsfeed-img">
               {$feed_image}
            </div>
            <div class="content">
                <h4 class="title font-size-20">
                    <a href="{$link}">{$title}</a>
                </h4>
                <div class="post-meta">
                    <ul class="post-meta-list">       
                           <li class="post-meta-item date">
                            <i class="lar la-clock icon"></i>
                            <span class="text">{$published_date}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </li>

LIST;

}

 return <<<HTML

    <div class="widget">
        <h4 class="widget-title style-0{$header_style}">{$widget_title}</h4>
        <ul class="recent-blog-post-style-01 index-02 one">
            {$feed_markup}
        </ul>
    </div>


HTML;
    }

    public function widget_title()
    {
        return __('Blog Feeds');
    }
}