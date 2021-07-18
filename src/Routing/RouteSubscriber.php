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
    //dpm($collection->all());
    //if ($route = $collection->get('user.page')) {
    //  $route->setDefault('_controller', '\Drupal\mymodule\Controller\UserController::userPage');
    //}
    // User
    $user_crud = [
      'user.admin_create' => '/manage/user/add',
      'entity.user.canonical' => '/manage/user/{user}',
      'entity.user.edit_form' => '/manage/user/{user}/edit',
      'entity.user.cancel' => '/manage/user/{user}/cancel',
    ];
    foreach ($collection->all() as $route_name => $route) {
      if (array_key_exists($route_name, $user_crud)) {
        $route_clone = clone $route;
        $route_clone->setPath($user_crud[$route_name]);
        $collection->add('manage.' . $route_name, $route_clone);
      }
    }

    // Node
    $node_crud = [
      'node.add' => '/manage/content/{node_type}/add',
      'entity.node.canonical' => '/manage/content/{node}',
      'entity.node.edit_form' => '/manage/content/{node}/edit',
      'entity.node.delete_form' => '/manage/content/{node}/delete',
    ];
    foreach ($collection->all() as $route_name => $route) {
      if (array_key_exists($route_name, $node_crud)) {
        $route_clone = clone $route;
        $route_clone->setPath($node_crud[$route_name]);
        $collection->add('manage.' . $route_name, $route_clone);
      }
    }

    // Taxonomy
    $taxonomy_crud = [
      'entity.taxonomy_vocabulary.overview_form' => '/manage/taxonomy/{taxonomy_vocabulary}',
      'entity.taxonomy_term.add_form' => '/manage/taxonomy/{taxonomy_vocabulary}/add',
      'entity.taxonomy_term.canonical' => '/manage/taxonomy/term/{taxonomy_term}',
      'entity.taxonomy_term.edit_form' => '/manage/taxonomy/term/{taxonomy_term}/edit',
      'entity.taxonomy_term.delete_form' => '/manage/taxonomy/term/{taxonomy_term}/delete',
    ];
    foreach ($collection->all() as $route_name => $route) {
      if (array_key_exists($route_name, $taxonomy_crud)) {
        $route_clone = clone $route;
        //route path example: admin/structure/taxonomy/manage/{taxonomy_vocabulary}/add
        $route_clone->setPath($taxonomy_crud[$route_name]);
        $collection->add('manage.' . $route_name, $route_clone);
      }
    }
  }
}
