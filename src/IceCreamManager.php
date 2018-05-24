<?php
namespace Drupal\thomas_more_icecream;
use Drupal\Core\Database\Connection;
use Drupal\Core\State\StateInterface;
use Drupal\Core\Mail\MailManager;
class IceCreamManager {

  protected $connection;

  protected $state;

  protected $mailManager;
  public function __construct(Connection $connection, StateInterface $state,MailManager $mailManager) {
    $this->connection = $connection;
    $this->state = $state;
    $this->mailManager = $mailManager;
  }

  public function getFood(string $food) {
    $query = $this->connection->select('thomas_more_icecream_food', 't');
    $query->condition('t.type', $food);
    return $query;
  }

  public function getFoodOrders(string $food) {
    $query = $this->connection->select('thomas_more_icecream_food', 't');
    $query->condition('t.type', $food);
    return (int) $query->countQuery()->execute()->fetchField();
  }

  public function addFood(string $food, string $description) {
    $this->sendMail('ijs');
    $this->connection->insert('thomas_more_icecream_food')
      ->fields([
        'type' => $food,
        'extra' => $description,
      ])->execute();
  }

  public function removeFoods(string $food) {
    $query = $this->connection->delete('thomas_more_icecream_food');
    $query->condition('type', $food);
    return $query->execute();
  }

  public function checkThreshold() {
    if ($this->state->get('threshold_icecream') <= $this->getFoodOrders('ijs')) {
      $this->sendMail('ijs');
      $this->removeFoods('ijs');
      drupal_set_message('icecream threshold bereikt');
    }
    if ($this->state->get('threshold_waffle') <= $this->getFoodOrders('wafel')) {
      $this->sendMail('wafel');
      $this->removeFoods('wafel');
      drupal_set_message('wafel threshold bereikt');
    }
  }

  public function sendMail(string $food) {
    $message = 'Een bestelling voor ' . (string) $food;
    $array = $this->getFood((string) $food);
    foreach ($array as $element) {
      $row = '<br/>-' . (string) $element['type'] . '  extra:' . (string) $element['extra'];
      $array .= $row;
    }
    $this->mailManager->mail('icecream', 'key', 'g6fs2v3c5b74c4@gmail.com',
      'nl', $message, $reply = NULL, $send = TRUE);
  }

  public function icecream_mail($key, &$message, $params) {
    switch ($key) {
      case 'key':
        $message['subject'] = t('test');
        $message['body'][] = (string) $params;
    }
  }
}
