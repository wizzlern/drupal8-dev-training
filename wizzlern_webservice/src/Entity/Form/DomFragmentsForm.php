<?php

namespace Drupal\wizzlern_webservice\Entity\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Language\Language;

/**
 * Form controller for the DomFragments entity edit forms.
 *
 * @ingroup wizzlern_webservice
 */
class DomFragmentsForm extends ContentEntityForm {

  /**
   * Overrides Drupal\Core\Entity\EntityFormController::buildForm().
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\wizzlern_webservice\Entity\DomFragments */
    $form = parent::buildForm($form, $form_state);
    $entity = $this->entity;

    $form['langcode'] = [
      '#title' => t('Language'),
      '#type' => 'language_select',
      '#default_value' => $entity->getUntranslated()->language()->getId(),
      '#languages' => Language::STATE_ALL,
    ];

    return $form;
  }

  /**
   * Overrides Drupal\Core\Entity\EntityFormController::save().
   */
  public function save(array $form, FormStateInterface $form_state) {
    $entity = $this->entity;
    $status = $entity->save();

    if ($status) {
      drupal_set_message($this->t('Saved the %label DomFragments.', [
        '%label' => $entity->label(),
      ]));
    }
    else {
      drupal_set_message($this->t('The %label DomFragments was not saved.', [
        '%label' => $entity->label(),
      ]));
    }
    $form_state->setRedirect('entity.dom_fragments.edit_form', ['dom_fragments' => $entity->id()]);
  }

}
