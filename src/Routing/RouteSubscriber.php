<?php

namespace Drupal\dyniva_backoffice\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

/**
 * Listens to the dynamic route events.
 */
class RouteSubscriber extends RouteSubscriberBase {

  /**
   * {@inheritdoc}
   */
  protected function alterRoutes(RouteCollection $collection) {
    //    dpm($collection->all());
    //    if ($route = $collection->get('user.page')) {
    //      $route->setDefault('_controller', '\Drupal\mymodule\Controller\UserController::userPage');
    //    }
    foreach ($collection->all() as $route_name => $route) {
      $crud = [
        'entity.taxonomy_vocabulary.overview_form' => '/manage/taxonomy/{taxonomy_vocabulary}/overview',
        'entity.taxonomy_term.add_form' => '/manage/taxonomy/{taxonomy_vocabulary}/add',
        'entity.taxonomy_term.canonical' => '/manage/taxonomy/{taxonomy_term}',
        'entity.taxonomy_term.edit_form' => '/manage/taxonomy/{taxonomy_term}/edit',
        'entity.taxonomy_term.delete_form' => '/manage/taxonomy/{taxonomy_term}/delete',
      ];
      if (array_key_exists($route_name, $crud)) {
        $route_clone = clone $route;
        //route path example: admin/structure/taxonomy/manage/{taxonomy_vocabulary}/add
        $route_clone->setPath($crud[$route_name]);
        $collection->add('manage.' . $route_name, $route_clone);
      }
    }
  }

}
