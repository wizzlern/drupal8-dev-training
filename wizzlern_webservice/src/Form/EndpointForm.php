<?php

namespace Drupal\wizzlern_webservice\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class EndpointForm.
 *
 * @package Drupal\wizzlern_webservice\Form
 */
class EndpointForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    /** @var \Drupal\wizzlern_webservice\Entity\Endpoint $endpoint */
    $endpoint = $this->entity;
    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $endpoint->label(),
      '#description' => $this->t('Label for the Endpoint.'),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $endpoint->id(),
      '#machine_name' => [
        'exists' => '\Drupal\wizzlern_webservice\Entity\Endpoint::load',
      ],
      '#disabled' => !$endpoint->isNew(),
    ];

    $form['endpoint_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('URL'),
      '#maxlength' => 255,
      '#default_value' => $endpoint->getUrl(),
      '#description' => $this->t('Endpoint URL.'),
      '#required' => TRUE,
    ];

    $form['processors'] = [
      '#type' => 'checkboxes',
      '#title' => $this->t('Processors'),
      '#options' => $endpoint->getAllProcessors(),
      '#default_value' => $endpoint->getConfiguredProcessors(),
      '#description' => $this->t('Data processors that process the endpoint data.'),
      '#required' => TRUE,
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $endpoint = $this->entity;
    $status = $endpoint->save();

    if ($status) {
      drupal_set_message($this->t('Saved the %label webservice.', [
        '%label' => $endpoint->label(),
      ]));
    }
    else {
      drupal_set_message($this->t('The %label webservice was not saved.', [
        '%label' => $endpoint->label(),
      ]));
    }
    $form_state->setRedirectUrl($endpoint->toUrl('collection'));
  }

}
