<?php

namespace Drupal\social_auth_yahoo\Settings;

use Drupal\social_api\Settings\SettingsBase;

/**
 * Defines methods to get Social Auth yahoo settings.
 */
class YahooAuthSettings extends SettingsBase implements YahooAuthSettingsInterface {

  /**
   * App Key.
   *
   * @var string
   */
  protected $appKey;

  /**
   * App secret.
   *
   * @var string
   */
  protected $appSecret;

  /**
   * {@inheritdoc}
   */
  public function getAppKey() {
    if (!$this->appKey) {
      $this->appKey = $this->config->get('app_key');
    }
    return $this->appKey;
  }

  /**
   * {@inheritdoc}
   */
  public function getAppSecret() {
    if (!$this->appSecret) {
      $this->appSecret = $this->config->get('app_secret');
    }
    return $this->appSecret;
  }

}
