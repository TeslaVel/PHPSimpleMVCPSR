<?php

namespace App\Components;

class InputComponent {
    public static $is_row;
    public static $attrs;

    public static function render($attrs) {
        self::$is_row= isset($attrs['is_row']) ? $attrs['is_row'] : false;
        self::$attrs = $attrs;
        return self::field();
    }

    private static function field() {
        $html = '';

        if (self::$attrs['type'] == 'brake_line') {
            $html = '<hr class="' . (self::$attrs['input_class'] ?? '') . '">';
        } elseif (self::$attrs['type'] == 'brake') {
            $html = '<br>';
        } elseif (self::$attrs['type'] == 'hidden') {
            $html = '<input type="hidden" name="' . self::$attrs['name'] . '" autocomplete="off" value="'.self::$attrs['value'].'">';
        } else {
            $html = self::renderField();
        }

        return $html;
    }

    private static function renderField() {
        $html = '';

        if (self::$attrs['type'] == 'image' && isset(self::$attrs['value'])) {
            $html = '<div class="px-0 pb-2 col-sm-12">
                        <div class="bg-transparent">
                            <img src="' . self::$attrs['value'] . '" style="background-size: cover; background-position: center center; height: 250px; width: 100%;">
                        </div>
                    </div>';
        }

        if (self::$is_row) {
            $html = '<div class="row pb-1 pm-1">';

            if (isset(self::$attrs['label'])) {
                $html .= '<label for="' . self::$attrs['name'] . '" class="col-sm-4 col-form-label' . (self::$attrs['label_class'] ?? '') . '">' . self::$attrs['label'] . '</label>';
            }

            $html .= '<div class="col-sm-8">
                        <div class="form-group mb-0 pb-0' . (self::$attrs['parent_class'] ?? '') . '" style="' . (self::$attrs['styles'] ?? '') . '">
                            ' . self::renderFieldInput() . '
                        </div>
                    </div>
                </div>';
        } else {
            $html = '<div class="form-group mb-0 pb-1 pm-1' . (self::$attrs['parent_class'] ?? '') . '" style="' . (self::$attrs['styles'] ?? '') . '">';

            if (isset(self::$attrs['label'])) {
                $html .= '<label for="' . self::$attrs['name'] . '" class="form-label ' . (self::$attrs['label_class'] ?? '') . '">' . self::$attrs['label'] . '</label>';
            }

            $html .= self::renderFieldInput() . '
                </div>';
        }

        return $html;
    }


    private static function renderFieldInput() {
        $props = [
            'autocomplete' => 'off',
            'class' => 'form-control ' . (self::$attrs['input_class'] ?? '')
        ];

        if (isset(self::$attrs['disabled'])) {
            $props['disabled'] = self::$attrs['disabled'];
        }

        if (isset(self::$attrs['required'])) {
            $props['required'] = self::$attrs['required'];
        }

        if (in_array(self::$attrs['type'], ['email', 'text', 'number', 'date']) && isset(self::$attrs['value'])) {
            $props['value'] = self::$attrs['value'];
        }

        if (in_array(self::$attrs['type'], ['password', 'email', 'text', 'number', 'date']) && isset(self::$attrs['placeholder'])) {
            $props['placeholder'] = self::$attrs['placeholder'];
        }

        $html = '';

        switch (self::$attrs['type']) {
            case 'label':
                $html = '<label class="col-form-label w-100 pl-3'. (self::$attrs['label_class'] ?? '') . '">' . self::$attrs['value'] . '</label>';
                break;
            case 'email':
            case 'text':
                $html = '<input type="'. self::$attrs['type'].'" name="' . self::$attrs['name'] . '" ' . self::buildProps($props) . '>';
                break;
            case 'password':
                $html = '<input type="password" name="' . self::$attrs['name'] . '" ' . self::buildProps($props) . '>';
                break;
           case 'textarea':
                $html = '<textarea name="' . self::$attrs['name'] . '" ' . self::buildProps($props) . '> '. (isset(self::$attrs['value']) ? self::$attrs['value'] : '').'</textarea>';
                break;
            case 'number':
                $html = '<input type="number" name="' . self::$attrs['name'] . '" ' . self::buildProps($props) . '>';
                break;
            case 'select':
                $collection = self::$attrs['collection'];
                if (isset(self::$attrs['disabled']) && self::$attrs['disabled']) {
                    $value = $collection[0];
                    $html = '<input type="text" name="' . self::$attrs['name'] . '" value="' . $value . '" ' . self::buildProps(array_diff_key($props, array_flip(['value']))) . '>';
                } else {
                    $options = array_map(function($item) {
                        return '<option value="' . $item . '">' . $item . '</option>';
                    }, $collection);

                    $html = '<select name="' . self::$attrs['name'] . '" ' . self::buildProps($props) . '>' . implode('', $options) . '</select>';
                }
                break;
                // Add more cases for other input types as needed
        }

        return $html;
    }

    private static function buildProps($props) {
        $html = '';
        foreach ($props as $key => $value) {
            $html .= $key . '="' . $value . '" ';
        }
        return $html;
    }
}