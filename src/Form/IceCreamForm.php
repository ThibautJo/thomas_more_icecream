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


class IceCreamForm extends FormBase {

  public function getFormId() {
    return 'thomas_more_icecream_icecream_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state){
    $form['keuzes'] = [
      '#type' => 'radios',
      '#title' => 'Maak uw keuze',

    ];
  }

  public function submitForm(array &$form, FormStateInterface $form_state){

  }
}