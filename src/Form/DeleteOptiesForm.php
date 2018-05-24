<?php

namespace Drupal\thomas_more_icecream\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\thomas_more_icecream\IceCreamManager;
use Drupal\Core\State\StateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class DeleteOptiesForm extends FormBase{

  protected $state;

  public function __construct(StateInterface $state) {
    $this->state = $state;
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('state')
    );
  }

  public function getFormId() {
    return 'thomas_more_icecream.deleteOptiesForm';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['header'] = [
      '#markup' => '<h2>Toppings & smaken verwijderen</h2>',
    ];

    $toppings = $this->state->get('toppings');
    $smaken = $this->state->get('smaken');

    $form['toppings'] = [
      '#type' => 'checkboxes',
      '#title' => 'Toppings',
      '#options' => $toppings
    ];

    $form['smaken'] = [
      '#type' => 'checkboxes',
      '#title' => 'Smaken',
      '#options' => $smaken
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => 'Geselecteerden verwijderen',
      '#button_type' => 'primary',
    ];
    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state){
    $toppings = $this->state->get('toppings');
    $smaken = $this->state->get('smaken');

    if(!empty($form_state->getValue('toppings'))){
      foreach ($form_state->getValue('toppings') as $topping){
        if (! empty($topping)) {
          unset($toppings[$topping]);
        }
      }
    }

    if(!empty($form_state->getValue('smaken'))){
      foreach ($form_state->getValue('smaken') as $smaak){
        if (! empty($smaak)) {
          unset($smaken[$smaak]);
        }
      }
    }

    $this->state->set('toppings', $toppings);
    $this->state->set('smaken', $smaken);

    drupal_set_message('De geselecteerde smaken/opties zijn verwijderd.');
  }
}