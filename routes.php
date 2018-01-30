<?php
  function call($controller, $action) {
    // require the file that matches the controller name
    require_once('controllers/' . $controller . '_controller.php');

    // create a new instance of the needed controller
    switch($controller) {
      case 'pages':
        $controller = new PagesController();
      break;
      case 'pessoas':
        // we need the model to query the database later in the controller
        $controller = new PessoasController();
    }

    // call the action
    if( !is_a($controller->{ $action }(), 'View') ){
        exit();
    }
  }

  // just a list of the controllers we have and their actions
  // we're adding an entry for the new controller and its actions
  $controllers = array('pages' => ['error'],
                       'pessoas' => ['index', 'create', 'edit', 'store', 'update', 'destroy', 'formacaoAcademicaReport', 'faixaEtariaReport']);

  // check that the requested controller and action are both allowed
  // if someone tries to access something else he will be redirected to the error action of the pages controller
  if (array_key_exists($controller, $controllers)) {
    if (in_array($action, $controllers[$controller])) {
      call($controller, $action);
    } else {
      call('pages', 'error');
    }
  } else {
    call('pages', 'error');
  }
