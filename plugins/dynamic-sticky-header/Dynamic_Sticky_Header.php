<?php

/**
 * Plugin Name: Dynamic Sticky Header
 * Plugin URI:
 * Description: Make your sticky header navigation move dynamically away from the field of view when scrolling.
 * Version: 2.0.0
 * Text Domain:
 * Author: Jarmo Lääkkö
 * Author URI: jamotech.vetohazard.fi
 */


if( ! defined( 'ABSPATH' ) ) exit;
require_once plugin_dir_path(__FILE__) . '/PHP/AdditionalDSH.php';



/*
*This program is free software: you can redistribute it and/or modify it under the terms of the
 GNU General Public License as published by the Free Software Foundation, either version GPLv2 of the License, or
 any later version.
*This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
 without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 See the GNU General Public License for more details.
*You should have received a copy of the GNU General Public License along with this program.
If not, see <https://www.gnu.org/licenses/>.
*/

Class DynamicStickyHeader {

    function __construct() {
         //init database name
        global $wpdb;
        $this->charset = $wpdb->get_charset_collate();
        $this->tablename = $wpdb->prefix . "DynamicHeader";
        //Create new settings menu item and call onActivate
        add_action('admin_menu', array($this, 'dynamicStickyHeaderSettingsMenu'));
        add_action('wp_loaded', array($this, 'dynamicStickyHeaderOnActivate'));

        //show custom database in RESTAPI
        add_action( 'rest_api_init', function () {
          $namespace = 'additionalsettings/v1';
          $route     = '/settings';
  
          register_rest_route($namespace, $route, array(
              'methods'   => WP_REST_Server::READABLE,
              'callback'  => function () {
                  global $wpdb;
                  $table_name = $wpdb->prefix.'AdditionalDSH';
                  
                  $query = "SELECT  Additional_Header_Value FROM $table_name";
                  $results = $wpdb->get_results($query);
                  return $results;
              },
              'permission_callback' => '__return_true',
              'args' => array()
          ));
      });
      

    }



    function dynamicStickyHeaderSettingsMenu(){

        add_options_page('Dynamic Sticky Header Settings', __('Dynamic Sticky Header Settings', 'wcpdomain'), 'manage_options', 'Dynamic-Header-Settings-page', array($this, 'dynamicStickyHeaderEditorHTML'));
    }

    function dynamicStickyHeaderOnActivate() {

      //Make database connection
      global $wpdb;
      require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
      $table = $wpdb->prefix.'DynamicHeader';
      $true_or_false = $wpdb->get_var( "SELECT Dynamic_Header_On_Off FROM $table");
     


      dbDelta("CREATE TABLE $this->tablename (
        setting_id INT(2) NOT NULL,
        Dynamic_Header_On_Off varchar(60) NOT NULL DEFAULT '',
        PRIMARY KEY  (setting_id)
      ) $this->charset;");

      //Create db for additional settings

        $table_name = $wpdb->prefix.'AdditionalDSH';
        $true_or_false_AdditionalDSH = $wpdb->get_var( "SELECT Additional_Header_On_Off FROM $table_name");
        $charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset} COLLATE {$wpdb->collate}";
      
        
        $sql = "CREATE TABLE {$table_name} (
        As_id INT(2) unsigned NOT NULL auto_increment,
        Additional_Header_On_Off varchar(60) NOT NULL DEFAULT '',
        Additional_Header_Value varchar(20) NOT NULL default '',
        PRIMARY KEY  (As_id)
        )
        {$charset_collate};";

        dbDelta($sql);

      //Check if DSH has data

      if($true_or_false == 'true' && is_admin() == 0) {
        $dynamic_sticky_header_path = plugins_url( 'js/Dynamic_Sticky_header.js', __FILE__ );
        //enqueue script
        wp_enqueue_script(
        "DynamicStickyHeader",
        $dynamic_sticky_header_path
        );

      }

      //Check if ADSH has data
      
      if($true_or_false_AdditionalDSH == 'true' && is_admin() == 0) {
        $additional_dynamic_sticky_header_path = plugins_url( 'js/AdditionalDSH.js', __FILE__ );
        //enqueue script
        wp_enqueue_script(
        "A_DynamicStickyHeader",
        $additional_dynamic_sticky_header_path
        );

      }
    }


    function dynamicStickyHeaderHandleForm() {
      

        global $wpdb;
        $table = $wpdb->prefix.'DynamicHeader';
        $count = $wpdb->get_var( "SELECT COUNT(*) FROM $table");

      if(isset($_POST['enableDynamicStickyHeader'])){
        //check if record exists in db

          if($count > 0) {
           
            $format = array('%d','%s');
            $where = [ 'setting_id' => '1' ];
            $data = array('setting_id' => '1','Dynamic_Header_On_Off' => "true");
            $wpdb->update($table,$data,$where,$format);

          }

            $format = array('%d','%s');
            $data = array('setting_id' => "1", 'Dynamic_Header_On_Off' => "true");
            $wpdb->insert($table,$data,$format);


            ?>
            <div class="updated">
          <p>Your settings are updated</p>
        </div>

          <?php
          
     }  //if database has no record and user sends an empty input, set dynamic header to false
        if(empty($_POST['enableDynamicStickyHeader'])) {

          if ($count == 0) {

            
            global $wpdb;
            $table = $wpdb->prefix.'Dynamic_Header_On_Off';
            $format = array('%d','%s');
            $data = array('setting_id' => "1", 'Dynamic_Header_On_Off' => "false");
            $wpdb->insert($table,$data,$format);

            ?>
            <div class="updated">
          <p>Your settings are updated</p>
        </div>

          <?php
          } //if db has a record and user sends an empty input, set dynamic header to false
          else {

            global $wpdb;
            $table = $wpdb->prefix.'DynamicHeader';
            $format = array('%d','%s');
            $where = [ 'setting_id' => '1' ];
            $data = array('setting_id' => '1','Dynamic_Header_On_Off' => "false");
            $wpdb->update($table,$data,$where,$format);

            ?>
            <div class="updated">
          <p>Your settings are updated</p>
        </div>

          <?php
          }
        }
    }


