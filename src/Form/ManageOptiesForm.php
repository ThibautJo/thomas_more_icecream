<?php

namespace Drupal\thomas_more_icecream\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\thomas_more_icecream\IceCreamManager;
use Drupal\Core\State\StateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ManageOptiesForm extends FormBase{

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
    return 'thomas_more_icecream_manageOptiesForm';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['input'] = [
      '#type' => 'textfield',
      '#title' => 'Input',
      '#default_value' => 'Vul topping of smaak in',
    ];

    $form['submit1'] = [
      '#type' => 'submit',
      '#value' => 'Als topping Toevoegen',
      '#button_type' => 'primary',
      '#submit' => array('::toppings_submit'),
    ];

    $form['submit2'] = [
      '#type' => 'submit',
      '#value' => 'Als smaak Toevoegen',
      '#button_type' => 'primary',
      '#submit' => array('::smaak_submit'),
    ];
    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state){

  }

  public function topping_submit(array &$form, FormStateInterface $form_state) {
    if(!empty($form_state->getValue('input'))){
      $opties = $this->state->get('toppings', []);
      $opties[$form_state->getValue('input')] = $form_state->getValue('input');
      $this->state->set('toppings', $opties);

      drupal_set_message('De topping is toegevoeggd.');
    }else{
      drupal_set_message('Vul een waarde in!.');
    }
  }

  public function smaak_submit(array &$form, FormStateInterface $form_state) {
    if(!empty($form_state->getValue('input'))){
      $opties = $this->state->get('smaken', []);
      $opties[$form_state->getValue('input')] = $form_state->getValue('input');
      $this->state->set('smaken', $opties);

      drupal_set_message('De smaak is toegevoeggd.');
    }else{
      drupal_set_message('Vul een waarde in!.');
    }
  }
}