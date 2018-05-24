<?php

namespace Drupal\thomas_more_icecream\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Defines an icecream block
 *
 * @Block(
 *   id = "thomas_more_icecream_block",
 *   admin_label = @Translation("Icecream"),
 *  )
 */

class IceCreamBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */

  public function build(){
    return array(
      '#markup' => $this->t('Hello World!'),
    );
  }
}