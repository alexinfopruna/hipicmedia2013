<?php
/**
 * @file
 * Contains the theme's functions to manipulate Drupal's default markup.
 *
 * A QUICK OVERVIEW OF DRUPAL THEMING
 *
 *   The default HTML for all of Drupal's markup is specified by its modules.
 *   For example, the comment.module provides the default HTML markup and CSS
 *   styling that is wrapped around each comment. Fortunately, each piece of
 *   markup can optionally be overridden by the theme.
 *
 *   Drupal deals with each chunk of content using a "theme hook". The raw
 *   content is placed in PHP variables and passed through the theme hook, which
 *   can either be a template file (which you should already be familiary with)
 *   or a theme function. For example, the "comment" theme hook is implemented
 *   with a comment.tpl.php template file, but the "breadcrumb" theme hooks is
 *   implemented with a theme_breadcrumb() theme function. Regardless if the
 *   theme hook uses a template file or theme function, the template or function
 *   does the same kind of work; it takes the PHP variables passed to it and
 *   wraps the raw content with the desired HTML markup.
 *
 *   Most theme hooks are implemented with template files. Theme hooks that use
 *   theme functions do so for performance reasons - theme_field() is faster
 *   than a field.tpl.php - or for legacy reasons - theme_breadcrumb() has "been
 *   that way forever."
 *
 *   The variables used by theme functions or template files come from a handful
 *   of sources:
 *   - the contents of other theme hooks that have already been rendered into
 *     HTML. For example, the HTML from theme_breadcrumb() is put into the
 *     $breadcrumb variable of the page.tpl.php template file.
 *   - raw data provided directly by a module (often pulled from a database)
 *   - a "render element" provided directly by a module. A render element is a
 *     nested PHP array which contains both content and meta data with hints on
 *     how the content should be rendered. If a variable in a template file is a
 *     render element, it needs to be rendered with the render() function and
 *     then printed using:
 *       <?php print render($variable); ?>
 *
 * ABOUT THE TEMPLATE.PHP FILE
 *
 *   The template.php file is one of the most useful files when creating or
 *   modifying Drupal themes. With this file you can do three things:
 *   - Modify any theme hooks variables or add your own variables, using
 *     preprocess or process functions.
 *   - Override any theme function. That is, replace a module's default theme
 *     function with one you write.
 *   - Call hook_*_alter() functions which allow you to alter various parts of
 *     Drupal's internals, including the render elements in forms. The most
 *     useful of which include hook_form_alter(), hook_form_FORM_ID_alter(),
 *     and hook_page_alter(). See api.drupal.org for more information about
 *     _alter functions.
 *
 * OVERRIDING THEME FUNCTIONS
 *
 *   If a theme hook uses a theme function, Drupal will use the default theme
 *   function unless your theme overrides it. To override a theme function, you
 *   have to first find the theme function that generates the output. (The
 *   api.drupal.org website is a good place to find which file contains which
 *   function.) Then you can copy the original function in its entirety and
 *   paste it in this template.php file, changing the prefix from theme_ to
 *   hipic_. For example:
 *
 *     original, found in modules/field/field.module: theme_field()
 *     theme override, found in template.php: hipic_field()
 *
 *   where hipic is the name of your sub-theme. For example, the
 *   zen_classic theme would define a zen_classic_field() function.
 *
 *   Note that base themes can also override theme functions. And those
 *   overrides will be used by sub-themes unless the sub-theme chooses to
 *   override again.
 *
 *   Zen core only overrides one theme function. If you wish to override it, you
 *   should first look at how Zen core implements this function:
 *     theme_breadcrumbs()      in zen/template.php
 *
 *   For more information, please visit the Theme Developer's Guide on
 *   Drupal.org: http://drupal.org/node/173880
 *
 * CREATE OR MODIFY VARIABLES FOR YOUR THEME
 *
 *   Each tpl.php template file has several variables which hold various pieces
 *   of content. You can modify those variables (or add new ones) before they
 *   are used in the template files by using preprocess functions.
 *
 *   This makes THEME_preprocess_HOOK() functions the most powerful functions
 *   available to themers.
 *
 *   It works by having one preprocess function for each template file or its
 *   derivatives (called theme hook suggestions). For example:
 *     THEME_preprocess_page    alters the variables for page.tpl.php
 *     THEME_preprocess_node    alters the variables for node.tpl.php or
 *                              for node--forum.tpl.php
 *     THEME_preprocess_comment alters the variables for comment.tpl.php
 *     THEME_preprocess_block   alters the variables for block.tpl.php
 *
 *   For more information on preprocess functions and theme hook suggestions,
 *   please visit the Theme Developer's Guide on Drupal.org:
 *   http://drupal.org/node/223440 and http://drupal.org/node/1089656
 */


