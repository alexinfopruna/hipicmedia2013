<?php
NOOOOOOOOOO VALEEEEEEEEEEE

/**
 * Implements hook_help.
 *
 * Displays help and module information.
 *
 * @param path
 *   Which path of the site we're using to display help
 * @param arg
 *   Array that holds the current path as returned from arg() function
 */
function hipicmedia_help($path, $arg) {
  switch ($path) {
    case "admin/help#hipicmedia":
      $site_email = variable_get('site_mail', '');
      $ret= '<p>'.  t("Modulo general para hipicmedia") .'</p>';
      $ret.='<br/>'.$site_email;

      $ret.='<br/>'.'$GLOBALS[´base_url´] '.$GLOBALS['base_url'];
      $ret.='<br/>'."base_path() ".base_path();
      $ret.='<br/>'."request_uri() ".request_uri();
      $ret.='<br/>'."request_path() ".request_path();
      $ret.='<br/>'."current_path() ".current_path();
      $ret.='<br/>'.'$_SERVER[´REQUEST_URI´] '.$_SERVER['REQUEST_URI'];
      $ret.='<br/>'.'$_GET[´q´] '.$_GET['q'];

      return $ret;
      break;
  }
}

/**
 * Implements hipicmedia_permissiom
 *
 *      'ver apartado usuarios' => array(
 'title' => t('Ver apartado usuarios'),
 'description' => t('Permitir acceso al apartado usuarios'),
 ),

 */
function hipicmedia_permission() {
  return array(
      'administra hipicmedia' => array(
          'title' => t('Administra hipicmedia'),
          'description' => t('Manteniment d\'hipicmedia'),
      ),
      'ver apartado usuarios' => array(
          'title' => t('ver apartado usuarios'),
          'description' => t('ver apartado usuarios'),
      ),
      'ordenar contenido' => array(
          'title' => t('ordenar contenido'),
          'description' => t('ordenar contenido'),
      ),
  );
}


/**
 * Implements hook_admin
 *
 * Prepara configuracio jwplayer_autostart
 */
