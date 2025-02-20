<?php

namespace App\Components;

use App\Core\Helpers\URL;

class CardComponent {
  private static $body_text;
  private static $card_classes;
  private static $card_header_classes;
  private static $card_body_classes;
  private static $card_footer_classes;
  private static $header_title;
  private static $action_buttons;

  public static function render($options) {
    self::$card_classes = isset($options['card_classes']) ? $options['card_classes'] : '';
    self::$card_body_classes = isset($options['card_body_classes']) ? $options['card_body_classes'] : '';
    self::$card_header_classes = isset($options['card_header_classes']) ? $options['card_header_classes'] : 'null';
    self::$card_footer_classes = isset($options['card_footer_classes']) ? $options['card_footer_classes'] : 'null';
    self::$header_title = isset($options['header_title']) ? $options['header_title'] : null;
    self::$body_text = isset($options['body_text']) ? $options['body_text'] : null;

    self::$action_buttons = isset($options['action_buttons']) ? $options['action_buttons'] : null;

    return self::card();
  }

  private static function card() {
    $html = '<div class="card '.self::$card_classes.' ">';
    if (isset(self::$header_title)) {
      $html .= '<div class="card-header '.self::$card_header_classes.'">
                  <h5>'.self::$header_title.'</h5>
                </div>';
    }
    $html .= ' <div class="card-body '.self::$card_body_classes.'">
                <p>'.self::$body_text.'</p>
               </div>';

    if (self::$action_buttons) {
      $html .= '<div class="card-footer '.self::$card_footer_classes.'" style="gap: 10px;">';

      if (isset(self::$action_buttons['edit'])) {
        $edit_path = isset(self::$action_buttons['edit']['path'])
                      ?  "/" . URL::getAppPath() . "/" . self::$action_buttons['edit']['path']
                      : '';
        $with_icon = isset(self::$action_buttons['edit']['with_icon']) ? self::$action_buttons['edit']['with_icon'] : false;
        $type = isset(self::$action_buttons['edit']['type']) ? self::$action_buttons['edit']['type'] : 'text';

        $editButtonClass = $type == 'text' ? 'text-success' : 'btn btn-sm btn-success';
        $html .= '<a class="'.$editButtonClass.' mx-1" href="' .$edit_path . '">';
        $html .= ($with_icon) ? IconsComponent::render('edit', '23', '23') : 'Edit';
        $html .= "</a>";
      }

      if (isset(self::$action_buttons['back'])) {
        $back_path = isset(self::$action_buttons['back']['path'])
                      ?  "/" . URL::getAppPath() . "/" . self::$action_buttons['back']['path']
                      : '';
        $with_icon = isset(self::$action_buttons['back']['with_icon']) ? self::$action_buttons['back']['with_icon'] : false;
        $type = isset(self::$action_buttons['back']['type']) ? self::$action_buttons['back']['type'] : 'text';

        $backButtonClass = $type == 'text' ? 'text-danger' : 'btn btn-sm btn-danger';
        $html .= '<a class="'.$backButtonClass.' mx-1" href="' .$back_path . '">';
        $html .= ($with_icon) ? IconsComponent::render('leftArrow', '23', '23') : 'Back';
        $html .= "</a>";
      }

      if (isset(self::$action_buttons['delete'])) {
        $delete_path = self::$action_buttons['delete']['path'];
        $html .= FormDeleteComponent::render([
          'path' => $delete_path,
        ]);
      }
      $html .= '</div>
            </div>';
    }

    return $html;
  }
}