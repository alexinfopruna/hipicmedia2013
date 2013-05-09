<?php
define('HIPIC_SERMEPA_PERIODO_CONTRATO',' + 1 year');

class Hipicmedia_Order{
  var $order_id;
  var $hipic_order_total;
  var $node;

  function __construct($nuid=NULL,$importe=NULL, $modo_pago=NULL) {
    if ($nuid && !$importe){
      return $this->recupera_orden($nuid);
    }
    else{
      return $this->crea_orden($nuid, $importe, $modo_pago);
    }    
  }

  function recupera_orden($nid){
    return $this->set_order(node_load($nid));
  }

  function crea_orden($uid=NULL, $importe=NULL, $modo_pago=NULL,$titular=NULL,$cuenta=NULL){
    global $user;
    if (!$uid) $uid=$user->uid;
    
    $this->borra_ordenes_pendientes($uid);
    
    
    
    $node = new stdClass(); // We create a new node object
    $node->type = "portal_orden"; // Or any other content type you want
    $node->title = "Orden ".time("Y M D h:i:s")." usuario ".$uid;
    $node->language = LANGUAGE_NONE; // Or any language code if Locale module is enabled. More on this below *

    node_object_prepare($node); // Set some default values.
    $node->field_importe[$node->language][0]['value'] = $importe;
    $node->field_formas_de_pago[$node->language][0]['tid'] = $modo_pago;
    $node->field_titular_de_la_cuenta[$node->language][0]['value'] = $titular;
    $node->field_n_mero_de_cuenta[$node->language][0]['value'] = $cuenta;

    $node->field_fecha_pago[$node->language][0]['value'] = NULL;
    
    $caduca=NULL;
    $actual=$this->orden_pagada_by_uid();
    if ($actual && $actual->field_fecha_caducidad) $caduca=$actual->field_fecha_caducidad[$node->language][0]['value'];
    $node->field_fecha_caducidad[$node->language][0]['value'] = $caduca;
    
    
    $node->field_oid[$node->language][0]['value'] = NULL;
    $node = node_submit($node);

    $node->uid = $uid; // Or any id you wish
    node_save($node);

    return $this->set_order($node); 
  }

  private function set_order($node){
    if (!$node) return NULL;
    $this->node=$node;
    $this->order_id=$node->nid;
    $this->data['payment_method'] = $node->field_formas_de_pago[$node->language][0]['tid'];
    $this->hipic_order_total[LANGUAGE_NONE][0]['amount'] = $node->field_importe[$node->language][0]['value'];
    
    
    return $this;
  }
  
  public function genera_oid(){
    $query = new EntityFieldQuery();
    
    $query->entityCondition('entity_type', 'node')
      ->entityCondition('bundle',  'portal_orden')
      ->fieldCondition('field_oid', 'value', 'NULL', '<>')
      ->addMetaData('account', user_load(1)) // Run the query as user 1.
     ->fieldOrderBy('field_oid','value','DESC')
    ->range(0,1);
    $result = $query->execute();
    
    $nodes = entity_load('node', array_keys($result['node']));
    foreach($nodes as $node) $oid=$node->field_oid[$node->language][0]['value'];
    
    return $oid+1;
  }

  public function orden_pagada($message, $dataCaducitat=NULL,$importe=NULL, $modo_pago=NULL){
    //$node = node_load($nid);
    $node=$this->node;
     
    
    $node->field_oid[$node->language][0]['value'] = $this->genera_oid();
    if ($importe) $node->field_importe[$node->language][0]['value'] = $importe;
    $node->field_fecha_pago[$node->language][0]['value'] = date("Y-m-d H:i:s");
    
    $dataCaducitat = $node->field_fecha_caducidad[$node->language][0]['value'];
    
    if ($dataCaducitat > $data_efecte) {
      $data_efecte=$dataCaducitat;
      $message.=" - RENOVACION";
    }
    
    $node->field_mensaje[$node->language][0]['value'] = $message;
    
    if ($data_efecte){
      $dateOneYearAdded = date("Y-m-d", strtotime(date("Y-m-d", strtotime($data_efecte)) . HIPIC_SERMEPA_PERIODO_CONTRATO));
    }
    else{
      $dateOneYearAdded = $oneYearOn = date('Y-m-d H:i_s',strtotime(date("Y-m-d", mktime()) . HIPIC_SERMEPA_PERIODO_CONTRATO));    
    }
    $node->field_fecha_caducidad[$node->language][0]['value'] = $dateOneYearAdded;
    node_save($node);
    
    return $this->set_order($node); 
  }

  private function borra_ordenes_pendientes($uid){
    $result = db_query("SELECT node.created AS node_created, node.nid AS nid
        FROM
        {node} node
        LEFT JOIN {field_data_field_fecha_pago} field_data_field_fecha_pago ON node.nid = field_data_field_fecha_pago.entity_id AND (field_data_field_fecha_pago.entity_type = 'node' AND field_data_field_fecha_pago.deleted = '0')
        WHERE (( (node.type IN  ('portal_orden')) AND node.uid=$uid AND (field_data_field_fecha_pago.field_fecha_pago_value IS NULL ) ))");

    foreach ($result as $record) {
      node_delete($record->nid);
    }
  }
  
  static function orden_pagada_by_uid($uid=NULL){
    if (!$uid){
      global $user;
      $uid=$user->uid;
    }
    $type='portal_orden';
    $ara=date("Y-m-d h:i:s");
  
    $query = new EntityFieldQuery();
    $results= $query->entityCondition('entity_type', 'node')
    ->entityCondition('bundle', $type)
    ->propertyCondition('uid', $uid)
    ->fieldCondition('field_fecha_caducidad','value', $ara,'>')
    ->fieldOrderBy('field_fecha_caducidad','value','DESC')
    ->range(0,1)
    ->execute();
  
    if (isset($results['node'])) {
      //if (true){
      $nodes = node_load_multiple(array_keys($results['node']));
      foreach($nodes as $node)
      {
        return $node;
      }
    }
    else null;
  }
  
}