<?php

namespace App\Components;

use App\Core\Helpers\URL;

class FormComponent {
    private static $target_url;
    private static $fields;
    private static $back_button;
    private static $submit_button;
    private static $generic_button;
    private static $form_title;
    private static $base_url;

    public static function render($options) {
        // $is_new = isset($options['is_new']) ? $options['is_new'] : true; # deprecated
        $path = isset($options['path']) ? $options['path'] : null;
        $record = isset($options['record']) ? $options['record'] : null;
        $custom_path = isset($options['custom_path']) ? $options['custom_path'] : null;

        self::$base_url = "/" . URL::getAppPath() . "/" . $path;

        if (isset($custom_path)) {
            $url = self::$base_url . '/' . $custom_path;
        } else {
            $url = self::$base_url . '/create';
        }

        $submit_label = 'Create';

        if ($record && !isset($custom_path)) {
            $url = self::$base_url . "/update/".$record->id;
            $submit_label = 'Update';
        }


        $action_buttons = isset($options['action_buttons']) ? $options['action_buttons'] : [];

        $default_actions = [
            'submit' => ['label' => $submit_label, 'hidden' => false],
            'generic' => [
                'label' => 'Generic', 'url' => self::$base_url, 'with_icon' => true, 'hidden' => true,
                'color' => 'warning'
            ],
            'back' => ['label' => 'Back', 'url' => self::$base_url, 'with_icon' => true, 'hidden' => false ],
        ];

        self::$target_url = $url;
        self::$fields = isset($options['fields']) ? $options['fields'] : [];
        self::$form_title = isset($options['title']) ? $options['title'] : null;

        self::$back_button =  isset($action_buttons['back'])
                              ? array_merge($default_actions['back'], $action_buttons['back'])
                              : $default_actions['back'];

        self::$submit_button =  isset($action_buttons['submit'])
                              ? array_merge($default_actions['submit'], $action_buttons['submit'])
                              : $default_actions['submit'];

        self::$generic_button =  isset($action_buttons['generic'])
                              ? array_merge($default_actions['generic'], $action_buttons['generic'])
                              : $default_actions['generic'];
        return self::form();
    }

    public static function form() {
        $html = '
        <form action="'.self::$target_url.'" method="POST" class="mb-3">
            <div class="card">
                    <div class="card-header bg-transparent text-center">
                        <h5 class="mb-0">'. self::$form_title.'</h5>
                    </div>
                <div class="card-body">';
        if (!empty(self::$fields)) {
            $html .= InputsComponent::render(self::$fields);
        }
        $html .= '
                </div>
                <div class="card-footer d-flex justify-content-center" style="gap: 10px;">';

        if (self::$submit_button && !self::$submit_button['hidden']) {
            $html .= '<button type="submit" class="btn btn-primary">'. self::$submit_button['label'].'</button>';
        }

        if (self::$back_button && !self::$back_button['hidden']) {
            $html .= '<a href="'.self::$back_button['url'].'" class="btn btn-danger">';
            $html .= (self::$back_button['with_icon']) ? IconsComponent::render('leftArrow', '23', '23') : self::$back_button['label'];
            $html .= '</a>';
        }

        if (self::$generic_button && !self::$generic_button['hidden']) {
            $color = self::$generic_button['color'];
            $html .= '<a href="'.self::$generic_button['url'].'" class="btn btn-'.$color.'">';
            $html .= (self::$generic_button['with_icon']) ? IconsComponent::render('threeDots', '23', '23') : self::$generic_button['label'];
            $html .= '</a>';
        }

        $html .= '
                </div>
            </div>
        </form>';


        return $html;
    }
}
