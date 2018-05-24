<?php

namespace Drupal\thomas_more_icecream\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\thomas_more_icecream\IceCreamManager;
use Drupal\Core\State\StateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ManageOrdersForm extends FormBase{

  protected $iceCreamManager;
  protected $state;

  public function __construct(IceCreamManager $iceCreamManager, StateInterface $state) {
    $this->iceCreamManager = $iceCreamManager;
    $this->state = $state;
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('thomas_more_icecream.icecream_manager'),
      $container->get('state')
    );
  }

  public function getFormId() {
    return 'thomas_more_icecream_manageOrdersForm';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['foods'] = [
      '#type' => 'checkboxes',
      '#options' => [
        'ijs' => 'Ijsjes',
        'wafel' => 'wafels',
      ],
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => 'Resetten',
      '#button_type' => 'primary',
    ];
    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    foreach($form_state->getValue('foods') as $foods) {

      if(!empty($foods)) {
        $this->iceCreamManager->removeFoods($foods);
      }
    }

    drupal_set_message('Alle orders zijn gereset.');
  }
}