<?php

namespace Drupal\dyniva_backoffice\Controller;

use Drupal\Core\Controller\ControllerBase;

class ManagePageMisc extends ControllerBase {

  /**
   * /manage/dashboard
   */
  public function DashboardOverview() {
    $build = [];
    $entity_type = 'page_variant';
    //$storage = \Drupal::entityTypeManager()->getStorage($entity_type);
    //$all = \Drupal::entityTypeManager()->getStorage($entity_type)->loadMultiple();
    //dpm($all);
    $entities = $this->entityTypeManager->getStorage($entity_type)
      ->loadByProperties(['id' => 'total_control_dashboard-http_status_code-0']);

    if ($entity = reset($entities)) {
      $build = \Drupal::entityTypeManager()
        ->getViewBuilder($entity_type)
        ->view($entity);
    }

    return $build;
  }

  /**
   * /manage/taxonomy
   */
  public function TaxonomyVocabularyOverview() {
    //$storage = \Drupal::entityTypeManager()->getListBuilder('taxonomy_vocabulary);
    return $this->entityTypeManager()
      ->getListBuilder('taxonomy_vocabulary')
      ->render();
  }

  /**
   * /manage/media-grid
   */
  public function MediaGrid() {
    return [
      '#type' => 'view',
      '#name' => 'media_library',
      '#display_id' => 'page',
    ];
  }
}
