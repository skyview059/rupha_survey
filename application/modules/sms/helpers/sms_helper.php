<?php

defined('BASEPATH') OR exit('No direct script access allowed');

function isUnicode($string){
    if (strlen($string) != strlen(utf8_decode($string))){
        return 'UNICODE';
    } else {
        return 'TEXT';
    }
}

function smsQTY($string){
    if (strlen($string) != strlen(utf8_decode($string))){
        return ceil(mb_strlen( $string ) / 70);
    } else {
        return ceil(mb_strlen( $string ) / 160);
    }
}

function deliveryStatus($string){
    if(empty($string)){ return 'No Data Found'; }    
    $json = json_decode($string);
    return $json->api_response_message;
}
