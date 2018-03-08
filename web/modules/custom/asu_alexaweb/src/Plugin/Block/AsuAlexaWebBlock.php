<?php

namespace Drupal\asu_alexaweb\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides an 'ASU AlexaWeb' iframe Block.
 *
 * @Block(
 *   id = "asu_alexaweb_block",
 *   admin_label = @Translation("ASU AlexaWeb"),
 *   category = @Translation("ASU"),
 * )
 */
class AsuAlexaWebBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    return array(
      '#markup' => $this->t('ASU AlexaWeb Block!'),
    );
  }

}
