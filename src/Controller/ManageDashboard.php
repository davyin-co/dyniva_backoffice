<?php
namespace Drupal\dyniva_backoffice\Controller;

use Drupal\Core\Controller\ControllerBase;

class ManageDashboard extends ControllerBase {
  public function Overview() {
    $build = [];
    $entity_type = 'page_variant';

    $storage = \Drupal::entityTypeManager()->getStorage($entity_type);
//    $all = \Drupal::entityTypeManager()->getStorage($entity_type)->loadMultiple();
//    dpm($all);
    $entities = $storage->loadByProperties(['id' => 'total_control_dashboard-http_status_code-0']);

    if ($entity = reset($entities)) {
      $build = \Drupal::entityTypeManager()->getViewBuilder($entity_type)->view($entity);
    }

    return $build;
  }
}
