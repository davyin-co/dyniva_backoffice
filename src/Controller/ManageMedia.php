<?php
namespace Drupal\dyniva_backoffice\Controller;

use Drupal\Core\Controller\ControllerBase;

class ManageMedia extends ControllerBase {
  public function Grid() {
    return [
      '#type' => 'view',
      '#name' => 'media_library',
      '#display_id' => 'page',
    ];
  }
}