/**
 * Override or insert variables into the maintenance page template.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("maintenance_page" in this case.)
 */
/* -- Delete this line if you want to use this function
 function hipic_preprocess_maintenance_page(&$variables, $hook) {
 // When a variable is manipulated or added in preprocess_html or
 // preprocess_page, that same work is probably needed for the maintenance page
 // as well, so we can just re-use those functions to do that work here.
 hipic_preprocess_html($variables, $hook);
 hipic_preprocess_page($variables, $hook);
 }
 // */

/**
 * Override or insert variables into the html templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("html" in this case.)
 */

  function hipic_preprocess_html(&$variables, $hook) {
  }

 // */



/**
 * Override or insert variables into the page templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("page" in this case.)
 */
///* -- Delete this line if you want to use this function
function hipic_preprocess_page(&$variables, $hook) {
  if (!empty($variables['tabs'])) { $variables['classes_array'][] = 'user-tabs'; }

  drupal_add_library('system', 'ui.dialog',TRUE); //ALEX
  drupal_add_library('system', 'ui.tabs',TRUE); //ALEX

  
  $variables['debug']="";//PER TREURE UN TEXT
  
  // ESCONDO LA COLUMNA 2 SI ES FORMULARIO
  if (hipicmedia_arg(1)=='add' || hipicmedia_arg(2)=='edit') unset($variables['page']['sidebar_second']);
  
  $ruta_tema=drupal_get_path('theme', 'hipic');
  $variables['ruta_tema']=$ruta_tema;

  $frm=drupal_get_form('search_form');
  $search_box = drupal_render($frm);
  $variables['search_box'] = $search_box; 

  $easy_breadcrumb = module_invoke('easy_breadcrumb','block_view','easy_breadcrumb');
  //$variables['easy_breadcrumb'] = $easy_breadcrumb;
  $variables['breadcrumb'] = render($easy_breadcrumb);
  
  
  
  // ALEX - CARREGA CSS PEL PORTAL
  /*
   */
      $path_alias=request_path();
      if (strpos($path_alias, 'hipicportal')!==FALSE || strpos($path_alias,'profile-anunciante')!==FALSE)
      {
        drupal_add_css($ruta_tema . "/css/hipicportal.css",array('group' => CSS_THEME, 'weight' => 200));
      }
      
      
   /*   
  // ALEX CSS per NO admin
  global $user;  
  // Check to see if $user has the administrator role.
  if (in_array('administrator', array_values($user->roles))) {
    drupal_add_css($ruta_tema . "/css/messages_on.css",array('group' => CSS_THEME, 'weight' => 200));
  }
  */
  
      
}


/**
 * 
 * implements hook_preprocess_block
 * 
 * @param unknown_type $variables
 * @param unknown_type $hook
 */
function hipic_preprocess_block(&$variables, $hook) {
$variables['jwplayer_skin']='hipic'; //TEMPLATE JWPLAYER PRINCIPAL HIPIC
  if ($variables['block']->delta == 'home_biblioteca_de_v_deos-block') {
    $variables['block']->subject = l(t($variables['block']->subject),'videos/miscelanea');
  }
}


/**
 * 
 * implements hook_preprocess_node
 * 
 * @param unknown_type $variables
 * @param unknown_type $hook
 */
