<?php

namespace Drupal\thomas_more_icecream;

use Drupal\Core\Database\Connection;
use Drupal\Core\State\StateInterface;
use Drupal\Core\Mail\MailManager;


class IceCreamManager {
  protected $connection;
  protected $state;
  protected $mailManager;

  public function __construct(Connection $connection, StateInterface $state, MailManager $mailManager) {
    $this->connection = $connection;
    $this->state = $state;
    $this->mailManager = $mailManager;
  }

  public function getFood(string $food){
    $query = $this->connection->select('thomas_more_icecream_food', 't');
    $query->condition('t.type', $food);
    return $query->execute()->fetchAll();
  }

  public function getFoodOrders(string $food){
    $query = $this->connection->select('thomas_more_icecream_food', 't');
    $query->condition('t.type', $food);
    return (int) $query->countQuery()->execute()->fetchField();
  }

  public function addFood(string $food, string $description){
    $this->connection->insert('thomas_more_icecream_food')
      ->fields([
        'type' => $food,
        'extra' => $description,
      ])->execute();
  }

  public function removeFoods(string $food){
    $query = $this->connection->delete('thomas_more_icecream_food');
    $query->condition('type', $food);
    return $query->execute();
  }
  public function checkThreshold(){
    if($this->state->get('threshold_icecream')<=$this->getFoodOrders('ijs')){
      $this->removeFoods('ijs');
      return 'icecream threshold berijkt';
    }
    if($this->state->get('threshold_waffle')<=$this->getFoodOrders('wafel')){
      $this->removeFoods('wafel');
      return 'waffle threshold berijkt';
    }
    return 'Geen threshold berijkt';
  }



  public function sendMail(string $food){
      $array = $this->getFood('$food');
  }
}