<?php  defined('BASEPATH') OR exit('No direct script access allowed');


function get_all_modules( $id = 0){ 
    
    $ci     =& get_instance();    
    $modules = $ci->db->get('modules')->result();
    
    $option = '';
    foreach( $modules as $module ){        
        $option .= '<option value="'. $module->id .'"';
        $option .= ($id == $module->id ) ? ' selected' : '';
        $option .= '>'.$module->name . ' </option>';
    }
    return $option;
}

function addAdminMenu($name, $url = '', $icon = 'fa-envelope-o', $childrens = null){
    $role_id        = getLoginUserData('role_id');
    $ci             =& get_instance();    
    $active_url     = $ci->uri->segment( 1 );    
    $class_active   = ($active_url ===  $url) ? 'active' : '';
    
    /* auto admin prefix check up ignored by kanny 
     * Due performance. We could check Backend_URL == admin 
     * so no need to add prefix or add Backend_URL as prefix;
     * 17th Oct 2016, 2:45 am 
     */
    
    $html = '';
    
    if(checkMenuPermission($url, $role_id)){
      
        $html .= '<li class="treeview '. $class_active .'">
        <a href="'. Backend_URL .  $url .'">
        <i class="fa '. $icon .'"></i> <span>'. $name .'</span>
        <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
        </span>
        </a>';


        if( !empty($childrens)){
            $html .= '<ul class="treeview-menu">';
            foreach( $childrens as $item){           
                if(checkMenuPermission($item['href'], $role_id)){
                   $html .= addAdminChildMenu( $item['title'], $item['href'],  $item['icon']);
               }
               
                //$html .= addAdminChildMenu( $item['title'], $item['href'],  $item['icon']);
           }
           $html .= '</ul>';
       }
       $html   .= '</li>';   
   }
   
   return $html;    
}

function addAdminChildMenu($title = 'Child Item', $childURL = 'admin', $icon = 'fa-circle-o'){
    $ci             =& get_instance();    
    $active_url     = $ci->uri->uri_string();
    $class_active   = ($active_url === ( Backend_URL . $childURL) ) ? ' class="active"' : '';       
    return '<li'.  $class_active  .'><a href="'. Backend_URL .  $childURL .'"><i class="fa '.$icon.'"></i>' . $title .'</a></li>';           
}



function checkMenuPermission($access_key,$role_id){
    return checkPermission($access_key,$role_id);
}

function checkPermission($access_key,$role_id){
    $ci =& get_instance();        
    return $ci->db->join('acls', 'acls.id = role_permissions.acl_id', 'left')
    ->where('role_id',$role_id)
    ->where('permission_key',$access_key)           
    ->count_all_results('role_permissions');
}    


function add_main_menu($title, $url, $access, $icon){
    // $title, $url, $icon, $access.
    $ci          =& get_instance();     
    $active_url  = $ci->uri->uri_string();
    
    $role_id    = getLoginUserData('role_id');
    $menu       = '';
    if(checkPermission($access,$role_id)){
        
        $class_active   = ($active_url === $url ) ? ' class="active"' : '';       
        
        $menu .= '<li '. $class_active.'><a href="' . $url .'">';
        $menu .= '<i class="fa '. $icon .'"></i>';
        $menu .= '<span>'.$title .'</span>';
        $menu .= '</a><li>';
        return $menu;
    }
    
    
    
    
    
    
}



function buildMenuForMoudle( $menus = null){  
    /* Example Array 
     * only display when developer forgot to assign array;
     * remarkd by Kanny 
     * 17th Oct 2016, 3:05am 
    */
    $array = [
        'module'    => 'Menu Title',
        'icon'      => 'fa-users',
        'href'      => 'module',
        'children'  => [
            [ 
                'title' => 'Sub Title 1',
                'icon'  => 'fa fa-circle-o',
                'href'  => 'module/controller/method1'
            ]
        ]
    ];    
    if(!is_null($menus)){ $array = $menus; }         
    $menu = addAdminMenu($array['module'], $array['href'], $array['icon'], @$array['children'] );        
    return $menu;        
}