function hipic_preprocess_node(&$variables, $hook) {
  unset($variables['content']['links']['node']);
  $ruta = drupal_lookup_path('alias',$_GET['q']);
  /*
   * ALEX GENERO CONTENT TYPE SUGGESTIONS
   * 
   */
  // theme_node__[node_type]
  if (isset($variables['node']->type)) {
    $variables['theme_hook_suggestion'] = 'node__'.$variables['node']->type;
    $variables['theme_hook_suggestion'] = 'node__'.$variables['node']->nid;
  }
  // theme_node__[node_type]__teaser
  if($variables['view_mode'] == 'teaser') {
    $variables['theme_hook_suggestions'][] = 'node__' . $variables['node']->type . '__teaser';
    $variables['theme_hook_suggestions'][] = 'node__' . $variables['node']->nid . '__teaser';
  }
 
  // Add socials for all nodes
  $page=isset($_GET['page'])?$_GET['page']:0;
    
  $socials_blk = block_load('widgets','s_socialmedia_share-default');
  $socials = (_block_get_renderable_array(_block_render_blocks(array($socials_blk))));
  $variables['socials'] = $socials;
  
  /**
   * VARIABLES PARA MARKET (theme_hook_suggestions, categoria, sexo)
   * VARIABLES PARA MARKET (theme_hook_suggestions, categoria, sexo)
   * VARIABLES PARA MARKET (theme_hook_suggestions, categoria, sexo)
   * 
   * Depende de field_categor_as (accesorios o animales) prepara un template/variables u otro 
   */
  if (isset($variables['node']->type) && $variables['node']->type == 'item_hipicmarket') {
    //dsm();
    $variables['categoria'] = strtolower($variables['field_categor_as'][0]['taxonomy_term']->name);
    $variables['sexo'] = '';
            
    if ($variables['categoria']=='accesorios'){
      $que_vista='hipicmarket_l1';
      $variables['theme_hook_suggestion'] = 'node__' . $variables['node']->type . '__accesorio';
    } 
    else{
      $que_vista='hipicmarket_l0';
      $variables['sexo'] = strtolower($variables['field_sexo_del_animal'][0]['taxonomy_term']->name);
      $variables['theme_hook_suggestion'] = 'node__' . $variables['node']->type . '__animal';
    }

    if (isset($variables['sexo']) && !empty($variables['sexo'])) $que_vista='hipicmarket_l1';
    else $que_vista='hipicmarket';

    //drupal_set_message($que_vista);
    //drupal_set_message(isset($variables['sexo']) && !empty($variables['sexo'])?("SSS".$variables['sexo']):"NNN");
    
    $view = views_get_view($que_vista);   
    $view->set_current_page($page);
    $arguments=array($variables['categoria'],$variables['sexo']); //@todo
    $view->set_arguments($arguments);
    $vista = $view->preview('page');
        
    $variables['lista_hipicmarket'] = $vista;
    $variables['titulo_lista_hipicmarket'] = $view->get_title();
  }
  
  
  /**
   * VARIABLES PARA NOTICIAS
   * 
   */
  if (isset($variables['node']->type) && $variables['node']->type == 'article') {
    $view = views_get_view('apartado_noticias');   
    //$arguments=array('ponys','castrado');
    //$view->set_arguments($arguments);
    $view->set_current_page($page);
    $vista = $view->preview('page_3');
    
    $variables['apartado_noticias'] = $vista;
    $variables['titulo_apartado_noticias'] = $view->get_title();
    
    if (strpos($ruta,'noticias/')===false) {
      $variables['apartado_noticias']=null;
      $variables['titulo_apartado_noticias']='';
    }
    
    
  }
  
  
  
  /**
   * VARIABLES PARA EVENT
   * 
   */
  if (isset($variables['node']->type) && $variables['node']->type == 'event') {
    //$ruta = drupal_get_normal_path('usuarios/preguntas-a-profesionales');
   
    
    
    $view = views_get_view('calendario');
    //$arguments=array('ponys','castrado');
    //$view->set_arguments($arguments);
    $view->set_current_page($page);
    $vista = $view->preview('page');    
    $variables['proximos_eventos'] = $vista;
    $variables['titulo_proximos_eventos'] = $view->get_title();

    
    
    $view = views_get_view('eventos_destacados');
    //$arguments=array('ponys','castrado');
    //$view->set_arguments($arguments);
    $view->set_current_page($page);
    $vista = $view->preview('block_1');
    
    $variables['eventos_destacados'] = $vista;
    $variables['titulo_eventos_destacados'] = $view->get_title();
    
    if (strpos($ruta,'calendario/')===false) {
      $variables['eventos_destacados']='';
      $variables['titulo_eventos_destacados']='';
      $variables['titulo_proximos_eventos'] = '';
      $variables['proximos_eventos']=''; 
    }
  }
  
  
  /**
   * VARIABLES PARA PREGUNTAS
   * 
   */
  if (isset($variables['node']->type) && $variables['node']->type == 'preguntas') {
    $view = views_get_view('preguntas_a_profesionales');
    //$arguments=array('ponys','castrado');
    //$view->set_arguments($arguments);
    $view->set_current_page($page);
    $vista = $view->preview('page'); 
    $variables['lista_preguntas'] = $vista;
    $variables['titulo_lista_preguntas'] = $view->get_title();        
  }
  
  
  
  

}

