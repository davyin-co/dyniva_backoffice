<?php

namespace Drupal\dyniva_backoffice\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\Route;
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
    $entity_links = [
      ## user
      'user.admin_create' => '/manage/user/add',
      'entity.user.canonical' => '/manage/user/{user}',
      'entity.user.edit_form' => '/manage/user/{user}/edit',
      'entity.user.cancel' => '/manage/user/{user}/cancel',

      ## node
      'node.add' => '/manage/content/{node_type}/add',
      'entity.node.canonical' => '/manage/content/{node}',
      'entity.node.edit_form' => '/manage/content/{node}/edit',
      'entity.node.delete_form' => '/manage/content/{node}/delete',
      'entity.node.content_translation_overview' => '/manage/content/{node}/translate',
      'entity.node.content_translation_add' => '/manage/content/{node}/translations/add/{source}/{target}',
      'entity.node.content_translation_edit' => '/manage/content/{node}/translations/edit/{language}',
      'entity.node.content_translation_delete' => '/manage/content/{node}/translations/delete/{language}',

      ## taxonomy
      'entity.taxonomy_vocabulary.overview_form' => '/manage/taxonomy/{taxonomy_vocabulary}',
      'entity.taxonomy_term.add_form' => '/manage/taxonomy/{taxonomy_vocabulary}/add',
      'entity.taxonomy_term.canonical' => '/manage/taxonomy/term/{taxonomy_term}',
      'entity.taxonomy_term.edit_form' => '/manage/taxonomy/term/{taxonomy_term}/edit',
      'entity.taxonomy_term.delete_form' => '/manage/taxonomy/term/{taxonomy_term}/delete',
      'entity.taxonomy_term.content_translation_overview' => '/manage/taxonomy/term/{taxonomy_term}/translations',
      'entity.taxonomy_term.content_translation_add' => '/manage/taxonomy/term/{taxonomy_term}/translations/add/{source}/{target}',
      'entity.taxonomy_term.content_translation_edit' => '/manage/taxonomy/term/{taxonomy_term}/translations/edit/{language}',
      'entity.taxonomy_term.content_translation_delete' => '/manage/taxonomy/term/{taxonomy_term}/translations/delete/{language}',

      ## Menu
      'menu_ui.link_edit' => 'manage/menu/link/{menu_link_plugin}/edit', ## for links provide by code, for example views page.
      'entity.menu.edit_form' => '/manage/menu/{menu}',
      'entity.menu.config_translation_overview' => '/manage/menu/{menu}/translate',
      'entity.menu.add_link_form' => '/manage/menu/{menu}/add',
      'entity.menu_link_content.canonical' => '/manage/menu/{menu_link_content}/edit',
      'entity.menu_link_content.edit_form' => '/manage/menu/{menu_link_content}/edit',
      'entity.menu_link_content.delete_form' => '/manage/menu/{menu_link_content}/delete',
      'entity.menu_link_content.content_translation_overview' => '/manage/menu/{menu_link_content}/edit/translations',
      'entity.menu_link_content.content_translation_edit' => '/manage/menu/{menu_link_content}/edit/translations/edit/{language}',
      'entity.menu_link_content.content_translation_delete' => '/manage/menu/{menu_link_content}/edit/translations/delete/{language}',
      'entity.menu_link_content.content_translation_add' => '/manage/menu/{menu_link_content}/edit/translations/add/{source}/{target}',

      ## Media
      'lightning_media.bulk_upload' => '/manage/media/bulk-upload',
      'entity.media.add_page' => '/manage/media/add',
      'entity.media.add_form' => '/manage/media/add/{media_type}',
      'entity.media.canonical' => '/manage/media/{media}/edit',
      'entity.media.delete_form' => '/manage/media/{media}/delete',
      'entity.media.delete_multiple_form' => '/manage/media/delete',
    ];

    // Looks $this->routeProvider->all() can't get all routing info, such as node translate.
    $all_route = \Drupal::service('router.route_provider')->getAllRoutes();
    foreach ($all_route as $route_name => $route) {
      if (array_key_exists($route_name, $entity_links)) {
        $route_clone = clone $route;
        $route_clone->setPath($entity_links[$route_name]);
        $collection->add('manage.' . $route_name, $route_clone);
      }
    }
  }
}
