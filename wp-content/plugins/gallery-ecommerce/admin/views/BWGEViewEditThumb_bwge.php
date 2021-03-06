<?php

class BWGEViewEditThumb_bwge {
  ////////////////////////////////////////////////////////////////////////////////////////
  // Events                                                                             //
  ////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////
  // Constants                                                                          //
  ////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////
  // Variables                                                                          //
  ////////////////////////////////////////////////////////////////////////////////////////
  private $model;


  ////////////////////////////////////////////////////////////////////////////////////////
  // Constructor & Destructor                                                           //
  ////////////////////////////////////////////////////////////////////////////////////////
  public function __construct($model) {
    $this->model = $model;
  }
  ////////////////////////////////////////////////////////////////////////////////////////
  // Public Methods                                                                     //
  ////////////////////////////////////////////////////////////////////////////////////////
  public function display() {
    global $WD_BWGE_UPLOAD_DIR;
    $popup_width = ((int) (isset($_GET['width']) ? esc_html($_GET['width']) : '800')) - 30;
    $image_width = $popup_width - 40;
    $popup_height = ((int) (isset($_GET['height']) ? esc_html($_GET['height']) : '500')) - 50;
    $image_height = $popup_height - 40;
    $image_id = (isset($_GET['image_id']) ? esc_html($_GET['image_id']) : '0');
    $facebook_post = (isset($_GET['FACEBOOK_POST']) ? esc_html($_GET['FACEBOOK_POST']) : false);
    $fb_post_url = (isset($_GET['fb_post_url']) ? esc_html($_GET['fb_post_url']) : '');
    $options = $this->model->get_option_data();
    $app_id = $options->facebook_app_id;
    ?>
    <div style="display:table; width:100%; height:100%;">
      <div id="bwge_container_for_media_1" style="display:table-cell; text-align:center; vertical-align:middle;">
        <?php if(!$facebook_post) { ?>
		  <img id="image_display" src="" style="max-width:<?php echo $image_width; ?>px; max-height:<?php echo $image_height; ?>px;"/>   
        <?php } else { ?>
          <div id="fb-root"></div>
		  <script>
			(function(d, s, id) {
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id))
					return;
				js = d.createElement(s);
				js.id = id;
				js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&version=v2.3&appId=<?php echo $app_id; ?>";
				fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));
		  </script>
		  <div class="fb-post" data-width="300" data-href="https://www.facebook.com/{user_name_or_id}/<?php echo $fb_post_url; ?>"></div>
        <?php } ?>			
      </div>
    </div>
    <script language="javascript" type="text/javascript" src="<?php echo WD_BWGE_URL . '/js/bwge_embed.js?ver='.wd_bwge_version(); ?>"></script>
    <script>
      var file_type = window.parent.document.getElementById("input_filebwge_type<?php echo $image_id; ?>").value;
      
      var is_embed = file_type.indexOf("EMBED_") > -1 ? true : false;
      //for facebook
	  var is_facebook_post = file_type.indexOf("_FACEBOOK_POST") > -1 ? true : false;
	  var file_url = window.parent.document.getElementById("image_url_<?php echo $image_id; ?>").value;
	  
	  var is_instagram_post = file_type.indexOf("INSTAGRAM_POST") > -1 ? true : false;
      if (!is_embed) {
        var image_url = "<?php echo site_url() . '/' . $WD_BWGE_UPLOAD_DIR; ?>" + window.parent.document.getElementById("image_url_<?php echo $image_id; ?>").value;
        window.document.getElementById("image_display").src = image_url + "?date=<?php echo date('Y-m-y H:i:s'); ?>";
      }
      else if(is_embed){
        var embed_id = window.parent.document.getElementById("input_filename_<?php echo $image_id; ?>").value;
        if(!is_facebook_post) {
		  window.document.getElementById("image_display").setAttribute('style', 'display: none;');
          if(!is_instagram_post){ 
            window.document.getElementById("bwge_container_for_media_1").innerHTML = bwge_spider_display_embed(file_type, file_url, embed_id, {class:"embed_display", width:"<?php echo $image_width; ?>", height:"<?php echo $image_height; ?>", frameborder:"0", allowfullscreen:"allowfullscreen", style:"width:<?php echo $image_width; ?>px; height:<?php echo $image_height; ?>px; vertical-align:middle; text-align: center; margin: 0 auto;" });
          }
          else{         
            window.document.getElementById("bwge_container_for_media_1").innerHTML = bwge_spider_display_embed(file_type, file_url, embed_id, {class:"embed_display", width:"<?php echo $image_height -88; ?>", height:"<?php echo $image_height; ?>", frameborder:"0", allowfullscreen:"allowfullscreen", style:"width:<?php echo $image_height -88 ; ?>px; height:<?php echo $image_height; ?>px; vertical-align:middle; text-align: center; margin: 0 auto;" });
          }
		}
      }
    </script>
    <?php
    die();
  }

  public function thumb_display() {
    global $WD_BWGE_UPLOAD_DIR;
    $popup_width = ((int) (isset($_GET['width']) ? esc_html($_GET['width']) : '800')) - 30;
    $image_width = $popup_width - 40;
    $popup_height = ((int) (isset($_GET['height']) ? esc_html($_GET['height']) : '500')) - 50;
    $image_height = $popup_height - 40;
    $image_id = (isset($_GET['image_id']) ? esc_html($_GET['image_id']) : '0');
    ?>
    <div style="display:table; width:100%; height:<?php echo $popup_height; ?>px;">
      <div style="display:table-cell; text-align:center; vertical-align:middle;">
        <img id="thumb_view" src="" style="max-width:<?php echo $image_width; ?>px; max-height:<?php echo $image_height; ?>px;"/>
      </div>
    </div>
    <script>
      var image_url = "<?php echo site_url() . '/' . $WD_BWGE_UPLOAD_DIR; ?>" + window.parent.document.getElementById("thumb_url_<?php echo $image_id; ?>").value;
      window.document.getElementById("thumb_view").src = image_url + "?date=<?php echo date('Y-m-y H:i:s'); ?>";
    </script>
    <?php
    die();
  }

  public function crop() {
    global $WD_BWGE_UPLOAD_DIR;
    $options = $this->model->get_option_data();
    $thumb_width = $options->upload_thumb_width;
    $thumb_height = $options->upload_thumb_height;
    $popup_width = ((int) (isset($_GET['width']) ? esc_html($_GET['width']) : '800')) - 50;
    $image_width = $popup_width - $thumb_width - 70;
    $popup_height = ((int) (isset($_GET['height']) ? esc_html($_GET['height']) : '500')) - 75;
    $image_height = $popup_height - 70;
    $image_id = (isset($_GET['image_id']) ? esc_html($_GET['image_id']) : '0');
    $edit_type = (isset($_POST['edit_type']) ? esc_html($_POST['edit_type']) : '');
    $x = (isset($_POST['x']) ? (int) $_POST['x'] : 0);
    $y = (isset($_POST['y']) ? (int) $_POST['y'] : 0);
    $w = (isset($_POST['w']) ? (int) $_POST['w'] : 0);
    $h = (isset($_POST['h']) ? (int) $_POST['h'] : 0);

    if (isset($_GET['image_url'])) {
      $image_data = new stdClass();
      $image_data->image_url = (isset($_GET['image_url']) ? esc_html(stripcslashes($_GET['image_url'])) : '');
      $image_data->thumb_url = (isset($_GET['thumb_url']) ? esc_html(stripcslashes($_GET['thumb_url'])) : '');
      $filename = htmlspecialchars_decode(ABSPATH . $WD_BWGE_UPLOAD_DIR . $image_data->image_url, ENT_COMPAT | ENT_QUOTES);
      $thumb_filename = htmlspecialchars_decode(ABSPATH . $WD_BWGE_UPLOAD_DIR . $image_data->thumb_url, ENT_COMPAT | ENT_QUOTES);
      $form_action = add_query_arg(array('action' => 'editThumb_bwge', 'type' => 'crop', 'image_id' => $image_id, 'image_url' => $image_data->image_url, 'thumb_url' => $image_data->thumb_url, 'width' => '800', 'height' => '500', 'TB_iframe' => '1'), admin_url('admin-ajax.php'));
    }
    else {
      $image_data = $this->model->get_image_data($image_id);
      $image_data->image_url = stripslashes($image_data->image_url);
      $filename = htmlspecialchars_decode(ABSPATH . $WD_BWGE_UPLOAD_DIR . $image_data->image_url, ENT_COMPAT | ENT_QUOTES);
      $thumb_filename = htmlspecialchars_decode(ABSPATH . $WD_BWGE_UPLOAD_DIR . $image_data->thumb_url, ENT_COMPAT | ENT_QUOTES);
      $form_action = add_query_arg(array('action' => 'editThumb_bwge', 'type' => 'crop', 'image_id' => $image_id, 'width' => '800', 'height' => '500', 'TB_iframe' => '1'), admin_url('admin-ajax.php'));
    }
    @ini_set('memory_limit', '-1');
    list($width_orig, $height_orig, $bwge_typeorig) = getimagesize($filename);
    if ($edit_type == 'crop') {
      if ($bwge_typeorig == 2) {
        $img_r = imagecreatefromjpeg($filename);
        $dst_r = ImageCreateTrueColor($thumb_width, $thumb_height);
        imagecopyresampled($dst_r, $img_r, 0, 0, $x, $y, $thumb_width, $thumb_height, $w, $h);
        imagejpeg($dst_r, $thumb_filename, 90);
        imagedestroy($img_r);
        imagedestroy($dst_r);
      }
      elseif ($bwge_typeorig == 3) {
        $img_r = imagecreatefrompng($filename);
        $dst_r = ImageCreateTrueColor($thumb_width, $thumb_height);
        imageColorAllocateAlpha($dst_r, 0, 0, 0, 127);
        imagealphablending($dst_r, FALSE);
        imagesavealpha($dst_r, TRUE);
        imagecopyresampled($dst_r, $img_r, 0, 0, $x, $y, $thumb_width, $thumb_height, $w, $h);
        imagealphablending($dst_r, FALSE);
        imagesavealpha($dst_r, TRUE);
        imagepng($dst_r, $thumb_filename, 9);
        imagedestroy($img_r);
        imagedestroy($dst_r);
      }
      elseif ($bwge_typeorig == 1) {
        $img_r = imagecreatefromgif($filename);
        $dst_r = ImageCreateTrueColor($thumb_width, $thumb_height);
        imageColorAllocateAlpha($dst_r, 0, 0, 0, 127);
        imagealphablending($dst_r, FALSE);
        imagesavealpha($dst_r, TRUE);
        imagecopyresampled($dst_r, $img_r, 0, 0, $x, $y, $thumb_width, $thumb_height, $w, $h);
        imagealphablending($dst_r, FALSE);
        imagesavealpha($dst_r, TRUE);
        imagegif($dst_r, $thumb_filename);
        imagedestroy($img_r);
        imagedestroy($dst_r);
      }
      else {
        ?>
        <div class="thumb_message"><strong><?php echo __("You can't crop this type of image.", 'bwge_back'); ?></strong></div>
        <?php
      }
    }
    @ini_restore('memory_limit');
    wp_print_scripts('jquery');
    wp_print_scripts('jcrop');
    wp_print_styles('jcrop');
    ?>
    <style>
      body {
        height: <?php echo $popup_height; ?>px;
      }
      .bwge_spider_crop {
        background: linear-gradient(to top, #ECECEC, #F9F9F9) repeat scroll 0 0 #F1F1F1;
        cursor: pointer;
        height: 30px;
        padding: 2px;
        -moz-outline-radius:  2px;
        outline: 1px solid #CCCCCC;
      }
      .bwge_spider_crop:hover {
        -moz-outline-radius:  2px;
        outline: 1px solid #999999;
        padding: 2px;
      }
      .jcrop-holder {
        margin: 0 auto;
      }
      .thumb_preview {
        height: <?php echo $thumb_height; ?>px;
        margin: 0 auto;
        overflow: hidden;
        width: <?php echo $thumb_width; ?>px;
      }
      #thumb_image_preview {
        display: none;
      }
      .thumb_preview_td {
        background-color: #F5F5F5;
        border-radius: 3px;
        border: 1px solid #CCCCCC;
        font-family: sans-serif;
        font-size: 12px;
      }
      .thumb_message {
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        background: linear-gradient(to top, #ECECEC, #F9F9F9) repeat scroll 0 0 #F1F1F1;
        background-color: #F5F5F5;
        border: 1px solid #CCCCCC;
        border-radius: 3px 3px 3px 3px;
        box-sizing: border-box;
        color: #333333;
        font-family: sans-serif;
        font-size: 12px;
        margin: 5px auto;
        padding: 8px 5px;
        width: <?php echo $popup_width; ?>;
      }
      #crop_button {
        display: none;
        height: 38px;
        margin-top: 5px;
        text-align: center;
      }
    </style>
    <?php
    if ($edit_type == 'crop') {
      ?><div class="thumb_message" id="croped_message"><strong><?php echo __('The thumbnail successfully croped.', 'bwge_back'); ?></strong></div><?php
    }
    else {
      ?><div class="thumb_message" id="thumb_message"><strong><?php echo __('Select the area for the thumbnail.', 'bwge_back'); ?></strong></div><?php
    }
    ?>
    <form method="post" id="crop_image" action="<?php echo $form_action; ?>" >
      <?php wp_nonce_field( 'editThumb_bwge', 'bwge_nonce' ); ?>
      <div style="height:<?php echo $popup_height - 10; ?>px; width:<?php echo $popup_width; ?>; margin: 5px auto;">
        <div id="crop_button">
          <img title="Crop" class="bwge_spider_crop" onclick="bwge_spider_crop('crop', 'crop_image')" src="<?php echo WD_BWGE_URL . '/images/crop.png'; ?>"/>
        </div>
        <table style="height: inherit; top: 45px; position: absolute ;width: inherit; margin: 0 auto;">
          <tr>
            <td class="thumb_preview_td" colspan="2">
              <input type="checkbox" id="chb" onclick="bwge_spider_crop_ratio()" checked="checked">
              <label for="chb"><?php echo __('Keep aspect ratio', 'bwge_back'); ?></label>
            </td>
          </tr>
          <tr>
            <td class="thumb_preview_td" style="vertical-align: middle; width: <?php echo ($popup_width - $thumb_width) - 40; ?>px;">
              <img id="image_view" src="<?php echo site_url() . '/' . $WD_BWGE_UPLOAD_DIR . $image_data->image_url; ?>?date=<?php echo date('Y-m-y H:i:s'); ?>" style="max-width:<?php echo $image_width; ?>px; max-height:<?php echo $image_height; ?>px;" />
            </td>
            <td class="thumb_preview_td" style="width:<?php echo $thumb_width + 20; ?>px;">
              <div class="thumb_preview">
                <img id="thumb_image_preview" src="<?php echo site_url() . '/' . $WD_BWGE_UPLOAD_DIR . $image_data->image_url; ?>?date=<?php echo date('Y-m-y H:i:s'); ?>">
              </div>
            </td>
          </tr>
        </table>
      </div>
      <input type="hidden" name="edit_type" id="edit_type" />
      <input id="x" type="hidden" name="x" value="" />
      <input id="y" type="hidden" name="y" value="" />
      <input id="w" type="hidden" name="w" value="" />
      <input id="h" type="hidden" name="h" value="" />
    </form>
    <script language="javascript">
      function bwge_spider_crop_ratio() {
        if (document.getElementById("chb").checked == false) {
          bwge_spider_crop_fix("", "");
        }
        else {
          bwge_spider_crop_fix("<?php echo $options->upload_thumb_width; ?>", "<?php echo $options->upload_thumb_height; ?>");
        }
        jQuery('#crop_button').show();
        jQuery('#thumb_message').hide();
        jQuery('#croped_message').hide();
        jQuery('#thumb_image_preview').show();
      }
      function bwge_spider_crop(type, form_id) {
        document.getElementById("edit_type").value = type;
        document.getElementById(form_id).submit();
      }
      var image_src = window.parent.document.getElementById("image_thumb_<?php echo $image_id; ?>").src;
      window.parent.document.getElementById("image_thumb_<?php echo $image_id; ?>").src = image_src + "?date=<?php echo date('Y-m-y H:i:s'); ?>";
      // jQuery('#image_view').Jcrop();
      jQuery(window).load(function() {
        bwge_spider_crop_fix("<?php echo $options->upload_thumb_width; ?>", "<?php echo $options->upload_thumb_height; ?>");
      });
      function bwge_spider_crop_fix(wi, he) {
        var ratio = parseInt('<?php echo $width_orig; ?>') / jQuery('#image_view').width();
        var thumb_width = parseInt(wi);
        var thumb_height = parseInt(he);
        if (<?php echo $w; ?> == 0) {
          jQuery('#image_view').Jcrop({
            onChange: bwge_spider_update_thumb,
            onSelect: bwge_spider_update_coords,
            // bgColor: 'black',
            bgOpacity: .7,
            aspectRatio: thumb_width / thumb_height
          });
        }
        else {
          jQuery('#image_view').Jcrop({
            onChange: bwge_spider_update_thumb,
            onSelect: bwge_spider_update_coords,
            // bgColor: 'black',
            bgOpacity: .7,
            setSelect: [ <?php echo $x; ?> / ratio, <?php echo $y; ?> / ratio, <?php echo $x + $w; ?> / ratio, <?php echo $y + $h; ?> / ratio ],
            aspectRatio: thumb_width / thumb_height
          });
        }
      }
      function bwge_spider_update_coords(c) {
        var ratio = parseInt('<?php echo $width_orig; ?>') / jQuery('#image_view').width();
        jQuery('#x').val(c.x * ratio);
        jQuery('#y').val(c.y * ratio);
        jQuery('#w').val(c.w * ratio);
        jQuery('#h').val(c.h * ratio);
        jQuery('#crop_button').show();
        jQuery('#thumb_message').hide();
        jQuery('#croped_message').hide();
        jQuery('#thumb_image_preview').show();
        jQuery('.thumb_preview').css("border", "1px solid #CCCCCC");
      }
      function bwge_spider_update_thumb(c) {
        jQuery('#crop_button').hide();
        jQuery('#croped_message').show();
        var thumb_width = parseInt('<?php echo $options->upload_thumb_width; ?>');
        var thumb_height = parseInt('<?php echo $options->upload_thumb_height; ?>');
        jQuery('#thumb_image_preview').css("margin-left", -c.x * (thumb_width / c.w) + "px");
        jQuery('#thumb_image_preview').css("margin-top", -c.y * (thumb_height / c.h) + "px");        
        jQuery('#thumb_image_preview').css("width", ((thumb_width / c.w) * jQuery('#image_view').width()) + "px");
        jQuery('#thumb_image_preview').css("height", ((thumb_height / c.h) * jQuery('#image_view').height()) + "px");
      }
    </script>
    <?php
    die();
  }
  
  public function recover_image($id, $thumb_width, $thumb_height) {
    global $WD_BWGE_UPLOAD_DIR;
    global $wpdb;
    $image_data = $wpdb->get_row($wpdb->prepare('SELECT * FROM ' . $wpdb->prefix . 'bwge_image WHERE id="%d"', $id));
    if (!$image_data) {
      $image_data = new stdClass();
      $image_data->image_url = (isset($_GET['image_url']) ? esc_html(stripcslashes($_GET['image_url'])) : '');
      $image_data->thumb_url = (isset($_GET['thumb_url']) ? esc_html(stripcslashes($_GET['thumb_url'])) : '');
    }
    $filename = htmlspecialchars_decode(ABSPATH . $WD_BWGE_UPLOAD_DIR . $image_data->image_url, ENT_COMPAT | ENT_QUOTES);
    $thumb_filename = htmlspecialchars_decode(ABSPATH . $WD_BWGE_UPLOAD_DIR . $image_data->thumb_url, ENT_COMPAT | ENT_QUOTES);
    copy(str_replace('/thumb/', '/.original/', $thumb_filename), $filename);
    list($width_orig, $height_orig, $bwge_typeorig) = getimagesize($filename);
    $percent = $width_orig / $thumb_width;
    $thumb_height = $height_orig / $percent;
    @ini_set('memory_limit', '-1');
    if ($bwge_typeorig == 2) {
      $img_r = imagecreatefromjpeg($filename);
      $dst_r = ImageCreateTrueColor($thumb_width, $thumb_height);
      imagecopyresampled($dst_r, $img_r, 0, 0, 0, 0, $thumb_width, $thumb_height, $width_orig, $height_orig);
      imagejpeg($dst_r, $thumb_filename, 100);
      imagedestroy($img_r);
      imagedestroy($dst_r);
    }
    elseif ($bwge_typeorig == 3) {
      $img_r = imagecreatefrompng($filename);
      $dst_r = ImageCreateTrueColor($thumb_width, $thumb_height);
      imageColorAllocateAlpha($dst_r, 0, 0, 0, 127);
      imagealphablending($dst_r, FALSE);
      imagesavealpha($dst_r, TRUE);
      imagecopyresampled($dst_r, $img_r, 0, 0, 0, 0, $thumb_width, $thumb_height, $width_orig, $height_orig);
      imagealphablending($dst_r, FALSE);
      imagesavealpha($dst_r, TRUE);
      imagepng($dst_r, $thumb_filename, 9);
      imagedestroy($img_r);
      imagedestroy($dst_r);
    }
    elseif ($bwge_typeorig == 1) {
      $img_r = imagecreatefromgif($filename);
      $dst_r = ImageCreateTrueColor($thumb_width, $thumb_height);
      imageColorAllocateAlpha($dst_r, 0, 0, 0, 127);
      imagealphablending($dst_r, FALSE);
      imagesavealpha($dst_r, TRUE);
      imagecopyresampled($dst_r, $img_r, 0, 0, 0, 0, $thumb_width, $thumb_height, $width_orig, $height_orig);
      imagealphablending($dst_r, FALSE);
      imagesavealpha($dst_r, TRUE);
      imagegif($dst_r, $thumb_filename);
      imagedestroy($img_r);
      imagedestroy($dst_r);
    }
    @ini_restore('memory_limit');
  }
  
  public function rotate() {
    global $WD_BWGE_UPLOAD_DIR;
    $popup_width = ((int) (isset($_GET['width']) ? esc_html($_GET['width']) : '650')) - 30;
    $image_width = $popup_width - 40;
    $popup_height = ((int) (isset($_GET['height']) ? esc_html($_GET['height']) : '500')) - 55;
    $image_height = $popup_height - 70;
    $image_id = (isset($_GET['image_id']) ? esc_html($_GET['image_id']) : '0');
    $edit_type = (isset($_POST['edit_type']) ? esc_html($_POST['edit_type']) : '');
    $brightness_val = (isset($_POST['brightness_val']) ? esc_html($_POST['brightness_val']) : 0);
    $contrast_val = (isset($_POST['contrast_val']) ? esc_html($_POST['contrast_val']) : 0);

    if (isset($_GET['image_url'])) {
      $image_data = new stdClass();
      $image_data->image_url = (isset($_GET['image_url']) ? esc_html(stripcslashes($_GET['image_url'])) : '');
      $image_data->thumb_url = (isset($_GET['thumb_url']) ? esc_html(stripcslashes($_GET['thumb_url'])) : '');
      $filename = htmlspecialchars_decode(ABSPATH . $WD_BWGE_UPLOAD_DIR . $image_data->image_url, ENT_COMPAT | ENT_QUOTES);
      $thumb_filename = htmlspecialchars_decode(ABSPATH . $WD_BWGE_UPLOAD_DIR . $image_data->thumb_url, ENT_COMPAT | ENT_QUOTES);
      $form_action = add_query_arg(array('action' => 'editThumb_bwge', 'type' => 'rotate', 'image_id' => $image_id, 'image_url' => $image_data->image_url, 'thumb_url' => $image_data->thumb_url, 'width' => '650', 'height' => '500', 'TB_iframe' => '1'), admin_url('admin-ajax.php'));
    }
    else {
      $image_data = $this->model->get_image_data($image_id);
      $image_data->image_url = stripcslashes($image_data->image_url);      
      $filename = htmlspecialchars_decode(ABSPATH . $WD_BWGE_UPLOAD_DIR . $image_data->image_url, ENT_COMPAT | ENT_QUOTES);
      $thumb_filename = htmlspecialchars_decode(ABSPATH . $WD_BWGE_UPLOAD_DIR . $image_data->thumb_url, ENT_COMPAT | ENT_QUOTES);
      $form_action = add_query_arg(array('action' => 'editThumb_bwge', 'type' => 'rotate', 'image_id' => $image_id, 'width' => '650', 'height' => '500', 'TB_iframe' => '1'), admin_url('admin-ajax.php'));
    }
    @ini_set('memory_limit', '-1');
    list($width_rotate, $height_rotate, $bwge_typerotate) = getimagesize($filename);
    if ($edit_type == '270' || $edit_type == '90') {
      if ($bwge_typerotate == 2) {
        $source = imagecreatefromjpeg($filename);
        $thumb_source = imagecreatefromjpeg($thumb_filename);
        $rotate = imagerotate($source, $edit_type, 0);
        $thumb_rotate = imagerotate($thumb_source, $edit_type, 0);
        imagejpeg($thumb_rotate, $thumb_filename, 90);
        imagejpeg($rotate, $filename, 100);
        imagedestroy($source);
        imagedestroy($rotate);
        imagedestroy($thumb_source);
        imagedestroy($thumb_rotate);
      }
      elseif ($bwge_typerotate == 3) {
        $source = imagecreatefrompng($filename);
        $thumb_source = imagecreatefrompng($thumb_filename);
        imagealphablending($source, FALSE);
        imagealphablending($thumb_source, FALSE);
        imagesavealpha($source, TRUE);
        imagesavealpha($thumb_source, TRUE);
        $rotate = imagerotate($source, $edit_type, imageColorAllocateAlpha($source, 0, 0, 0, 127));
        $thumb_rotate = imagerotate($thumb_source, $edit_type, imageColorAllocateAlpha($source, 0, 0, 0, 127));
        imagealphablending($rotate, FALSE);
        imagealphablending($thumb_rotate, FALSE);
        imagesavealpha($rotate, TRUE);
        imagesavealpha($thumb_rotate, TRUE);
        imagepng($rotate, $filename, 9);
        imagepng($thumb_rotate, $thumb_filename, 9);
        imagedestroy($source);
        imagedestroy($rotate);
        imagedestroy($thumb_source);
        imagedestroy($thumb_rotate);
      }
      elseif ($bwge_typerotate == 1) {
        $source = imagecreatefromgif($filename);
        $thumb_source = imagecreatefromgif($thumb_filename);
        imagealphablending($source, FALSE);
        imagealphablending($thumb_source, FALSE);
        imagesavealpha($source, TRUE);
        imagesavealpha($thumb_source, TRUE);
        $rotate = imagerotate($source, $edit_type, imageColorAllocateAlpha($source, 0, 0, 0, 127));
        $thumb_rotate = imagerotate($thumb_source, $edit_type, imageColorAllocateAlpha($source, 0, 0, 0, 127));
        imagealphablending($rotate, FALSE);
        imagealphablending($thumb_rotate, FALSE);
        imagesavealpha($rotate, TRUE);
        imagesavealpha($thumb_rotate, TRUE);
        imagegif($rotate, $filename);
        imagegif($thumb_rotate, $thumb_filename);
        imagedestroy($source);
        imagedestroy($rotate);
        imagedestroy($thumb_source);
        imagedestroy($thumb_rotate);
      }
    }
    elseif ($edit_type == 'vertical' || $edit_type == 'horizontal'  || $edit_type == 'both') {
      function bwge_image_flip($imgsrc, $mode) {
        $width = imagesx($imgsrc);
        $height = imagesy($imgsrc);
        $src_x = 0;
        $src_y = 0;
        $src_width = $width;
        $src_height = $height;

        switch ($mode) {
          case 'vertical':
            $src_y = $height - 1;
            $src_height = -$height;
            break;

          case 'horizontal':
            $src_x = $width - 1;
            $src_width = -$width;
            break;

          case 'both':
            $src_x = $width - 1;
            $src_y = $height - 1;
            $src_width = -$width;
            $src_height = -$height;
            break;

          default:
            return $imgsrc;
        }
        $trans_colour = imageColorAllocateAlpha($imgsrc, 0, 0, 0, 127);
        $imgdest = imagecreatetruecolor($width, $height);
        imagefill($imgdest, 0, 0, $trans_colour);
        if (imagecopyresampled($imgdest, $imgsrc, 0, 0, $src_x, $src_y , $width, $height, $src_width, $src_height)) {
          return $imgdest;
        }
        return $imgsrc;
      }
      if ($bwge_typerotate == 2) {
        $source = imagecreatefromjpeg($filename);
        $flip = bwge_image_flip($source, $edit_type);
        imagejpeg($flip, $filename, 100);
        $thumb_source = imagecreatefromjpeg($thumb_filename);
        $thumb_flip = bwge_image_flip($thumb_source, $edit_type);
        imagejpeg($thumb_flip, $thumb_filename, 90);
        imagedestroy($source);
        imagedestroy($flip);
        imagedestroy($thumb_source);
        imagedestroy($thumb_flip);
      }
      elseif ($bwge_typerotate == 3) {
        $source = imagecreatefrompng($filename);
        $thumb_source = imagecreatefrompng($thumb_filename);
        imagealphablending($source, FALSE);
        imagealphablending($thumb_source, FALSE);
        imagesavealpha($source, TRUE);
        imagesavealpha($thumb_source, TRUE);
        $flip = bwge_image_flip($source, $edit_type);
        $thumb_flip = bwge_image_flip($thumb_source, $edit_type);
        imagealphablending($flip, FALSE);
        imagealphablending($thumb_flip, FALSE);
        imagesavealpha($flip, TRUE);
        imagesavealpha($thumb_flip, TRUE);
        imagepng($flip, $filename, 9);
        imagepng($thumb_flip, $thumb_filename, 9);
        imagedestroy($source);
        imagedestroy($flip);
        imagedestroy($thumb_source);
        imagedestroy($thumb_flip);
      }
      elseif ($bwge_typerotate == 1) {
        $source = imagecreatefromgif($filename);
        $thumb_source = imagecreatefromgif($thumb_filename);
        imagealphablending($source, FALSE);
        imagealphablending($thumb_source, FALSE);
        imagesavealpha($source, TRUE);
        imagesavealpha($thumb_source, TRUE);
        $flip = bwge_image_flip($source, $edit_type);
        $thumb_flip = bwge_image_flip($thumb_source, $edit_type);
        imagealphablending($flip, FALSE);
        imagealphablending($thumb_flip, FALSE);
        imagesavealpha($flip, TRUE);
        imagesavealpha($thumb_flip, TRUE);
        imagegif($flip, $filename);
        imagegif($thumb_flip, $thumb_filename);
        imagedestroy($source);
        imagedestroy($flip);
        imagedestroy($thumb_source);
        imagedestroy($thumb_flip);
      }
    }
    elseif ($edit_type == 'brightness' || $edit_type == 'contrast' || $edit_type == 'grayscale' || $edit_type == 'negative' || $edit_type == 'remove' || $edit_type == 'emboss' || $edit_type == 'smooth') {
      switch ($edit_type) {
        case 'brightness' : 
          $img_filter_type = IMG_FILTER_BRIGHTNESS;
          $ratio = $brightness_val;
          break;
          case 'contrast' : 
            $img_filter_type = IMG_FILTER_CONTRAST;
          $ratio = $contrast_val;
          break;
        case 'grayscale' : 
            $img_filter_type = IMG_FILTER_GRAYSCALE;
          $ratio = '';
          break;
        case 'negative' : 
            $img_filter_type = IMG_FILTER_NEGATE;
          $ratio = '';
          break;
        case 'remove' : 
            $img_filter_type = IMG_FILTER_MEAN_REMOVAL;
          $ratio = '';
          break;
        case 'emboss' : 
            $img_filter_type = IMG_FILTER_EMBOSS;
          $ratio = '';
          break;
        case 'smooth' : 
            $img_filter_type = IMG_FILTER_SMOOTH;
          $ratio = 30;
          break;
        default:
          return;
      }
      $img_type = $bwge_typerotate;
      if ($img_type == 2) {
        $source = imagecreatefromjpeg($filename);
        $thumb_source = imagecreatefromjpeg($thumb_filename);		
        imagefilter($source, $img_filter_type, $ratio);		
        imagefilter($thumb_source, $img_filter_type, $ratio);		       
        imagejpeg($source, $filename, 100);
        imagejpeg($thumb_source, $thumb_filename, 90);
        imagedestroy($source);
        imagedestroy($thumb_source);
      }
      elseif ($img_type == 3) {
        $source = imagecreatefrompng($filename);
        $thumb_source = imagecreatefrompng($thumb_filename);
        imagealphablending($source, FALSE);
        imagealphablending($thumb_source, FALSE);
        imagesavealpha($source, TRUE);
        imagesavealpha($thumb_source, TRUE);
        imagefilter($source, $img_filter_type, $ratio);		
        imagefilter($thumb_source, $img_filter_type, $ratio);
        imagepng($source, $filename, 9);
        imagepng($thumb_source, $thumb_filename, 9);
        imagedestroy($source);
        imagedestroy($thumb_source);
      }
      elseif ($img_type == 1) {
        $source = imagecreatefromgif($filename);
        $thumb_source = imagecreatefromgif($thumb_filename);
        imagealphablending($source, FALSE);
        imagealphablending($thumb_source, FALSE);
        imagesavealpha($source, TRUE);
        imagesavealpha($thumb_source, TRUE);
        imagefilter($source, $img_filter_type, $ratio);		
        imagefilter($thumb_source, $img_filter_type, $ratio);
        imagegif($source, $filename);
        imagegif($thumb_source, $thumb_filename);
        imagedestroy($source);
        imagedestroy($thumb_source);
      }
    }
    elseif ($edit_type == 'sepia' || $edit_type == 'dark_slate_grey' || $edit_type == 'saturate') {
      switch($edit_type) { 
        case 'sepia' : 
          $img_filter_type = IMG_FILTER_COLORIZE;
          $red = 112;
          $green = 66;
          $blue = 20;
          break;
        case 'dark_slate_grey' : 
          $img_filter_type = IMG_FILTER_COLORIZE;
          $red = 47;
          $green = 79;
          $blue = 79;
          break;
        case 'saturate' : 
          $img_filter_type = IMG_FILTER_COLORIZE;
          $red = 236;
          $green = 40;
          $blue = 41;
          break;
        default:
          return;
      }
      $img_type = $bwge_typerotate;
      if ($img_type == 2) {
        $source = imagecreatefromjpeg($filename);
        $thumb_source = imagecreatefromjpeg($thumb_filename);		
        imagefilter($source, $img_filter_type, $red, $green, $blue);		
        imagefilter($thumb_source, $img_filter_type, $red, $green, $blue);		       
        imagejpeg($source, $filename, 100);
        imagejpeg($thumb_source, $thumb_filename, 90);		
        imagedestroy($source);
        imagedestroy($thumb_source);
      }
      elseif ($img_type == 3) {
        $source = imagecreatefrompng($filename);
        $thumb_source = imagecreatefrompng($thumb_filename);
        imagealphablending($source, FALSE);
        imagealphablending($thumb_source, FALSE);
        imagesavealpha($source, TRUE);
        imagesavealpha($thumb_source, TRUE);
        imagefilter($source, $img_filter_type, $red, $green, $blue);		
        imagefilter($thumb_source, $img_filter_type, $red, $green, $blue);
        imagepng($source, $filename, 9);
        imagepng($thumb_source, $thumb_filename, 9);
        imagedestroy($source);
        imagedestroy($thumb_source);
      }
      elseif ($img_type == 1) {
        $source = imagecreatefromgif($filename);
        $thumb_source = imagecreatefromgif($thumb_filename);
        imagealphablending($source, FALSE);
        imagealphablending($thumb_source, FALSE);
        imagesavealpha($source, TRUE);
        imagesavealpha($thumb_source, TRUE);
        imagefilter($source, $img_filter_type, $red, $green, $blue);		
        imagefilter($thumb_source, $img_filter_type, $red, $green, $blue);
        imagegif($source, $filename);
        imagegif($thumb_source, $thumb_filename);
        imagedestroy($source);
        imagedestroy($thumb_source);
      }
    }
    elseif ($edit_type == 'recover') {
      global $wpdb;
      $id = ((isset($_POST['image_id'])) ? (int) esc_html(stripslashes($_POST['image_id'])) : 0);
      $options = $wpdb->get_row('SELECT * FROM ' . $wpdb->prefix . 'bwge_option WHERE id=1');
      $thumb_width = $options->thumb_width;
      $thumb_height = $options->thumb_height;
      $this->recover_image($id, $thumb_width, $thumb_height);
    }
    @ini_restore('memory_limit');
    wp_print_scripts('jquery');
    wp_print_scripts('jquery-ui-widget');
    wp_print_scripts('jquery-ui-slider');
    ?>
    <link type="text/css" rel="stylesheet" id="bwge_tables-css" href="<?php echo WD_BWGE_FRONT_URL . '/css/bwge_edit_image.css'; ?>" media="all">
    <link type="text/css" rel="stylesheet" href="<?php echo WD_BWGE_FRONT_URL . '/css/font-awesome/font-awesome.css'; ?>" >
    <form method="post" id="bwge_rotate_image" action="<?php echo $form_action; ?>">
      <?php wp_nonce_field('editThumb_bwge', 'bwge_nonce'); ?>
      <div class="main_cont" style="height: <?php echo $popup_height; ?>px;">
        <div class="cont_for_effect">          
          <div class="effect_cont">
            <img class="effect" onclick="bwge_spider_rotate('grayscale', 'bwge_rotate_image')" src="<?php echo WD_BWGE_URL . '/images/effects/grayscale.png'; ?>"/>
            <p class="effect_title"><?php echo __('Grayscale', 'bwge_back'); ?></p>
          </div>
          <div class="effect_cont">
            <img class="effect" onclick="bwge_spider_rotate('negative', 'bwge_rotate_image')" src="<?php echo WD_BWGE_URL . '/images/effects/negative.png'; ?>"/>
            <p class="effect_title"><?php echo __('Negative', 'bwge_back'); ?></p>
          </div>
          <div class="effect_cont">
            <img class="effect" onclick="bwge_spider_rotate('remove', 'bwge_rotate_image')" src="<?php echo WD_BWGE_URL . '/images/effects/remove.png'; ?>"/>
            <p class="effect_title"><?php echo __('Removal', 'bwge_back'); ?></p>
          </div>
          <div class="effect_cont">
            <img class="effect" onclick="bwge_spider_rotate('sepia', 'bwge_rotate_image')" src="<?php echo WD_BWGE_URL . '/images/effects/sepia.png'; ?>"/>
            <p class="effect_title"><?php echo __('Sepia', 'bwge_back'); ?></p>
          </div>
          <div class="effect_cont">
            <img class="effect" onclick="bwge_spider_rotate('dark_slate_grey', 'bwge_rotate_image')" src="<?php echo WD_BWGE_URL . '/images/effects/dark_slate_grey.png'; ?>"/>
            <p class="effect_title"><?php echo __('Slate', 'bwge_back'); ?></p>
          </div>
          <div class="effect_cont">
            <img class="effect" onclick="bwge_spider_rotate('saturate', 'bwge_rotate_image')" src="<?php echo WD_BWGE_URL . '/images/effects/saturate.png'; ?>"/>				  
            <p class="effect_title"><?php echo __('Saturate', 'bwge_back'); ?></p>		 
         </div>
        </div>		
        <div class="reset_cont">
          <a class="reset_img" onclick="if (confirm('<?php echo addslashes(__('Do you want to reset the image?', 'bwge_back')); ?>')) bwge_spider_rotate('recover', 'bwge_rotate_image'); else return false; "><?php echo __('Reset image', 'bwge_back'); ?></a>
        </div>
        <div class="flip_cont" >		  
          <img title="Flip Both" class="effect" onclick="bwge_spider_rotate('both', 'bwge_rotate_image')" src="<?php echo WD_BWGE_URL . '/images/effects/flip_both.png'; ?>"/>
          <img title="Flip Vertical" class="effect" onclick="bwge_spider_rotate('vertical', 'bwge_rotate_image')" src="<?php echo WD_BWGE_URL . '/images/effects/flip_vertical.png'; ?>"/>
          <img title="Flip Horizontal" class="effect" onclick="bwge_spider_rotate('horizontal', 'bwge_rotate_image')" src="<?php echo WD_BWGE_URL . '/images/effects/flip_horizontal.png'; ?>"/>
          <img title="Rotate Left" class="effect" onclick="bwge_spider_rotate('90', 'bwge_rotate_image')" src="<?php echo WD_BWGE_URL . '/images/effects/rotate_left.png'; ?>"/>
          <img title="Rotate Right" class="effect" onclick="bwge_spider_rotate('270', 'bwge_rotate_image')" src="<?php echo WD_BWGE_URL . '/images/effects/rotate_right.png'; ?>"/>		
        </div>
        <div class="img_cont" style="height:<?php echo $popup_height - 40; ?>px;">
          <div class="img_main_cont" >
            <div class="last_cont">
              <img class="bwge_preview_image" src="<?php echo site_url() . '/' . $WD_BWGE_UPLOAD_DIR . $image_data->image_url; ?>?date=<?php echo date('Y-m-y H:i:s'); ?>" style="max-width: <?php echo $image_width; ?>px; max-height: <?php echo $image_height; ?>px;" />
            </div>
          </div>
          <div class="cont_bright_cont">
            <div class="cont_bright_cont_main">
              <div class="last_cont">
                <div class="bwge_opt_cont">
                  <img title="Options" src="<?php echo WD_BWGE_URL . '/images/effects/option.png'; ?>" />
                </div>
                <div  id="brightness_contrast" ><!--
               --><div class="brightness_part" >
                    <div class="brightness_part_1">
                      <div class="brightness_butt">
                        <div class="contForBrightness">
                          <div class="brightness_title"><?php echo __('Brightness', 'bwge_back'); ?></div>
                          <img title="Press for brightness" class="brightnessEffect" onclick="bwge_spider_rotate('brightness', 'bwge_rotate_image')" src="<?php echo WD_BWGE_URL . '/images/effects/brightness.png'; ?>" />
                          <div class="tooltip_for_press"><?php echo __('Press for result', 'bwge_back'); ?></div>
                        </div>
                      </div>
                      <div class="cont_for_val">
                        <div id="sliderForBrightness">
                          <div class="brightness_val">
                            <div class="brightness_value">0</div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div><!--
               --><div class="contrast_part">				    
                    <div class="contrast_part_1">
                      <div class="contrast_part_slider">
                        <div id="sliderForcontrast">
                          <div class="contrast_val">
                            <div class="contrast_val_cont">0</div>
                          </div>
                        </div>
                      </div>
                      <div class="contrast_butt">
                        <div class="contForContrast">
                          <div class="contrast_title"><?php echo __('Contrast', 'bwge_back'); ?></div>
                          <img title="Press for Contrast" class="contrastEffect" onclick="bwge_spider_rotate('contrast', 'bwge_rotate_image')" src="<?php echo WD_BWGE_URL . '/images/effects/contrast.png'; ?>" />
                          <div class="tooltip_for_press_contrast"><?php echo __('Press for result', 'bwge_back'); ?></div>
                        </div>
                      </div>
                    </div>				
                  </div><!--
             --></div>
              </div>
            </div>		  
          </div>
        </div>
        </div>
        <input type="hidden" name="edit_type" id="edit_type" />
        <input type="hidden" name="image_id" id="image_id" value="<?php echo $image_id; ?>" />
      <input type="hidden" name="brightness_val" id="brightness_val" value="<?php echo $brightness_val; ?>" />
      <input type="hidden" name="contrast_val" id="contrast_val" value="<?php echo $contrast_val; ?>" />
    </form>	
    <script>
      jQuery(function() {
        jQuery("#sliderForBrightness").slider({
          range: "min",
          value: 0,
          min: -255,
          max: 255,
          step: 1,
          slide: function(event, ui) {
            jQuery('#brightness_val').val(ui.value);
            jQuery('.brightness_value').html(ui.value);
            
            var x = parseInt(ui.value);
            x = x + 255;
            var in_percents = (x / 510) * 100;			
            var in_percents_for_arrow = in_percents- 12;
            jQuery('.brightness_val').css('left', in_percents_for_arrow + '%');
            jQuery('.tooltip_for_press').fadeIn( "slow" );			
          }
        });
        jQuery("#sliderForcontrast").slider({
          range: "min",
          value: 0,
          min: -100,
          max: 100,
          step: 1,
          slide: function(event, ui) {
            jQuery('#contrast_val').val(ui.value);		
            jQuery('.contrast_val_cont').html(ui.value);
            var x = parseInt(ui.value);
            x = x + 100;
            var in_percents = (x / 200) * 100;			
            var in_percents_for_arrow = in_percents - 12;
            jQuery('.contrast_val').css('left', in_percents_for_arrow + '%');
            jQuery('.tooltip_for_press_contrast').fadeIn( "slow" );
          }
        });
      });
      function bwge_spider_rotate(type, form_id) {
        document.getElementById("edit_type").value = type;
        document.getElementById(form_id).submit();
      }

	  if (window.parent.document.getElementById("image_thumb_pr_<?php echo $image_id; ?>") != null){
        var image_src = window.parent.document.getElementById("image_thumb_pr_<?php echo $image_id; ?>").src;
		    window.parent.document.getElementById("image_thumb_pr_<?php echo $image_id; ?>").src = image_src + "?date=<?php echo date('Y-m-y H:i:s'); ?>";
	  }	
	  else {
        var image_src = window.parent.document.getElementById("image_thumb_<?php echo $image_id; ?>").src;	 
        window.parent.document.getElementById("image_thumb_<?php echo $image_id; ?>").src = image_src + "?date=<?php echo date('Y-m-y H:i:s'); ?>";		
	  }

      jQuery(document).ready(function() {
        jQuery(".bwge_opt_cont").click(function(){
          if (jQuery('#brightness_contrast').height() == 0)
            jQuery('#brightness_contrast').animate({
              height: 40
            }, 
            'linear',
            function() {
              jQuery('#sliderForBrightness').css('opacity', 1);
              jQuery('#sliderForBrightness').css('display', 'inline-block');
              jQuery('#sliderForcontrast').css('opacity', 1);
              jQuery('#sliderForcontrast').css('display', 'inline-block');
              jQuery('.contForBrightness').css('display', 'inline-block');
              jQuery('.contForContrast').css('display', 'inline-block');
            });
          else 
            jQuery('#brightness_contrast').animate({
              height: 0
            },
            'linear',
            function() {
              jQuery('#sliderForBrightness').css('opacity', 0);
              jQuery('#sliderForBrightness').css('display', 'none');
              jQuery('#sliderForcontrast').css('opacity', 0);
              jQuery('#sliderForcontrast').css('display', 'none');
              jQuery('.contForBrightness').css('display', 'none');
              jQuery('.contForContrast').css('display', 'none');
            }
          );
        });
        jQuery('body').click(function() {
          jQuery('.tooltip_for_press').fadeOut( "slow" );
        });
        jQuery('body').click(function() {
          jQuery('.tooltip_for_press_contrast').fadeOut("slow");
        });
      });
    </script>
    <?php
    die();
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