<?php

class Currency{

    function __construct(){
        //do nothing for now
    }

// http://www.phpbuilder.com/board/showthread.php?t=10350901
    static public function formatAsBDT($amount, $safix='/=') {
        $output_string = '';
        $fraction = '';
        $tokens = explode('.', $amount);
        $number = $tokens[0];
        if (count($tokens) > 1) {
            $fraction = (double) ('0.' . $tokens[1]);
            $fraction = $fraction * 100;
            $fraction = round($fraction, 0);
            $fraction = '.' . $fraction;
        }

        $number     = $number . '';
        $spl        = str_split($number);
        $lpcount    = count($spl);
        //$rem = $lpcount - 3;
        //echo "rem".$rem."";
        //even one
        if ($lpcount % 2 == 0) {
            for ($i = 0; $i <= $lpcount - 1; $i++) {

                if ($i % 2 != 0 && $i != 0 && $i != $lpcount - 1) {
                    $output_string .= ',';
                }
                $output_string .= $spl[$i];
            }
        }
        //odd one
        if ($lpcount % 2 != 0) {
            for ($i = 0; $i <= $lpcount - 1; $i++) {
                if ($i % 2 == 0 && $i != 0 && $i != $lpcount - 1) {
                    $output_string .= ',';
                }
                $output_string .= $spl[$i];
            }
        }
        return self::removeFirstLess($output_string . $fraction . $safix);
    }
    
    static private function removeFirstLess( $string = '10,00,000'){
        return  str_replace('-,', '-', $string);        
    }

    static public function writtenAsBDT($amount) {
        $output_string = '';

        $tokens = explode('.', $amount);
        $current_amount = $tokens[0];
        $fraction = '';
        if (count($tokens) > 1) {
            $fraction = (double) ('0.' . $tokens[1]);
            $fraction = $fraction * 100;
            $fraction = round($fraction, 0);
            $fraction = (int) $fraction;
            $fraction = self::translate_to_words($fraction) . ' paisa';
            $fraction = ' Taka & ' . $fraction;
        }

        $crore = 0;
        if ($current_amount >= pow(10, 7)) {
            $crore = (int) floor($current_amount / pow(10, 7));
            $output_string .= self::translate_to_words($crore) . ' crore ';
            $current_amount = $current_amount - $crore * pow(10, 7);
        }

        $lakh = 0;
        if ($current_amount >= pow(10, 5)) {
            $lakh           = (int) floor($current_amount / pow(10, 5));
            $output_string .= self::translate_to_words($lakh) . ' lakh ';
            $current_amount = $current_amount - $lakh * pow(10, 5);
        }

        $current_amount = (int) $current_amount;
        $output_string .= self::translate_to_words($current_amount);

        $output_string = $output_string . $fraction . ' taka only';
        return ucwords($output_string);        
    }

    
// http://efreedom.com/Question/1-3181945/Convert-Money-Text-PHP
    static private function translate_to_words($number = 0) {
        /*         * ***
         * A recursive function to turn digits into words
         * Numbers must be integers from -999,999,999,999 to 999,999,999,999 inclussive.
         *
         * (C) 2010 Peter Ajtai
         * This program is free software: you can redistribute it and/or modify
         * it under the terms of the GNU General Public License as published by
         * the Free Software Foundation, either version 3 of the License, or
         * (at your option) any later version.
         *
         * This program is distributed in the hope that it will be useful,
         * but WITHOUT ANY WARRANTY; without even the implied warranty of
         * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
         * GNU General Public License for more details.
         *
         * See the GNU General Public License: <http://www.gnu.org/licenses/>.
         *
         */
// zero is a special case, it cause problems even with typecasting if we don't deal with it here
        $max_size = pow(10, 18);
        if (!$number){
            return "zero";
        }
        
        if (is_int($number) && $number < abs($max_size)) {
            $prefix = '';
            $suffix = '';
            switch ($number) {
            // set up some rules for converting digits to words
                case $number < 0:
                    $prefix = "negative";
                    $suffix = self::translate_to_words(-1 * $number);
                    $string = $prefix . ' ' . $suffix;
                    break;
                case 1:
                    $string = 'one';
                    break;
                case 2:
                    $string = 'two';
                    break;
                case 3:
                    $string = 'three';
                    break;
                case 4:
                    $string = 'four';
                    break;
                case 5:
                    $string = 'five';
                    break;
                case 6:
                    $string = 'six';
                    break;
                case 7:
                    $string = 'seven';
                    break;
                case 8:
                    $string = 'eight';
                    break;
                case 9:
                    $string = 'nine';
                    break;
                case 10:
                    $string = 'ten';
                    break;
                case 11:
                    $string = 'eleven';
                    break;
                case 12:
                    $string = 'twelve';
                    break;
                case 13:
                    $string = 'thirteen';
                    break;
                // fourteen handled later
                case 15:
                    $string = 'fifteen';
                    break;
                case $number < 20:
                    $string = self::translate_to_words($number % 10);
                    // eighteen only has one "t"
                    if ($number == 18) {
                        $suffix = "een";
                    } else {
                        $suffix = "teen";
                    }
                    $string .= $suffix;
                    break;
                case 20:
                    $string = "twenty";
                    break;
                case 30:
                    $string = "thirty";
                    break;
                case 40:
                    $string = "forty";
                    break;
                case 50:
                    $string = "fifty";
                    break;
                case 60:
                    $string = "sixty";
                    break;
                case 70:
                    $string = "seventy";
                    break;
                case 80:
                    $string = "eighty";
                    break;
                case 90:
                    $string = "ninety";
                    break;
                case $number < 100:
                    $prefix = self::translate_to_words($number - $number % 10);
                    $suffix = self::translate_to_words($number % 10);
                    //$string = $prefix . "-" . $suffix;
                    $string = $prefix . " " . $suffix;
                    break;
                    // handles all number 100 to 999
                case $number < pow(10, 3):
                    // floor return a float not an integer
                    $prefix = self::translate_to_words(intval(floor($number / pow(10, 2)))) . " hundred";
                    if ($number % pow(10, 2)){
                        $suffix = " and " . self::translate_to_words($number % pow(10, 2));
                    }
                    $string = $prefix . $suffix;
                    break;
                case $number < pow(10, 6):
                    // floor return a float not an integer
                    $prefix = self::translate_to_words(intval(floor($number / pow(10, 3)))) . " thousand";
                    if ($number % pow(10, 3)){
                        $suffix = self::translate_to_words($number % pow(10, 3));
                    }
                    $string = $prefix . " " . $suffix;
                    break;
            }
        } else {
            echo "ERROR with - $number
                 Number must be an integer between -" .
                 number_format($max_size, 0, ".", ", ") . " and " . 
                 number_format($max_size, 0, ".", ", ") . " exclussive.";
        }
        return $string;
    }

}

// Example Usages

//
//for ($i = 1; $i < 10; $i++) {
//    $seed = time() / ($i + 1);
//    srand($seed);
//    $amount = mt_rand(100, 9999999);
//    $amount = $amount + $i / 10;
//    echo Currency::get_bd_money_format($amount) . ' : ' . Currency::get_bd_amount_in_text($amount);
//}