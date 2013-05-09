<?php

/**
 * @file
 * Administrative page callbacks for the hipic_modal_forms module.
 */

/**
 * General configuration form for controlling the hipic_modal_forms behaviour.
 */
function hipic_modal_forms_admin_settings() {
  $form['hipic_modal_forms_login_settings'] = array(
    '#type' => 'fieldset',
    '#title' => t('Login links settings')
  );
  $form['hipic_modal_forms_login_settings']['hipic_modal_forms_login'] = array(
    '#type' => 'checkbox',
    '#title' => t('Enable for login links'),
    '#default_value' => variable_get('hipic_modal_forms_login', 0),
    '#description' => t('Automatically activate Modal forms for links to user/login.'),
  );
  $form['hipic_modal_forms_login_settings']['hipic_modal_forms_login_links'] = array(
    '#type' => 'radios',
    '#title' => t('Display links'),
    '#options' => array(0 => t('No links'), 1 => t('Show links'), 2 => t('Show links and open them in a modal')),
    '#default_value' => variable_get('hipic_modal_forms_login_links', 0),
    '#description' => t('Display the "Create new account" (if allowed) and "Request new password" links below the login form.'),
    '#states' => array(
      'visible' => array(
        ':input[name="hipic_modal_forms_login"]' => array('checked' => TRUE),
      ),
    ),
  );

  $form['hipic_modal_forms_register_settings'] = array(
    '#type' => 'fieldset',
    '#title' => t('Register links settings')
  );
  $form['hipic_modal_forms_register_settings']['hipic_modal_forms_register'] = array(
    '#type' => 'checkbox',
    '#title' => t('Enable for register new account links'),
    '#default_value' => variable_get('hipic_modal_forms_register', 0),
    '#description' => t('Automatically activate Modal forms for links to user/register.'),
  );

  $form['hipic_modal_forms_password_settings'] = array(
    '#type' => 'fieldset',
    '#title' => t('Password links settings')
  );
  $form['hipic_modal_forms_password_settings']['hipic_modal_forms_password'] = array(
    '#type' => 'checkbox',
    '#title' => t('Enable for request new password links'),
    '#default_value' => variable_get('hipic_modal_forms_password', 0),
    '#description' => t('Automatically activate Modal forms for links to user/password.'),
  );

  $form['hipic_modal_forms_contact_settings'] = array(
    '#type' => 'fieldset',
    '#title' => t('Contact links settings')
  );
  $form['hipic_modal_forms_contact_settings']['hipic_modal_forms_contact'] = array(
    '#type' => 'checkbox',
    '#title' => t('Enable for contact links'),
    '#default_value' => variable_get('hipic_modal_forms_contact', 0),
    '#description' => t('Automatically activate Modal forms for links to contact.'),
  );

  $form['hipic_modal_forms_advanced_settings'] = array(
    '#type' => 'fieldset',
    '#title' => t('Advanced settings'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE
  );
  $form['hipic_modal_forms_advanced_settings']['hipic_modal_forms_pages'] = array(
    '#type' => 'textarea',
    '#title' => t('Deactivate Modal forms on specific pages'),
    '#default_value' => variable_get('hipic_modal_forms_pages', "admin*\nimg_assist*\nimce*\nnode/add/*\nnode/*/edit"),
    '#description' => t("Enter one page per line as Drupal paths. The '*' character is a wildcard. Example paths are %blog for the blog page and %blog-wildcard for every personal blog. %front is the front page.", array('%blog' => 'blog', '%blog-wildcard' => 'blog/*', '%front' => '<front>')),
  );

  return system_settings_form($form);
}
