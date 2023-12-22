<?php 
function handleAdditionalSettings($additionalDSHClassName){
    
            global $wpdb;
            $table_name = $wpdb->prefix.'AdditionalDSH';
            $count2 = $wpdb->get_var( "SELECT COUNT(*) FROM $table_name");
            $format = array('%d','%s','%s');
            $where = [ 'As_id' => '1' ];
        
        if(isset($_POST['enableAdditionalDynamicStickyHeaderSettings'])){
           

            $count2 = $wpdb->get_var( "SELECT COUNT(*) FROM $table_name");

            

            if($count2 > 0) {
                 
                $data = array(
                'As_id' => "1",
                'Additional_Header_On_Off' => "true",
                'Additional_Header_Value' => $additionalDSHClassName);
                $wpdb->update($table_name,$data,$where,$format);
                }
          else {      
        
                
        $data = array(
        'As_id' => "1",
        'Additional_Header_On_Off' => "true",
        'Additional_Header_Value' => "$additionalDSHClassName");
        $wpdb->insert($table_name,$data,$where,$format);
        }     
             
                      
       }
        //if database has no record and user sends an empty input, set dynamic header to false
        if(empty($_POST['enableAdditionalDynamicStickyHeaderSettings'])) {
            
            $count2 = $wpdb->get_var( "SELECT COUNT(*) FROM $table_name");
            if($count2 == 0) {
               
             
            
                $data = array(
                'As_id' => "1",
                'Additional_Header_On_Off' => "false",
                'Additional_Header_Value' => "");
                $wpdb->insert($table_name,$data,$where,$format);
                } 
                
                else { //if db has a record and user sends an empty input, set dynamic header to false
                   
               

                    
                $data = array(
                'As_id' => '1',
                'Additional_Header_On_Off' => "false",
                'Additional_Header_Value' => "");
                $wpdb->update($table_name,$data,$where,$format); 


                }

            }
    
}

?>