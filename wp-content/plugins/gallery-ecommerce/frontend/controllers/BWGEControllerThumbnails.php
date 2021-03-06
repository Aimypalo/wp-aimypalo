<?php

class BWGEControllerThumbnails {
  ////////////////////////////////////////////////////////////////////////////////////////
  // Events                                                                             //
  ////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////
  // Constants                                                                          //
  ////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////
  // Variables                                                                          //
  ////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////
  // Constructor & Destructor                                                           //
  ////////////////////////////////////////////////////////////////////////////////////////
  public function __construct() {
  }
  ////////////////////////////////////////////////////////////////////////////////////////
  // Public Methods                                                                     //
  ////////////////////////////////////////////////////////////////////////////////////////
  public function execute($params = array(), $from_shortcode = 0, $bwge = 0) {
    $this->display($params, $from_shortcode, $bwge);
  }

  public function display($params, $from_shortcode = 0, $bwge = 0) {
    require_once WD_BWGE_DIR . "/frontend/models/BWGEModelThumbnails.php";
    $model = new BWGEModelThumbnails();

    require_once WD_BWGE_DIR . "/frontend/views/BWGEViewThumbnails.php";
    $view = new BWGEViewThumbnails($model);

    $view->display($params, $from_shortcode, $bwge);
  }
  ////////////////////////////////////////////////////////////////////////////////////////
  // Getters & Setters                                                                  //
  ////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////
  // Private Methods                                                                    //
  ////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////
  // Listeners                                                                          //
  ////////////////////////////////////////////////////////////////////////////////////////
}