/**************************************************************************/
/**************************************************************************/
/**************************************************************************/
/****************************   OVERRIDES *****************************/
/**************************************************************************/
/**************************************************************************/
/**************************************************************************/
/**
 * Returns HTML for the "first page" link in a query pager.
 *
 * @param $variables
 *   An associative array containing:
 *   - text: The name (or image) of the link.
 *   - element: An optional integer to distinguish between multiple pagers on
 *     one page.
 *   - parameters: An associative array of query string parameters to append to
 *     the pager links.
 *
 * @ingroup themeable
 */
function hipic_pager_first($variables) {
  $text = $variables['text'];
  $element = $variables['element'];
  $parameters = $variables['parameters'];
  global $pager_page_array;
  $output = '';

  // If we are anywhere but the first page
  if ($pager_page_array[$element] > 0) {
    $output = theme('pager_link', array('text' => $text, 'page_new' => pager_load_array(0, $element, $pager_page_array), 'element' => $element, 'parameters' => $parameters));
  }

  return $output;
}

/**
 * Returns HTML for the "previous page" link in a query pager.
 *
 * @param $variables
 *   An associative array containing:
 *   - text: The name (or image) of the link.
 *   - element: An optional integer to distinguish between multiple pagers on
 *     one page.
 *   - interval: The number of pages to move backward when the link is clicked.
 *   - parameters: An associative array of query string parameters to append to
 *     the pager links.
 *
 * @ingroup themeable
 */
function hipic_pager_previous($variables) {
  $text = $variables['text'];
  if (!is_numeric($text))   $text="<";
  $element = $variables['element'];
  $interval = $variables['interval'];
  $parameters = $variables['parameters'];
  global $pager_page_array;
  $output = '';

  // If we are anywhere but the first page
  if ($pager_page_array[$element] > 0) {
    $page_new = pager_load_array($pager_page_array[$element] - $interval, $element, $pager_page_array);

    // If the previous page is the first page, mark the link as such.
    if ($page_new[$element] == 0) {
      $output = theme('pager_first', array('text' => $text, 'element' => $element, 'parameters' => $parameters));
    }
    // The previous page is not the first page.
    else {
      $output = theme('pager_link', array('text' => $text, 'page_new' => $page_new, 'element' => $element, 'parameters' => $parameters));
    }
  }

  return $output;
}

/**
 * Returns HTML for the "next page" link in a query pager.
 *
 * @param $variables
 *   An associative array containing:
 *   - text: The name (or image) of the link.
 *   - element: An optional integer to distinguish between multiple pagers on
 *     one page.
 *   - interval: The number of pages to move forward when the link is clicked.
 *   - parameters: An associative array of query string parameters to append to
 *     the pager links.
 *
 * @ingroup themeable
 */
function hipic_pager_next($variables) {
  //$previ==false;
  $text = $variables['text'];
  if (!is_numeric($text))   $text=">";

  $element = $variables['element'];
  $interval = $variables['interval'];
  $parameters = $variables['parameters'];
  global $pager_page_array, $pager_total;
  $output = '';

  // If we are anywhere but the last page
  if ($pager_page_array[$element] < ($pager_total[$element] - 1)) {
    $page_new = pager_load_array($pager_page_array[$element] + $interval, $element, $pager_page_array);
    // If the next page is the last page, mark the link as such.
    if ($page_new[$element] == ($pager_total[$element] - 1)) {
      //$previ=true;
      $output = theme('pager_last', array('text' => $text, 'element' => $element, 'parameters' => $parameters));
    }
    // The next page is not the last page.
    else {
      $output = theme('pager_link', array('text' => $text, 'page_new' => $page_new, 'element' => $element, 'parameters' => $parameters));
    }
  }

  return $output;
}

/**
 * Returns HTML for the "last page" link in query pager.
 *
 * @param $variables
 *   An associative array containing:
 *   - text: The name (or image) of the link.
 *   - element: An optional integer to distinguish between multiple pagers on
 *     one page.
 *   - parameters: An associative array of query string parameters to append to
 *     the pager links.
 *
 * @ingroup themeable
 */
