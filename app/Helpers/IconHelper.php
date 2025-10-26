<?php

namespace App\Helpers;

class IconHelper
{
  public static function addClasses($iconHtml, $classes)
  {
    if (!$iconHtml) {
      return null; // Return null to trigger fallback
    }

    return preg_replace(
      '/class="([^"]*)"/',
      'class="$1 ' . $classes . '"',
      $iconHtml
    );
  }
}
