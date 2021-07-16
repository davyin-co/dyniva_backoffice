<?php

use Drupal\Core\Cache\Cache;

/**
 * @file
 * Dispatcher daemon
 * This file is the heart of the dispatcher drush command.
 * It
 * implements most of the backend functionality.
 */

// This is necessary for signal handling to work
declare(ticks=1);

/**
 * Implements hook_drush_command().
 * See: https://www.drupal.org/project/drupal/issues/3060509
 */
function dyniva_backoffice_drush_command() {
  $items = [];

  $items['media-icons-generate'] = [
    'description' => 'Purge webform submissions from the databases',
    'core' => [
      '8+',
    ],
    'bootstrap' => 2,
  ];

  return $items;
}

/**
 * Drush command to execute hosting tasks.
 */
function drush_dyniva_backoffice_media_icons_generate() {
  \Drupal::moduleHandler()->loadInclude('media', 'install', 'media');
  media_install();
  $destination = \Drupal::config('media.settings')->get('icon_base_uri');
  drush_print($destination);
}
