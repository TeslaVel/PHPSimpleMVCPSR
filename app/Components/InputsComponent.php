<?php

namespace App\Components;

class InputsComponent {
    public static function render($fields) {
        $html = '';
        if (!empty($fields)) {
            foreach ($fields as $field) {
                $html .= InputComponent::render($field);
            }
        }
        return $html;
    }
}
