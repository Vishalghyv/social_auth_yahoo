<?php

namespace Drupal\social_auth_yahoo\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\social_auth\Form\SocialAuthSettingsForm;

/**
 * Settings form for Social Auth yahoo.
 */
class YahooAuthSettingsForm extends SocialAuthSettingsForm {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'social_auth_yahoo_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return array_merge(
      parent::getEditableConfigNames(),
      ['social_auth_yahoo.settings']
    );
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('social_auth_yahoo.settings');

    $form['yahoo_settings'] = [
      '#type' => 'details',
      '#title' => $this->t('Yahoo Client settings'),
      '#open' => TRUE,
      '#description' => $this->t('You need to first create a Yahoo App at <a href="@yahoo-dev">@yahoo-dev</a>', ['@yahoo-dev' => 'https://developers.yahoo.com/apps']),
    ];

    $form['yahoo_settings']['app_key'] = [
      '#type' => 'textfield',
      '#required' => TRUE,
      '#title' => $this->t('App Key'),
      '#default_value' => $config->get('app_key'),
      '#description' => $this->t('Copy the App Key here.'),
    ];

    $form['yahoo_settings']['app_secret'] = [
      '#type' => 'textfield',
      '#required' => TRUE,
      '#title' => $this->t('App Secret'),
      '#default_value' => $config->get('app_secret'),
      '#description' => $this->t('Copy the App Secret here.'),
    ];

    $form['yahoo_settings']['authorized_redirect_url'] = [
      '#type' => 'textfield',
      '#disabled' => TRUE,
      '#title' => $this->t('Authorized redirect URIs'),
      '#description' => $this->t('Copy this value to <em>Authorized redirect URIs</em> field of your Yahoo App settings.'),
      '#default_value' => Url::fromRoute('social_auth_yahoo.callback')->setAbsolute()->toString(),
    ];

    $form['yahoo_settings']['advanced'] = [
      '#type' => 'details',
      '#title' => $this->t('Advanced settings'),
      '#open' => FALSE,
    ];

    $form['yahoo_settings']['advanced']['endpoints'] = [
      '#type' => 'textarea',
      '#title' => $this->t('API calls to be made to collect data'),
      '#default_value' => $config->get('endpoints'),
      '#description' => $this->t('Define the Endpoints to be requested when user authenticates with Yahoo for the first time<br>
                                  Enter each endpoint in different lines in the format <em>endpoint</em>|<em>name_of_endpoint</em>.<br>
                                  <b>For instance:</b><br>
                                  /2/sharing/list_folders|sharing_folders_list'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $values = $form_state->getValues();
    $this->config('social_auth_yahoo.settings')
      ->set('app_key', trim($values['app_key']))
      ->set('app_secret', trim($values['app_secret']))
      ->set('endpoints', $values['endpoints'])
      ->save();

    parent::submitForm($form, $form_state);
  }

}
