<?php
/**
 * Created by PhpStorm.
 * User: drupal8
 * Date: 24/05/18
 * Time: 10:04
 */

namespace Drupal\thomas_more_icecream\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\State\StateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class IceCreamForm extends FormBase {

  protected $state;

  public function __construct(StateInterface $state) {
    $this->state = $state;
  }

  public static function create(ContainerInterface $container){
    return new static (
        $container->get('state')
    );
  }

  public function getFormId() {
    return 'thomas_more_icecream_icecream_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state){
    $form['keuzes'] = [
      '#type' => 'radios',
      '#title' => 'Maak uw keuze',
      '#options' => $this->state->get('thomas_more_icecream.opties')
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => 'Geef keuze door',
      '#button_type' => 'primary'
    ];
  }

  public function submitForm(array &$form, FormStateInterface $form_state){

  }
}