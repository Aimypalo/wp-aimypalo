<?php

class BWGEModelBWGEShortcode_bwge {
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

  public function get_shortcode_data() {
    global $wpdb;
    $shortcode = $wpdb->get_results("SELECT id, tagtext FROM " . $wpdb->prefix . "bwge_shortcode ORDER BY `id` ASC");
    return $shortcode;
  }

  public function get_shortcode_max_id() {
    global $wpdb;
    $max_id = $wpdb->get_var("SELECT MAX(id) FROM " . $wpdb->prefix . "bwge_shortcode");
    return $max_id;
  }

  public function get_gallery_rows_data() {
    global $wpdb;
    $query = "SELECT * FROM " . $wpdb->prefix . "bwge_gallery WHERE published=1 ORDER BY name";
    $rows = $wpdb->get_results($query);
    return $rows;
  }

  public function get_album_rows_data() {
    global $wpdb;
    $query = "SELECT * FROM " . $wpdb->prefix . "bwge_album WHERE published=1 ORDER BY name";
    $rows = $wpdb->get_results($query);
    return $rows;
  }

  public function get_option_row_data() {
    global $wpdb;
    $query = "SELECT * FROM " . $wpdb->prefix . "bwge_option WHERE id=1";
    $rows = $wpdb->get_row($query);
    return $rows;
  }

  public function get_theme_rows_data() {
    global $wpdb;
    $query = "SELECT * FROM " . $wpdb->prefix . "bwge_theme ORDER BY name";
    $rows = $wpdb->get_results($query);
    return $rows;
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