<?php

namespace App\WidgetsBuilder\Widgets;
use App\Helpers\SanitizeInput;
use App\Language;
use App\PageBuilder\Fields\IconPicker;
use App\PageBuilder\Fields\Image;
use App\PageBuilder\Fields\Repeater;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Helpers\RepeaterField;
use App\PageBuilder\Traits\LanguageFallbackForPageBuilder;
use App\WidgetsBuilder\WidgetBase;
use Mews\Purifier\Facades\Purifier;

class SocialMediaWidgetFour extends WidgetBase
{

    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

        //render language tab
        $output .= $this->admin_language_tab();
        $output .= $this->admin_language_tab_start();

        $all_languages = Language::all();
        foreach ($all_languages as $key => $lang) {
            $output .= $this->admin_language_tab_content_start([
                'class' => $key == 0 ? 'tab-pane fade show active' : 'tab-pane fade',
                'id' => "nav-home-" . $lang->slug
            ]);
            $widget_title = $widget_saved_values['widget_title_' . $lang->slug] ?? '';
            $output .= '<div class="form-group"><input type="text" name="widget_title_' . $lang->slug . '" class="form-control" placeholder="' . __('Widget Title') . '" value="' . $widget_title . '"></div>';

            $output .= $this->admin_language_tab_content_end();
        }
        $output .= $this->admin_language_tab_end();
        //end multi langual tab option


        $output .= Text::get([
            'name' => 'facebook_url',
            'label' => __('Facebook URL'),
            'value' => $widget_saved_values['facebook_url'] ?? null,
        ]);

        $output .= Text::get([
            'name' => 'facebook_follower',
            'label' => __('Facebook Follower'),
            'value' => $widget_saved_values['facebook_url'] ?? null,
        ]);


        $output .= Text::get([
            'name' => 'instagram_url',
            'label' => __('Instagram URL'),
            'value' => $widget_saved_values['instagram_url'] ?? null,
        ]);

        $output .= Text::get([
            'name' => 'instagram_follower',
            'label' => __('Instagram Follower'),
            'value' => $widget_saved_values['instagram_follower'] ?? null,
        ]);


        $output .= Text::get([
            'name' => 'youtube_url',
            'label' => __('Youtube URL'),
            'value' => $widget_saved_values['youtube_url'] ?? null,
        ]);

        $output .= Text::get([
            'name' => 'youtube_follower',
            'label' => __('Youtube Follower'),
            'value' => $widget_saved_values['youtube_follower'] ?? null,
        ]);


        $output .= Text::get([
            'name' => 'printerest_url',
            'label' => __('Printerest URL'),
            'value' => $widget_saved_values['printerest_url'] ?? null,
        ]);

        $output .= Text::get([
            'name' => 'printerest_follower',
            'label' => __('Printerest Follower'),
            'value' => $widget_saved_values['printerest_follower'] ?? null,
        ]);


        $output .= Text::get([
            'name' => 'twitter_url',
            'label' => __('Twitter URL'),
            'value' => $widget_saved_values['twitter_url'] ?? null,
        ]);

        $output .= Text::get([
            'name' => 'twitter_follower',
            'label' => __('Twitter Follower'),
            'value' => $widget_saved_values['twitter_follower'] ?? null,
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
    $widget_title = $settings['widget_title_' . $user_selected_language] ?? '';

    $facebook_url =  $settings['facebook_url'];
    $instagram_url =  $settings['instagram_url'];
    $youtube_url =  $settings['youtube_url'];
    $printerest_url =  $settings['printerest_url'];
    $twitter_url =  $settings['twitter_url'];

    $facebook_follower =  $settings['facebook_follower'];
    $instagram_follower =  $settings['instagram_follower'];
    $youtube_follower =  $settings['youtube_follower'];
    $printerest_follower =  $settings['printerest_follower'];
    $twitter_follower =  $settings['twitter_follower'];

    $follower_text = __('Follower');
    $follow_text = __('Follow');
    $like_text = __('Follower');
    $subscribe_text = __('Follower');

return <<<HTML
<div class="widget">
  <div class="social-connects padding-top-30">
<div class="single-sidebar-item">
    <div class="section-title-three desktop-center">
        <h4 class="title"> {$widget_title} </h4>
    </div>
        <div class="social-connects-list">
        <div class="single-list">
            <div class="list-left">
                <a class="facebook-bg" href="{$facebook_url}"> <i class="lab la-facebook-f"></i> </a>
                <span class="followers"> <strong>{$facebook_follower}</strong> {$follower_text} </span>
            </div>
            <div class="list-right">
                <span class="likes"> {$like_text} </span>
            </div>
        </div>
        <div class="single-list">
            <div class="list-left">
                <a class="youtube-bg" href="{$youtube_url}"> <i class="lab la-youtube"></i> </a>
                <span class="followers"> <strong>{$youtube_follower}</strong> {$follower_text} </span>
            </div>
            <div class="list-right">
                <span class="likes"> {$like_text} </span>
            </div>
        </div>
        <div class="single-list">
            <div class="list-left">
                <a class="twitter-bg" href="{$twitter_url}"> <i class="lab la-twitter"></i> </a>
                <span class="followers"> <strong>{$twitter_follower}</strong> {$follower_text} </span>
            </div>
            <div class="list-right">
                <span class="likes"> {$follow_text} </span>
            </div>
        </div>
        <div class="single-list">
            <div class="list-left">
                <a class="instagram-bg" href="{$instagram_url}"> <i class="lab la-instagram"></i> </a>
                <span class="followers"> <strong>{$instagram_follower}</strong> {$follower_text} </span>
            </div>
            <div class="list-right">
                <span class="likes"> {$subscribe_text} </span>
            </div>
        </div>
        <div class="single-list">
            <div class="list-left">
                <a class="pintarest-bg" href="{$printerest_url}"> <i class="lab la-pinterest-p"></i> </a>
                <span class="followers"> {$printerest_follower}<strong></strong> {$follower_text} </span>
            </div>
            <div class="list-right">
                <span class="likes"> {$follow_text} </span>
            </div>
        </div>
    </div>

</div>
</div>
</div>

HTML;
}

    public function widget_title()
    {
        return __('Social Media : 04');
    }

}