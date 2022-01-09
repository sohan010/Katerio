<?php


namespace App\PageBuilder\Addons\Faq;
use App\Faq;
use App\Helpers\LanguageHelper;
use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\ColorPicker;
use App\PageBuilder\Fields\IconPicker;
use App\PageBuilder\Fields\Image;
use App\PageBuilder\Fields\Notice;
use App\PageBuilder\Fields\Number;
use App\PageBuilder\Fields\Select;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Switcher;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Fields\Textarea;
use App\PageBuilder\PageBuilderBase;
use App\PageBuilder\Traits\LanguageFallbackForPageBuilder;


class FaqStyleOne extends PageBuilderBase
{
    use LanguageFallbackForPageBuilder;

    public function preview_image()
    {
       return 'Faq/01.jpg';
    }

    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();


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
            'info' => __('enter how many item you want to show in frontend'),
        ]);

        $output .= Select::get([
            'name' => 'columns',
            'label' => __('Column'),
            'options' => [
                'col-lg-12' => __('12 Column'),
                'col-lg-3' => __('03 Column'),
                'col-lg-4' => __('04 Column'),
                'col-lg-6' => __('06 Column'),
                'col-lg-8' => __('08 Column'),
                'col-lg-10' => __('10 Column'),
            ],
            'value' => $widget_saved_values['columns'] ?? null,
            'info' => __('set column')
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
                'text-center' => __('Center'),
                'text-right' => __('Right'),
            ],
            'value' => $widget_saved_values['pagination_alignment'] ?? null,
            'info' => __('set pagination alignment'),
        ]);

        $output .= Notice::get([
           'type' => 'secondary',
           'text' => __('Section Settings')
        ]);
        $output .= ColorPicker::get([
            'name' => 'background_color',
            'label' => __('Background Color'),
            'value' => $widget_saved_values['background_color'] ?? '',
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
        $order_by = SanitizeInput::esc_html($this->setting_item('order_by'));
        $order = SanitizeInput::esc_html($this->setting_item('order'));
        $items = SanitizeInput::esc_html($this->setting_item('items'));
        $padding_top = SanitizeInput::esc_html($this->setting_item('padding_top'));
        $padding_bottom = SanitizeInput::esc_html($this->setting_item('padding_bottom'));
        $background_color = SanitizeInput::esc_html($this->setting_item('background_color'));
        $pagination_alignment = $this->setting_item('pagination_alignment');
        $pagination_status = $this->setting_item('pagination_status')?? '';
        $columns = SanitizeInput::esc_html($this->setting_item('columns'));

        $faq_items = Faq::query()->orderBy($order_by,$order);
        if(!empty($items)){
            $faq_items = $faq_items->paginate($items);
        }else{
            $faq_items =  $faq_items->get();
        }

        $pagination_markup = '';
        if (!empty($pagination_status) && !empty($items)){
            $pagination_markup = '<div class="col-lg-12"><div class="pagination-wrapper '.$pagination_alignment.'">'.$faq_items->links().'</div></div>';
        }

        $rand_number = random_int(9999,99999999);
        $faq_markup = '';
        $faq_markup .='<div class="accordion-wrapper"><div id="accordion_'.$rand_number.'">';
        foreach ($faq_items as $index => $faq){

            $title = SanitizeInput::esc_html($faq->title);
            $description = SanitizeInput::kses_basic($faq->description);
            $aria_expanded = 'false';
            $collapse = '';
            if($faq->is_open == 'on'){
                $aria_expanded = 'true';
            }
            if($faq->is_open == 'on') {
                $collapse = 'show';
            }

   $faq_markup .= <<<HTML
 <div class="faq-item wow fadeInLeft" data-wow-delay=".2s">
    <div class="faq-title">
         {$title}
    </div>
    <div class="faq-panel">
        <p class="common-para"> {$description} </p>
    </div>
</div>
HTML;
        }
$faq_markup .= '</div></div>';

        return <<<HTML
   <div class="faq-area padding-top-100 padding-bottom-100" style="background-color: {$background_color}">
       <div class="container">
         <div class="row justify-content-center">
               <div class="{$columns}">
                   <div class="faq-contents">
                            {$faq_markup}
                    </div>
                    {$pagination_markup}
              </div>
        </div>
    </div>
</div>

HTML;

}

    public function addon_title()
    {
        return __('FAQ: 01');
    }
}