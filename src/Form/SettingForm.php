<?php
namespace Drupal\thomas_more_icecream\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Config;
use Drupal\Core\State\StateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class SettingForm extends FormBase {

  protected $state;
  protected $config;

  public function __construct(StateInterface $state,Config\Config $config) {
    $this->state = $state;
    $this->config = $config;
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('state'),
      $container->get('config')
    );
  }
  /**
   * {@inheritdoc}
   */
  public function getFormId(){
    return 'thomas_more_icecream_setting_form';
  }
  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state){
    $form['threshold_icecream']=[
      '#type' => 'textfield',

      '#title' => 'threshold_icecream',
      '#size' => 60,
      '#default_value'=> $this->config('thomas_more_icecream')->get('threshold_icecream'),
    ];
    $form['threshold_waffle']=[
      '#type' => 'textfield',
      '#title' => 'threshold_waffle',
      '#size' => 60,
      '#default_value'=> $this->config('thomas_more_icecream')->get('threshold_waffle'),
    ];


    $form['submit']=[
      '#type' => 'submit',
      '#value' => 'submit',
      '#button_type'=>'primary',
    ];
    return $form;
  }
  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state){
    $this->config('thomas_more_icecream')->set('threshold_icecream',$form_state->getValue('threshold_icecream'))->save();
    $this->config('thomas_more_icecream')->set('threshold_waffle',$form_state->getValue('threshold_waffle'))->save();
  }

}