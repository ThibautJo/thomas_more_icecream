<?php

namespace Drupal\thomas_more_icecream\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\State\StateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\thomas_more_social_media\ClickManager;

/**
 * Defines a social menu block
 *
 * @Block(
 *   id = "thomas_more_social_media_block",
 *   admin_label = @Translation("Social media"),
 *  )
 */

class IceCreamBLock extends BlockBase {

  /**
   * {@inheritdoc}
   */

  public function build(){
    return "hoi";
  }
}