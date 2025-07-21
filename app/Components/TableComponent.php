<?php

namespace App\Components;

use App\Core\Helpers\URL;

class TableComponent {
    private static $rows;
    private static $fields;
    private static $row_actions;
    private static $attrs;
    private static $base_url;

    public static function render($rows, $table_name = '', $fields=[], $row_actions = [], $attrs = []) {
        self::$rows = $rows;
        self::$fields = $fields;
        self::$base_url = "/" . URL::getAppPath() . "/" . $table_name;
        self::$attrs = [
            'table_component_id' => isset($attrs['component_id']) ? $attrs['component_id'] : 'table_component',
            'classes'=> isset($attrs['classes']) ? $attrs['classes'] : '',
            'styles' => isset($attrs['styles']) ? self::buildStyes($attrs['styles']) : 'height:400px;',
        ];

        $defaul_actions = [
            'show' => ['label' => 'Show', 'with_icon' => true],
            'edit' => ['label' => 'Edit', 'with_icon' => true],
            'delete' => ['label' => 'Delete', 'with_icon' => true]
        ];
        self::$row_actions = [
            'show' => isset($row_actions['show'])
                        ? array_merge($defaul_actions['show'], $row_actions['show'])
                        : $defaul_actions['show'],
            'edit' => isset($row_actions['edit'])
                        ? array_merge($defaul_actions['edit'], $row_actions['edit'])
                        : $defaul_actions['edit'],
            'delete' => isset($row_actions['delete'])
                        ? array_merge($defaul_actions['delete'], $row_actions['delete'])
                        : $defaul_actions['delete'],
        ];
        return self::table();
    }

    public static function table() {
        $html = '<div class="table-responsive" style="'. self::$attrs['styles'] .'">';
        $html .= '<table class="table table-stripped mt-3" width="100%">';
        $html .= '<thead>';
        $html .= self::build_header();
        $html .= '</thead>';

        $html .= '<tbody>';
        $html .= self::build_rows();
        $html .= '</tbody>';
        $html .= '</table>';
        $html .= '</div>';

        return $html;
    }

    private static function buildStyes($props) {
        $styles = '';
        foreach ($props as $key => $value) {
            $styles .= $key . '=' . $value . ';';
        }
        return $styles;
    }

    private static function build_header() {
        $html = '<tr>';

        foreach (self::$fields as $field) {
            if (isset($field['label'])) {
                $html .= '<th>' . ucwords($field['label']). '</th>';
            } else {
                $html .= '<th>' . ucwords($field['name']). '</th>';
            }
        }
        $html .= '<th class="text-center"> Actions </th>';
        $html .= '</tr>';

        return $html;
    }

    private static function build_row($row) {
        $html = '';

        foreach (self::$fields as $field) {
            $propertyName = $field['name'];
            if (isset($field['callable'])) {
                $result = HelperComponent::method_or_field($row, $field['callable'], $propertyName);
                $html .= '<td>' .$result. '</td>';
            } else {
                $html .= '<td>';
                if (isset($field['linked']) && $field['linked']) {
                    $html .= '<a href="'.self::$base_url ."/". $row->id .'"> '.$row->$propertyName.'</a>';
                } else {
                    $html .= $row->$propertyName;
                }
                $html .='</td>';
            }
        }

        return $html;
    }

    private static function build_rows() {
        $html = '';
        foreach (self::$rows as $row) {
            $html .= '<tr>';
            $html .= self::build_row($row);
            $html .= self::build_row_action($row);
            $html .= '<tr>';
        }

        return $html;
    }

    private static function build_row_action($row) {
        $html = '<td class="d-flex justify-content-center" style="gap: 10px;">';
       
        $showButtonClass = self::$row_actions['show']['with_icon'] ? 'text-primary' : 'btn btn-sm btn-primary';
        $html .= '<a class="'.$showButtonClass.' mx-1" href="' .self::$base_url ."/". $row->id . '">';
        $html .= (self::$row_actions['show']['with_icon']) ? IconsComponent::render('eye', '23', '23') : 'View';
        $html .= "</a>";

        $editButtonClass = self::$row_actions['edit']['with_icon'] ? 'text-success' : 'btn btn-sm btn-success';
        $html .= '<a class="'.$editButtonClass.' mx-1" href="' .self::$base_url . '/edit/' . $row->id . '">';
        $html .= (self::$row_actions['show']['with_icon']) ? IconsComponent::render('edit', '23', '23') : 'Edit';
        $html .= "</a>";

        $deleteButtonClass = self::$row_actions['delete']['with_icon'] ? 'btn btn-link text-danger p-0' : 'btn btn-sm btn-danger';
        $html .= '<form class="p-0 m-0" style="display: inline-flex;" method="POST" action="' . self::$base_url . '/delete/'.$row->id.' ">';
        $html .= '<input type="hidden" name="action" value="delete">';
        $html .= '<input type="hidden" name="post_id" value="' . $row->id . '">';
        $html .= '<button type="submit" class="'.$deleteButtonClass.' mx-1" onclick="return confirm(\'Are you sure you want to delete this post?\')">';
        $html .= (self::$row_actions['delete']['with_icon']) ? IconsComponent::render('trash', '23', '23') : 'Delete';
        $html .= '</button>';

        $html .= "</a>";
        $html .= '</form>';
        $html .= '</td>';

        return $html;
    }
}