function hipicmedia_admin() {
  $form = array();

  $form['jwplayer_autostart'] = array(
      '#type' => 'checkbox',
      '#title' => t('Autoplay el video principal'),
      '#default_value' => variable_get('jwplayer_autostart', 0),
      '#description' => t("Marca para hacer autoplay del video principal"),
      '#required' => FALSE,
  );


  #--------------------------------------
  # create a "EMAILS" fieldset
  #--------------------------------------
  $form['emails'] = array(
  '#type' => 'fieldset',
  '#title' => t('Emails'),
  '#collapsible' => TRUE,
  '#collapsed' => TRUE,
  );

  $form['emails']['hipicmedia_mail_nuevo_usuario'] = array(
      '#type' => 'textfield',
      '#title' => t('Email nuevo usuario'),
      '#default_value' => variable_get('hipicmedia_mail_nuevo_usuario', 'alex@infopruna.com'),
      '#description' => t("Quién recibe el mail de nuevo usuario"),
      '#required' => TRUE,
  );

  $form['emails']['hipicmedia_mail_profesionales'] = array(
      '#type' => 'textfield',
      '#title' => t('Email nueva pregunta a profesionales'),
      '#default_value' => variable_get('hipicmedia_mail_profesionales', 'alex@infopruna.com'),
      '#description' => t("Quién recibe el mail de nueva pregunta"),
      '#required' => TRUE,
  );

  $form['emails']['hipicmedia_mail_market'] = array(
      '#type' => 'textfield',
      '#title' => t('Email nuevo artículo market'),
      '#default_value' => variable_get('hipicmedia_mail_market', 'alex@infopruna.com'),
      '#description' => t("Quién recibe el mail de add/edit artículo market"),
      '#required' => TRUE,
  );

  $form['emails']['hipicmedia_mail_portal'] = array(
      '#type' => 'textfield',
      '#title' => t('Emails portal (nuevo cliente, actualización datos, anuncios, promos)'),
      '#default_value' => variable_get('hipicmedia_mail_portal', 'alex@infopruna.com'),
      '#description' => t("Quién recibe los mails del portal"),
      '#required' => TRUE,
  );


  #--------------------------------------
  # create TEXT PORTAL fieldset
  #--------------------------------------
  $form['tranferencia'] = array(
  '#type' => 'fieldset',
  '#title' => t('Textos formulario portal'),
  '#collapsible' => TRUE,
  '#collapsed' => TRUE,
  );
  $form['tranferencia']['transfer_texta'] = array(
      '#type' => 'textarea',
      '#title' => t('Texto para transferencia.'),
      '#default_value' => variable_get('hipicmedia_transfer_texta', 'Texto para transferencia'),
      '#description' => t("Texto para el formulario HipicPortal > opción transferencia"),
      '#required' => TRUE,
  );
  $form['tranferencia']['targeta_texta'] = array(
      '#type' => 'textarea',
      '#title' => t('Texto para tarjeta'),
      '#default_value' => variable_get('hipicmedia_card_texta', 'Texto para transferencia'),
      '#description' => t("Texto para el formulario HipicPortal > opción tarjeta"),
      '#required' => TRUE,
  );
  $form['tranferencia']['debit_texta'] = array(
      '#type' => 'textarea',
      '#title' => t('Texto para ingreso'),
      '#default_value' => variable_get('hipicmedia_debit_texta', 'Texto para transferencia'),
      '#description' => t("Texto para el formulario HipicPortal > opción ingreso"),
      '#required' => TRUE,
  );
  
  
  
  #--------------------------------------
  # create a "TPV" fieldset
  #--------------------------------------
  $form['TPV'] = array(
  '#type' => 'fieldset',
  '#title' => t('Configuración TPV Sermepa'),
  '#collapsible' => TRUE,
  '#collapsed' => TRUE,
  );

  $form['TPV']['hipicmedia_sermepa_name'] = array(
      '#type' => 'textfield',
      '#title' => t('Name'),
      '#default_value' => variable_get('hipicmedia_sermepa_name', ''),
      '#description' => t("Consulta documentación del banco"),
      '#required' => TRUE,
  );

  $form['TPV']['hipicmedia_sermepa_mode'] = array(
      '#type' => 'textfield',
      '#title' => t('Mode'),
      '#default_value' => variable_get('hipicmedia_sermepa_mode', ''),
      '#description' => t("Consulta documentación del banco"),
      '#required' => TRUE,
  );

  $form['TPV']['hipicmedia_sermepa_Ds_Merchant_Titular'] = array(
      '#type' => 'textfield',
      '#title' => t('Ds_Merchant_Titular'),
      '#default_value' => variable_get('hipicmedia_sermepa_Ds_Merchant_Titular', ''),
      '#description' => t("Consulta documentación del banco"),
      '#required' => TRUE,
  );

  $form['TPV']['hipicmedia_sermepa_Ds_MerchantCode'] = array(
      '#type' => 'textfield',
      '#title' => t('Ds_MerchantCode'),
      '#default_value' => variable_get('hipicmedia_sermepa_Ds_MerchantCode', ''),
      '#description' => t("Consulta documentación del banco"),
      '#required' => TRUE,
  );

  $form['TPV']['hipicmedia_sermepa_Ds_MerchantSignature'] = array(
      '#type' => 'textfield',
      '#title' => t('Ds_MerchantSignature'),
      '#default_value' => variable_get('hipicmedia_sermepa_Ds_MerchantSignature', ''),
      '#description' => t("Consulta documentación del banco"),
      '#required' => TRUE,
  );

  $form['TPV']['hipicmedia_sermepa_Ds_Merchant_Terminal'] = array(
      '#type' => 'textfield',
      '#title' => t('Ds_Merchant_Terminal'),
      '#default_value' => variable_get('hipicmedia_sermepa_Ds_Merchant_Terminal', '001'),
      '#description' => t("Consulta documentación del banco"),
      '#required' => TRUE,
  );

  $form['TPV']['hipicmedia_sermepa_currency'] = array(
      '#type' => 'textfield',
      '#title' => t('sermepa_currency'),
      '#default_value' => variable_get('hipicmedia_sermepa_currency', '978'),
      '#description' => t("Consulta documentación del banco"),
      '#required' => TRUE,
  );

  $form['TPV']['hipicmedia_sermepa_emails'] = array(
      '#type' => 'textfield',
      '#title' => t('Quién recibe Emails de Sermepa'),
      '#default_value' => variable_get('hipicmedia_sermepa_emails', 'alexinfopruna@gmail.com'),
      '#description' => t("Indica una dirección de email de confianza"),
      '#required' => TRUE,
  );


  return system_settings_form($form);
}


