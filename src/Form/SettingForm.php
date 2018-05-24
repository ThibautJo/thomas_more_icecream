<?php
namespace Drupal\thomas_more_icecream\Form;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\State\StateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class SettingForm extends FormBase {

  protected $state;
  protected $config;

  public function __construct(StateInterface $state) {
    $this->state = $state;
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('state')
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
      '#type' => 'number',
      '#title' => 'threshold_icecream',
      '#size' => 60,
      '#default_value'=> $this->state->get('threshold_icecream'),
    ];
    $form['threshold_waffle']=[
      '#type' => 'number',
      '#title' => 'threshold_waffle',
      '#size' => 60,
      '#default_value'=> $this->state->get('threshold_waffle'),
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
    $this->state->set('threshold_icecream',$form_state->getValue('threshold_icecream'));
    $this->state->set('threshold_waffle',$form_state->getValue('threshold_waffle'));
  }

}