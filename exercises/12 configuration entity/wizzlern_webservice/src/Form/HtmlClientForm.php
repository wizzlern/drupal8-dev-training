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

    $html_client = $this->entity;
    $form['label'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $html_client->label(),
      '#description' => $this->t("Label for the HtmlClient."),
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

    /* You will need additional form elements for your custom properties. */

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $html_client = $this->entity;
    $status = $html_client->save();

    if ($status) {
      drupal_set_message($this->t('Saved the %label HtmlClient.', array(
        '%label' => $html_client->label(),
      )));
    }
    else {
      drupal_set_message($this->t('The %label HtmlClient was not saved.', array(
        '%label' => $html_client->label(),
      )));
    }
    $form_state->setRedirectUrl($html_client->urlInfo('collection'));
  }

}
