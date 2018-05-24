<?php
namespace Drupal\thomas_more_social_media\Form;

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
    $this->state = $config;
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('state'),
      $container->get('')
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
    $form['facebook_url']=[
      '#type' => 'textfield',
      '#title' => 'facebook_url',
      '#size' => 60,
      '#default_value'=> $this->state->get('facebook_url'),
    ];
    $form['google_url']=[
      '#type' => 'textfield',
      '#title' => 'google_url',
      '#size' => 60,
      '#default_value'=> $this->state->get('google_url'),
    ];
    $form['twitter_url']=[
      '#type' => 'textfield',
      '#title' => 'twitter_url',
      '#size' => 60,
      '#default_value'=> $this->state->get('twitter_url'),
    ];
    $form['linkedin_url']=[
      '#type' => 'textfield',
      '#title' => 'linkedin_url',
      '#size' => 60,
      '#default_value'=> $this->state->get('linkedin_url'),
    ];
    $form['foursquare_url']=[
      '#type' => 'textfield',
      '#title' => 'foursquare_url',
      '#size' => 60,
      '#default_value'=> $this->state->get('foursquare_url'),
    ];
    $form['facebook_count']=[
      '#type' => 'textfield',
      '#title' => 'facebook_count',
      '#size' => 60,
      '#default_value'=> $this->state->get('facebook_count'),
    ];
    $form['google_count']=[
      '#type' => 'textfield',
      '#title' => 'google_count',
      '#size' => 60,
      '#default_value'=> $this->state->get('google_count'),
    ];
    $form['twitter_count']=[
      '#type' => 'textfield',
      '#title' => 'twitter_count',
      '#size' => 60,
      '#default_value'=> $this->state->get('twitter_count'),
    ];
    $form['linkedin_count']=[
      '#type' => 'textfield',
      '#title' => 'linkedin_count',
      '#size' => 60,
      '#default_value'=> $this->state->get('linkedin_count'),
    ];
    $form['foursquare_count']=[
      '#type' => 'textfield',
      '#title' => 'foursquare_count',
      '#size' => 60,
      '#default_value'=> $this->state->get('foursquare_count'),
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
    $config->set('threshold_icecream',$form_state->getValue('threshold_icecream'));
    $this->state->set('facebook_url',$form_state->getValue('facebook_url'));
    $this->state->set('google_url',$form_state->getValue('google_url'));
    $this->state->set('twitter_url',$form_state->getValue('twitter_url'));
    $this->state->set('linkedin_url',$form_state->getValue('linkedin_url'));
    $this->state->set('foursquare_url',$form_state->getValue('foursquare_url'));
    $this->state->set('facebook_count',$form_state->getValue('facebook_count'));
    $this->state->set('google_count',$form_state->getValue('google_count'));
    $this->state->set('twitter_count',$form_state->getValue('twitter_count'));
    $this->state->set('linkedin_count',$form_state->getValue('linkedin_count'));
    $this->state->set('foursquare_count',$form_state->getValue('foursquare_count'));
  }

}