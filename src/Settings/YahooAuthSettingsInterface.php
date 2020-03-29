<?php

namespace Drupal\social_auth_yahoo\Settings;

/**
 * Defines an interface for Social Auth yahoo settings.
 */
interface YahooAuthSettingsInterface {

  /**
   * Gets the app ley.
   *
   * @return string
   *   The app ley.
   */
  public function getAppKey();

  /**
   * Gets the app secret.
   *
   * @return string
   *   The app secret.
   */
  public function getAppSecret();

}