function hipic_pager_last($variables) {
  $text = $variables['text'];
  $element = $variables['element'];
  $parameters = $variables['parameters'];
  global $pager_page_array, $pager_total;
  $output = '';

  // If we are anywhere but the last page
  if ($pager_page_array[$element] < ($pager_total[$element] - 1)) {
    $output = theme('pager_link', array('text' => $text, 'page_new' => pager_load_array($pager_total[$element] - 1, $element, $pager_page_array), 'element' => $element, 'parameters' => $parameters));
  }

  return $output;
}

function hipic_form_search_block_form_alter(&$form, &$form_state, $form_id) {
  if ($form_id == 'search_block_form') {
    $form['search_block_form']['#title'] = t('Search'); // Change the text on the label element
    $form['search_block_form']['#title_display'] = 'invisible'; // Toggle label visibilty
    $form['search_block_form']['#size'] = 40;  // define size of the textfield
    $form['search_block_form']['#default_value'] = t('Search'); // Set a default value for the textfield
    $form['actions']['submit']['#value'] = t('GO!'); // Change the text on the submit button
    $form['actions']['submit'] = array('#type' => 'image_button', '#src' => base_path() . path_to_theme() . '/images/search-button.png');

    // Add extra attributes to the text box
    $form['search_block_form']['#attributes']['onblur'] = "if (this.value == '') {this.value = '".t('Search')."';}";
    $form['search_block_form']['#attributes']['onfocus'] = "if (this.value == '".t('Search')."') {this.value = '';}";
    // Prevent user from searching the default text
    $form['#attributes']['onsubmit'] = "if(this.search_block_form.value=='".t('Search')."'){ alert('Introduce un valor de b�squeda'); return false; }";
  }
}

function hipic_preprocess_field(&$variables, $hook) {
  if ($variables['element']['#field_name'] == 'field_descuentos') {
    $variables['theme_hook_suggestions'][] = 'field__portal_detalle_descuentos';
  }
}

function hipic_preprocess_calendar_main(&$vars) {
  unset($vars['calendar_links']);
}

/**
 * ANULO EL ENLACE A CALENDARIO A TODA PANTALLA
 */
/**
 * Implement hook_theme().
 */
function hipic_theme() {
  return array(
      'date_nav_title' => array(
          'variables' => array(
              'granularity' => NULL,
              'view' => NULL,
              'link' => NULL,
              'format' => NULL,
          )
      ),
  );
}

/**
 * Theme the calendar title
 *
 * This theme function was overriden in order to remove links at month names when using
 * calendar block
 * @see theme_date_nav_title()
 */
function hipic_date_nav_title($params) {
  $granularity = $params['granularity'];
  $view = $params['view'];
  $date_info = $view->date_info;
  $link = !empty($params['link']) ? $params['link'] : FALSE;
  $format = !empty($params['format']) ? $params['format'] : NULL;
  switch ($granularity) {
    case 'year':
      $title = $date_info->year;
      $date_arg = $date_info->year;
      break;
    case 'month':
      $format = !empty($format) ? $format : (empty($date_info->mini) ? 'F Y' : 'F');
      $title = date_format_date($date_info->min_date, 'custom', $format);
      $date_arg = $date_info->year .'-'. date_pad($date_info->month);
      break;
    case 'day':
      $format = !empty($format) ? $format : (empty($date_info->mini) ? 'l, F j Y' : 'l, F j');
      $title = date_format_date($date_info->min_date, 'custom', $format);
      $date_arg = $date_info->year .'-'. date_pad($date_info->month) .'-'. date_pad($date_info->day);
      break;
    case 'week':
      $format = !empty($format) ? $format : (empty($date_info->mini) ? 'F j Y' : 'F j');
      $title = t('Week of @date', array('@date' => date_format_date($date_info->min_date, 'custom', $format)));
      $date_arg = $date_info->year .'-W'. date_pad($date_info->week);
      break;
  }
  if (!empty($date_info->mini) || $link) {
    // Month navigation titles are used as links in the mini view.
    $attributes = array('title' => t('View full page month'));
    return l($title, 'calendario', array('attributes' => $attributes,
                                          'query' => array('mini' => $date_arg)));
  }
  else {
    return $title;
  }
}


