<?php

function safe($str){
    return strip_tags(trim($str));
}

function readJSON($path){
    $string = file_get_contents($path);
    $obj = json_decode($string);
    return $obj;
}

function createFile($string, $path){   
    $pathname   = $path;
    if(!file_exists($pathname)){   
        $folder     =  substr($pathname, 0, strrpos($pathname, '/'));
        @mkdir($folder, 0777, true);
    }
    
    $create = fopen($path, "w") or die("Unable to open file!");
    fwrite($create, $string);
    fclose($create);          
    return $path;
}

function label($str){
    $label = str_replace('_', ' ', $str);
    $label = ucwords($label);
    return $label;
}

function htmlRadio($name = 'input_radio', $selected = '', $array = ['Male' => 'Male', 'Female' => 'Female' ]){
    $radio      = '';
    $id         = 0;   
    
    if(count($array)){        
        foreach($array as $key=>$value ){
            $id++;            
            $radio .= '<label>';
            $radio .= '<input type="radio" name="'.$name.'" id="'.$name .'_'. $id.'"';
            $radio .= ( trim($selected) === $key) ? ' checked ' : '';            
            $radio .= 'value="'. $key .'" /> ' . $value;
            $radio .= '&nbsp;&nbsp;&nbsp;</label>';                        
        }                
    }
    return $radio;
}