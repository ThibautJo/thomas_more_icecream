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
use Drupal\thomas_more_icecream\IceCreamManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

class IceCreamForm extends FormBase {

  protected $state;
  protected $creamManager;

  public function __construct(StateInterface $state, IceCreamManager $creamManager) {
    $this->state = $state;
    $this->creamManager = $creamManager;
  }

  public static function create(ContainerInterface $container){
    return new static (
        $container->get('state'),
        $container->get('thomas_more_icecream.icecream_manager')
    );
  }

  public function getFormId() {
    return 'thomas_more_icecream_icecream_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state){
    $opties = array('ijs' => 'Ijsje', 'wafel' => 'Wafel');
    $toppings = array('slagroom' => 'Slagroom', 'chocola' => 'Chocola');
    $smaken = array('vanille' => 'Vanille', 'chocola' => 'Chocola', 'banaan' => 'Banaan');

    $form['keuzes'] = [
      '#type' => 'radios',
      '#title' => 'Maak uw keuze',
      '#options' => $opties
    ];

    $form['toppings'] = [
      '#type' => 'checkboxes',
      '#states' => [
        'visible' => array(
          ':input[name="keuzes"]' => array(
           'value' => 'wafel',
          ),
        ),
      ],
      '#title' => 'Kies een topping voor de wafel',
      '#options' => $toppings
    ];

    $form['smaken'] = [
      '#type' => 'checkboxes',
      '#states' => [
        'visible' => array(
          ':input[name="keuzes"]' => array(
            'value' => 'ijs',
          ),
        ),
      ],
      '#title' => 'Kies smaken voor ijsje',
      '#options' => $smaken
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => 'Geef keuze door',
      '#button_type' => 'primary'
    ];

    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state){
    $description = '';
    $description_wafel = '';
    $description_ijs='';

    if(! empty($form_state->getValue('toppings'))){
      foreach ($form_state->getValue('toppings') as $topping){
        if (! empty($topping)) {
          $description_wafel .= $topping . ', ';
        }
      }
    }

    if(! empty($form_state->getValue('smaken'))){
      foreach ($form_state->getValue('smaken') as $smaak){
        if (! empty($smaak)) {
          $description_ijs .= $smaak . ', ';
        }
      }
    }

    $food = $form_state->getValue('keuzes');

    if ($food = 'Ijs'){
      $description = $description_ijs;
    } else {
      $description = $description_wafel;
    }

    $this->creamManager->addFood($food, $description);
    drupal_set_message('Bestelling: '. $food . ' met extra\'s: ' . $description);
  }
}