<?php

namespace Drupal\thomas_more_icecream;

use Drupal\Core\Database\Connection;

class IceCreamManager {
  protected $connection;

  public function __construct(Connection $connection) {
    $this->connection = $connection;
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
}