<?php

namespace Drupal\thomas_more_icecream\Controller;

use Drupal\Component\Render\FormattableMarkup;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\State\StateInterface;
use Drupal\thomas_more_icecream\IceCreamManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;


class ChartsController extends ControllerBase{
  protected $state;
  protected $creamManager;

  public function __construct(StateInterface $state, IceCreamManager $creamManager) {
    $this->state = $state;
    $this->creamManager = $creamManager;
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('state'),
      $container->get('thomas_more_icecream.icecream_manager')
    );
  }

  public function buildCharts() {
    $toppings = $this->state->get('toppings');
    $smaken = $this->state->get('smaken');

    /*$chart_data = [
      'ijs' => $this->creamManager->getFoodOrders('ijs'),
      'wafel' => $this->creamManager->getFoodOrders('wafel'),
    ];*/

    foreach($smaken as $smaak){
      $chart_data[$smaak] = $this->creamManager->aantalOrdersOptie($smaak);
    }

    foreach($toppings as $topping){
      $chart_data[$topping] = $this->creamManager->aantalOrdersOptie($topping);
    }

    return [
      '#markup' => new FormattableMarkup('<div id="chart" style="width: 900px; height: 500px;"></div>', []),
      '#attached' => [
        'library' => ['thomas_more_icecream/data_charts'],
        'drupalSettings' => [
          'chart_data' => $chart_data,
        ],
      ],
    ];
  }
}