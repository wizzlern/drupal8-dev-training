<?php

/**
 * @file
 * Contains Drupal\wizzlern_webservice\Form\HtmlClientForm.
 */

namespace Drupal\wizzlern_webservice\Form;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class HtmlClientForm.
 *
 * @package Drupal\wizzlern_webservice\Form
 */
class HtmlClientForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    /** @var \Drupal\wizzlern_webservice\Entity\HtmlClient $html_client */
    $html_client = $this->entity;
    $form['label'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $html_client->label(),
      '#description' => $this->t('Label for the webservice.'),
      '#required' => TRUE,
    );

    $form['id'] = array(
      '#type' => 'machine_name',
      '#default_value' => $html_client->id(),
      '#machine_name' => array(
        'exists' => '\Drupal\wizzlern_webservice\Entity\HtmlClient::load',
      ),
      '#disabled' => !$html_client->isNew(),
    );

    $form['endpoint_url'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('URL'),
      '#maxlength' => 255,
      '#default_value' => $html_client->getEndpointUrl(),
      '#description' => $this->t('Endpoint URL.'),
      '#required' => TRUE,
    );

    $form['processors'] = array(
      '#type' => 'checkboxes',
      '#title' => $this->t('Processors'),
      '#options' => $html_client->getAllProcessors(),
      '#default_value' => $html_client->getProcessors(),
      '#description' => $this->t('Data processors that process the endpoint data.'),
      '#required' => TRUE,
    );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $html_client = $this->entity;
    $status = $html_client->save();

    if ($status) {
      drupal_set_message($this->t('Saved the %label webservice.', array(
        '%label' => $html_client->label(),
      )));
    }
    else {
      drupal_set_message($this->t('The %label webservice was not saved.', array(
        '%label' => $html_client->label(),
      )));
    }
    $form_state->setRedirectUrl($html_client->urlInfo('collection'));
  }

}
