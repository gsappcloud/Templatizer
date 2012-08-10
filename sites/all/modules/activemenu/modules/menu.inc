<?php

function menu_activemenu() {
  $items = array();
  $menus = menu_get_menus();
  // The Navigation menu is handled by the user module.
  unset($menus['navigation']);
  foreach (array_keys($menus) as $name) {
    $items['#block-menu-'. $name] = 'activemenu/menu';
  }
  return $items;
}