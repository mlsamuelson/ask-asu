<?php

namespace Drupal\asu_alexaweb\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Url;
use Drupal\Component\Utility;
// For form.
use Drupal\Core\Block\BlockPluginInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides an 'ASU AlexaWeb' iframe Block.
 *
 * @Block(
 *   id = "asu_alexaweb_block",
 *   admin_label = @Translation("ASU AlexaWeb"),
 *   category = @Translation("ASU"),
 * )
 */
class AsuAlexaWebBlock extends BlockBase implements BlockPluginInterface {

  /**
   * {@inheritdoc}
   */
  public function build() {

    $config = $this->getConfiguration();

    if (!empty($config['asu_alexaweb_app_uri'])) {
      $app_uri = UrlHelper::stripDangerousProtocols($config['asu_alexaweb_app_uri']);
    }
    else {
      drupal_set_message(t('Missing AlexaWeb App URL. Please complete configuration for ASU AlexaWeb block.'), 'error');
      $app_uri = '';
    }

    return [
      '#asu_alexaweb_uri' => $app_uri,
      '#theme' => 'asu_alexaweb_block',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form = parent::blockForm($form, $form_state);

    $config = $this->getConfiguration();

    $alexaweb_project_url = 'https://github.com/sammachin/alexaweb';
    $alexaweb_fork_url = 'https://github.com/mlsamuelson/alexaweb';

    $form['asu_alexaweb_app_uri'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('AlexaWeb App URL'),
      '#description' => $this->t('Provide the full URL to the deployment of the AlexaWeb app (without trailing slash). App should be deployed according to @alexaweb or the customized fork created for use with the ASU AlexaWeb module at @alexafork.', 
        ['@alexaweb' => UrlHelper::stripDangerousProtocols(Url::fromUri($alexaweb_project_url)), '@alexafork' => UrlHelper::stripDangerousProtocols(Url::fromUri($alexaweb_fork_url))]),
      '#default_value' => isset($config['asu_alexaweb_app_uri']) ? $config['asu_alexaweb_app_uri'] : '',
    );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    parent::blockSubmit($form, $form_state);

    $values = $form_state->getValues();
    $this->configuration['asu_alexaweb_app_uri'] = $values['asu_alexaweb_app_uri'];
  }

}
