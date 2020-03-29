<?php

namespace Drupal\social_auth_yahoo\Plugin\Network;

use Drupal\Core\Url;
use Drupal\social_api\SocialApiException;
use Drupal\social_auth\Plugin\Network\NetworkBase;
use Drupal\social_auth_yahoo\Settings\YahooAuthSettings;
use Hayageek\OAuth2\Client\Provider\Yahoo;

/**
 * Defines a Network Plugin for Social Auth yahoo.
 *
 * @package Drupal\social_auth_yahoo\Plugin\Network
 *
 * @Network(
 *   id = "social_auth_yahoo",
 *   social_network = "yahoo",
 *   type = "social_auth",
 *   handlers = {
 *     "settings": {
 *       "class": "\Drupal\social_auth_yahoo\Settings\yahooAuthSettings",
 *       "config_id": "social_auth_yahoo.settings"
 *     }
 *   }
 * )
 */
class YahooAuth extends NetworkBase implements YahooAuthInterface {

  /**
   * Sets the underlying SDK library.
   *
   * @return \Stevenmaguire\OAuth2\Client\Provider\yahoo|false
   *   The initialized 3rd party library instance.
   *
   * @throws \Drupal\social_api\SocialApiException
   *   If the SDK library does not exist.
   */
  protected function initSdk() {

    $class_name = 'Hayageek\OAuth2\Client\Provider\Yahoo';
    if (!class_exists($class_name)) {
      throw new SocialApiException(sprintf('The Yahoo library for PHP League OAuth2 not found. Class: %s.', $class_name));
    }

    /** @var \Drupal\social_auth_yahoo\Settings\yahooAuthSettings $settings */
    $settings = $this->settings;

    if ($this->validateConfig($settings)) {
      // All these settings are mandatory.
      $league_settings = [
        'clientId' => $settings->getAppKey(),
        'clientSecret' => $settings->getAppSecret(),
        'redirectUri' => Url::fromRoute('social_auth_yahoo.callback')->setAbsolute()->toString(),
      ];

      // Proxy configuration data for outward proxy.
      $proxyUrl = $this->siteSettings->get('http_client_config')['proxy']['http'];
      if ($proxyUrl) {
        $league_settings['proxy'] = $proxyUrl;
      }

      return new Yahoo($league_settings);
    }

    return FALSE;
  }

  /**
   * Checks that module is configured.
   *
   * @param \Drupal\social_auth_yahoo\Settings\yahooAuthSettings $settings
   *   The yahoo auth settings.
   *
   * @return bool
   *   True if module is configured.
   *   False otherwise.
   */
  protected function validateConfig(YahooAuthSettings $settings) {
    $app_key = $settings->getAppKey();
    $app_secret = $settings->getAppSecret();
    if (!$app_key || !$app_secret) {
      $this->loggerFactory
        ->get('social_auth_yahoo')
        ->error('Define App Key and App Secret on module settings.');

      return FALSE;
    }

    return TRUE;
  }

}