function dynamicStickyHeaderEditorHTML(){

    $dynamic_sticky_header_css_path = plugins_url( 'CSS/DynamicStickyHeader.css', __FILE__ );
    wp_enqueue_style('DynamicStickyHEaderCSS',$dynamic_sticky_header_css_path, false);
        ?>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <body onload="runThisOnLoadForState()">

    <?php
     global $wpdb;
    if ($_POST['justsubmitted'] == "true") $this->dynamicStickyHeaderHandleForm() ?>
    <form method="POST">
          <input type="hidden" name="justsubmitted" value="true">
            <?php wp_nonce_field('Our-Classic-Editor_plugin', 'ourNonce');

            //Give db info for HTML elements

            $table = $wpdb->prefix.'DynamicHeader';
            $true_or_false = $wpdb->get_var( 
            "SELECT Dynamic_Header_On_Off
             FROM $table
             WHERE setting_id = 1         
             ");

          
            if($true_or_false == 'true') {

            ?>
            <h2>Disable Dynamic Sticky Header</h2>
                  <label class="switch">
                  <input id="checkedDSHSwitch" type="checkbox" name="enableDynamicStickyHeader" value="Dynamic_Sticky_Header_On" checked >
                  <span class="slider round"></span>
            </label> <?php }

            else {?>
              <h2>Enable Dynamic Sticky Header</h2>
            <label class="switch">
                  <input type="checkbox" name="enableDynamicStickyHeader" value="dynamicstickyheaderon" >
                  <span class="slider round"></span>
            </label> <?php
            }
              ?>
            <table>
              <tbody>
              </tbody>
            </table>
            </div>
            <!-- additional settings -->

           <?php 
              $additionalDSHClassName = $_POST['TextFieldFOrDSHAdditionalSettings'];
              $table_name = $wpdb->prefix.'AdditionalDSH';
              
           
              if ($_POST['justsubmittedAdditionalSettings'] == "true") handleAdditionalSettings($additionalDSHClassName) ?>
            <input type="hidden" name="justsubmittedAdditionalSettings" value="true">
              <hr style="margin-top: 15px;">
              <h3>Additional Settings</h3>

              <!--put the if condtion chech here -->
              <?php
                $queryforadsth = $wpdb->get_var("SELECT Additional_Header_Value FROM $table_name WHERE As_id = 1");
                $true_or_false_AdditionalDSH = $wpdb->get_var( 
                "SELECT Additional_Header_On_Off
                 FROM $table_name
                 WHERE As_id = 1         
                 ");
                
              if($true_or_false_AdditionalDSH == 'true') { 
              ?>

            <label style="display: block;" id="ADSHinput" class="switch">
                  <input id="ADSHSwitch"  type="checkbox" name="enableAdditionalDynamicStickyHeaderSettings" value="AdditionaldynamicstickyheaderSettingsOn" onclick="openDSHSettings()" checked>
                  <span  class="slider round"></span>
            </label>
            <?php } else { ?>
            
              <label style="display: block;" id="ADSHinput" class="switch">
                  <input id="ADSHSwitch"  type="checkbox" name="enableAdditionalDynamicStickyHeaderSettings" value="AdditionaldynamicstickyheaderSettingsOn" onclick="openDSHSettings()">
                  <span  class="slider round"></span>
            </label>
            <?php } ?>


            <div id="AdditionalSettingsFieldsForDSH" style="display:none;">
            <label class="InputFieldFOrDSHAdditionalSettings">
              <p>Type your menu element's parent classname here</p>
              <!--<p> What should I type here? Check this <a href="https://wordpress.org/support/topic/how-to-use-dynamic-sticky-header-plugin/#new-topic-0">post</a> from the Wordpress forums.</p> -->
                <input type="text" name="TextFieldFOrDSHAdditionalSettings" value="<?php echo $queryforadsth ?>">
            </label>
          </div>
    
          <br>

            <input style="margin-top: 20px;" type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes">
          </form>

            <!--PHP check if database has record and switch is turned off dont show additional settings -->
  

            <!--js for hiding and showing additional menu - not separate file needed for this--->
            <script>

            

              let runThisOnLoadForState = () => {
              let x = document.getElementById("AdditionalSettingsFieldsForDSH");
              let y = document.getElementById("ADSHSwitch");
             

                if(y.checked){
                  
                x.style.display = "block";
                }

              }

              let openDSHSettings = () => {
                
                var x = document.getElementById("AdditionalSettingsFieldsForDSH");
                if (x.style.display === "none"){
                  x.style.display = "block";
                  
                } 
                 else {
                  x.style.display = "none";
                  
                }

                               
              }

              let closeADSHSettings = () => {

                
                var x = document.getElementById("ADSHinput");
                if (x.style.display === "block"){
                  x.style.display = "none";
                 
                } else {
                  x.style.display = "block";
                  
                }
              
              }
              

            </script>
          </form>
          </div>
    </body>



        <?php

          }
}

$ourDynamicHeader= new DynamicStickyHeader();
 ?>
