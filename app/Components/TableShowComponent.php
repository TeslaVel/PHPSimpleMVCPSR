<?php

namespace App\Components;

use App\Core\Helpers\URL;

class TableShowComponent {
    private static $row;
    private static $fields;
    private static $base_url;
    private static $attrs;
    private static $actions;
    private static $table_classes;
    private static $card_classes;

    public static function render($options) {

        self::$row = isset($options['record']) ? $options['record'] : [];
        self::$fields = isset($options['fields']) ? $options['fields'] : [];
        $path = isset($options['path']) ? $options['path'] : '';
        self::$base_url = "/" . URL::getAppPath() . "/" . $path;

        $table_classes = isset($options['table_classes']) ? $options['table_classes'] : [];
        $card_classes = isset($options['card_classes']) ? $options['card_classes'] : [];

        self::$table_classes = [
            'table_component_id' => isset($table_classes['component_id']) ? $table_classes['component_id'] : 'table_component',
            'classes'=> isset($table_classes['classes']) ? $table_classes['classes'] : '',
            'styles' => '',
        ];
        self::$card_classes = [
            'classes' => isset($card_classes['classes']) ? $card_classes['classes'] : '',
            'card_header' => [
                'classes' => isset($card_classes['card_header']['classes']) ? $card_classes['card_header']['classes'] : ''
            ],
            'card_footer' => [
                'classes' => isset($card_classes['card_footer']['classes']) ? $card_classes['card_footer']['classes'] : ''
            ],
        ];

        $custom_actions = isset($options['actions']) ? $options['actions'] : [];

        $defaul_actions = [
            'edit' => ['label' => 'Edit', 'with_icon' => true],
            'back' => ['label' => 'Back', 'with_icon' => true],
            'delete' => ['label' => 'Delete', 'with_icon' => false]
        ];

        self::$actions = [
            'edit' => isset($custom_actions['edit'])
                        ? array_merge($defaul_actions['edit'], $custom_actions['edit'])
                        : $defaul_actions['edit'],
            'back' => isset($custom_actions['back'])
                        ? array_merge($defaul_actions['back'], $custom_actions['back'])
                        : $defaul_actions['back'],
            'delete' => isset($custom_actions['delete'])
                        ? array_merge($defaul_actions['delete'], $custom_actions['delete'])
                        : $defaul_actions['delete']
        ];

        return self::table();
    }

    public static function table() {
        $html = '<div class="card '.self::$card_classes['classes'].'">';
        $html .=    '<div class="card-header border-0 text-center '.self::$card_classes['card_header']['classes'].'"> View </div>';
        $html .=    '<div class="card-body px-4 py-2">';
        $html .=        '<div class="table-responsive">';
        $html .=            '<table class="table '.self::$table_classes['classes'].'" width="100%">';
        $html .=            '<thead>';
        $html .=            self::build_header_and_row();
        $html .=            '</thead>';
        $html .=            '</table>';
        $html .=        '</div>';
        $html .=    '</div>';
        $html .=    self::buidl_card_footer();
        $html .= '</div>';

        return $html;
    }

    private static function build_header_and_row() {
        $html = '';

        foreach (self::$fields as $field) {
            $html .= '<tr>';
            $html .= self::build_header($field) . self::build_row($field);
            $html .= '</tr>';
        }

        return $html;
    }

    private static function build_header($field) {
        $html = '';
        if (isset($field['label'])) {
            $html .= '<th>' . ucwords($field['label']). '</th>';
        } else {

            $html .= '<th>' . ucwords($field['name']). '</th>';
        }

        return $html;
    }

    private static function build_row($field) {
        $html = '';

        $propertyName = $field['name'];

        if (isset($field['callable'])) {
            $result = HelperComponent::method_or_field(self::$row, $field['callable'], $field['name']);
            $html .= '<td>' .$result. '</td>';
        } else {
            $html .= '<td>' . self::$row->$propertyName . '</td>';
        }

        return $html;
    }

    private static function buidl_card_footer() {
        $html = '<div class="card-footer '.self::$card_classes['card_footer']['classes'] .'" style="gap: 10px;">';
        $showButtonClass = 'btn btn-sm btn-success';
        $html .= '<a class="'.$showButtonClass.' mx-1" href="' .self::$base_url ."/edit/". self::$row->id . '">';
        $html .= (self::$actions['edit']['with_icon']) ? IconsComponent::render('edit', '23', '23') : 'Edit';
        $html .= "</a>";

        $backButtonClass = 'btn btn-sm btn-danger';

        $html .= '<a class="'.$backButtonClass.' mx-1" href="' .self::$base_url .'">';
        $html .= (self::$actions['back']['with_icon']) ? IconsComponent::render('leftArrow', '23', '23') : 'Back';
        $html .= "</a>";

        $html .= "</div>";

        return $html;
    }
}
