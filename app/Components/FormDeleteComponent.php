<?php

namespace App\Components;

use App\Core\Helpers\URL;

class FormDeleteComponent {
  private static $fields;
  private static $target;
  private static $delete_button;


  public static function render($options) {
    $path = isset($options['path']) ? $options['path'] : null;
    // $record_id = isset($options['record_id']) ? $options['record_id'] : null;

    if ($path == null) return '-';


    self::$fields = isset($options['fields']) ? $options['fields'] : [];

    $default_delete_button = [
      'with_icon' => true,
      'label' => 'Delete',
    ];

    self::$delete_button =  isset($options['delete_button'])
                              ? array_merge($default_delete_button, $options['delete_button'])
                              : $default_delete_button;

    self::$target = "/" . URL::getAppPath() . "/" . $path;

    return self::form();
  }

  private static function form() {
    $html = '<form style="display:inline-block;" method="POST" action="'.self::$target.'">';
    if (!empty(self::$fields)) {
      $html .= InputsComponent::render(self::$fields);
    }
    //<input type="hidden" name="post_id" value=" $post->id";
    $deleteButtonClass = self::$delete_button['with_icon'] ? 'btn btn-link text-danger p-0' : 'btn btn-sm btn-danger';
    $html .= '<button type="submit" class="'.$deleteButtonClass.' mx-1" onclick="return confirm(\'Are you sure you want to delete this post?\')">';
    $html .= (self::$delete_button['with_icon']) ? IconsComponent::render('trash', '23', '23') : self::$delete_button['label'];
    $html .= '</button>';
    $html .= '</form>';

    return $html;
  }
}