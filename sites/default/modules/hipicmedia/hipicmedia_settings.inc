<?php
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
  
  /*
  $form['tranferencia']['hipicmedia_transfer_text'] = array(
  '#type' => 'textfield',
      '#title' => t('Texto para transferencia'),
      '#default_value' => variable_get('hipicmedia_transfer_text', '111zz'),
      '#description' => t("Texto para el formulario HipicPortal > opción transferencia"),
      '#required' => TRUE,
  );
  $form['tranferencia']['hipicmedia_card_text'] = array(
      '#type' => 'textfield',
      '#title' => t('Texto para tarjeta'),
      '#default_value' => variable_get('hipicmedia_card_text', '222zz'),
      '#description' => t("Texto para el formulario HipicPortal > opción tarjeta"),
      '#required' => TRUE,
  );
  $form['tranferencia']['hipicmedia_debit_text'] = array(
      '#type' => 'textfield',
      '#title' => t('Texto para ingreso'),
      '#default_value' => variable_get('hipicmedia_debit_text', '333zz'),
      '#description' => t("Texto para el formulario HipicPortal > opción ingreso"),
      '#required' => TRUE,
  );
   * 
   */
  $form['tranferencia']['hp_annual_fee_amount'] = array(
      '#type' => 'textfield',
      '#title' => t('Precio subscripción sin descuento'),
      '#default_value' => variable_get('hp_annual_fee_amount', '280'),
      '#description' => t("Texto en el formulario portal datos de facturación"),
      '#required' => TRUE,
  );
  
  $form['tranferencia']['hp_discounts'] = array(
      '#type' => 'textfield',
      '#title' => t('Descuento subscripción'),
      '#default_value' => variable_get('hp_discounts', '100'),
      '#description' => t("Texto en el formulario portal datos de facturación"),
      '#required' => TRUE,
  );
  
  $form['tranferencia']['hp_advertiser_fee_text'] = array(
      '#type' => 'textarea',
      '#title' => t('Texto precio/descuentos'),
      '#default_value' => variable_get('hp_advertiser_fee_text', '???'),
      '#description' => t("Texto en el formulario portal datos de facturación"),
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


  // RECUPERA SETTINGS
  $settings =  array(
      'Ds_Merchant_Amount' => variable_get('Ds_Merchant_Amount', '180'),
      'name' => variable_get('name', ''),
      'mode' => variable_get('mode', ''),
      'Ds_Merchant_Name' => variable_get('Ds_Merchant_Name', ''),
      'Ds_MerchantCode' => variable_get('Ds_MerchantCode', ''),
      'Ds_MerchantSignature' => variable_get('Ds_MerchantSignature', ''),
      'Ds_Merchant_Terminal' => variable_get('Ds_Merchant_Terminal', '001'),
      'currency' => variable_get('currency', '978'),
      'description' => variable_get('description', ''),
      'advanced' => array(
          'override_url' => variable_get('override_url', ''),
          'encryption' => variable_get('encryption', 'sha1-enhanced'),         
      ),
  );

  $form['TPV']['Ds_Merchant_Amount'] = array(
      '#type' => 'textfield',
      '#title' => t('Importe del cobro'),
      '#description' => t('Importe en Euros a facturar en la pasarela'),
      '#default_value' => $settings['Ds_Merchant_Amount'],
      '#size' => 80,
      '#maxlength' => 255,
      '#required' => TRUE,
  );
  $form['TPV']['name'] = array(
      '#type' => 'textfield',
      '#title' => t('Bank Name'),
      '#description' => t('Administrative name for the bank.'),
      '#default_value' => $settings['name'],
      '#size' => 80,
      '#maxlength' => 255,
      '#required' => TRUE,
  );
  $form['TPV']['mode'] = array(
      '#type' => 'radios',
      '#title' => t('Mode of the transactions'),
      '#default_value' => $settings['mode'],
      '#options' => array('test' => t('Test'), 'live' => t('Live')),
      '#maxlength' => 5,
      '#required' => TRUE,
  );
  $form['TPV']['Ds_Merchant_Name'] = array(
      '#type' => 'textfield',
      '#title' => t('Merchant Name'),
      '#default_value' => $settings['Ds_Merchant_Name'],
      '#size' => 80,
      '#maxlength' => 255,
      '#required' => TRUE,
  );
  $form['TPV']['Ds_MerchantCode'] = array(
      '#type' => 'textfield',
      '#title' => t('Merchant Code'),
      '#default_value' => $settings['Ds_MerchantCode'],
      '#size' => 80,
      '#maxlength' => 255,
      '#required' => TRUE,
  );
  $form['TPV']['Ds_MerchantSignature'] = array(
      '#type' => 'textfield',
      '#title' => t('Merchant Signature'),
      '#default_value' => $settings['Ds_MerchantSignature'],
      '#size' => 80,
      '#maxlength' => 255,
      '#required' => TRUE,
  );
  $form['TPV']['Ds_Merchant_Terminal'] = array(
      '#type' => 'textfield',
      '#title' => t('Merchant Terminal'),
      '#default_value' => $settings['Ds_Merchant_Terminal'],
      '#size' => 5,
      '#maxlength' => 5,
      '#required' => TRUE,
  );
  $form['TPV']['currency'] = array(
      '#type' => 'select',
      '#title' => t('Currency'),
      '#default_value' => $settings['currency'],
      '#options' => array(
          '978' => t('Euro'),
          '840' => t('U.S. Dollar'),
          '826' => t('Pound'),
          '392' => t('Yen'),
          '32' => t('Southern Argentina'),
          '124' => t('Canadian Dollar'),
          '152' => t('Chilean Peso'),
          '170' => t('Colombian Peso'),
          '356' => t('India Rupee'),
          '484' => t('New Mexican Peso'),
          '604' => t('Soles'),
          '756' => t('Swiss Franc'),
          '986' => t('Brazilian Real'),
          '937' => t('Bolivar'),
          '949' => t('Turkish lira')
      ),
      '#required' => TRUE,
  );
  $form['TPV']['description'] = array(
      '#type' => 'textarea',
      '#title' => t('Payment instructions'),
      '#description' => t('Instructions for customers on the checkout page. Use &lt;br /&gt; for line break.'),
      '#default_value' => isset($settings['description']) ? $settings['description'] : '',
      '#required' => FALSE,
      '#rows' => 3,
  );
  $form['TPV']['advanced'] = array(
      '#type' => 'fieldset',
      '#title' => t('Advanced options'),
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
  );
  $form['TPV']['advanced']['override_url'] = array(
      '#type' => 'textfield',
      '#title' => t('Override bank connect url'),
      '#default_value' => $settings['advanced']['override_url'],
      '#size' => 80,
      '#maxlength' => 255,
  );
  $form['TPV']['advanced']['encryption'] = array(
      '#type' => 'radios',
      '#title' => t('Method of encryption'),
      '#default_value' => $settings['advanced']['encryption'],
      '#options' => array(
          'sha1' => t('SHA'),
          'sha1-enhanced' => t('Enhanced SHA'),
      ),
      '#required' => TRUE,
  );

  return system_settings_form($form);
  
}
