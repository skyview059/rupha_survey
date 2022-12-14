<?php
// +------------------------------------------------------------------------+
// | class.upload.ja_JP.php                                                 |
// +------------------------------------------------------------------------+
// | Copyright (c) Kenta Ozaki 2012. All rights reserved.                   |
// | Version       0.25                                                     |
// | Last modified 09/05/2012                                               |
// | Email         kenta.ozaki@gmail.com                                    |
// | Web           http://www.facebook.com/Kenta.Ozaki                      |
// +------------------------------------------------------------------------+
// | This program is free software; you can redistribute it and/or modify   |
// | it under the terms of the GNU General Public License version 2 as      |
// | published by the Free Software Foundation.                             |
// |                                                                        |
// | This program is distributed in the hope that it will be useful,        |
// | but WITHOUT ANY WARRANTY; without even the implied warranty of         |
// | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the          |
// | GNU General Public License for more details.                           |
// |                                                                        |
// | You should have received a copy of the GNU General Public License      |
// | along with this program; if not, write to the                          |
// |   Free Software Foundation, Inc., 59 Temple Place, Suite 330,          |
// |   Boston, MA 02111-1307 USA                                            |
// |                                                                        |
// | Please give credit on sites that use class.upload and submit changes   |
// | of the script so other people can use them as well.                    |
// | This script is free to use, don't abuse.                               |
// +------------------------------------------------------------------------+

/**
 * Class upload Japanese translation
 *
 * @version   0.28
 * @author    Kenta Ozaki (kenta.ozaki@gmail.com)
 * @license   http://opensource.org/licenses/gpl-license.php GNU Public License
 * @copyright Kenta Ozaki
 * @package   cmf
 * @subpackage external
 */

    $translation = array();
    $translation['file_error']                  = '?????????????????????: ?????????????????????????????????';
    $translation['local_file_missing']          = '????????????????????????????????????????????????';
    $translation['local_file_not_readable']     = '???????????????????????????????????????????????????????????????';
    $translation['uploaded_too_big_ini']        = '?????????????????????????????????????????????????????? (the uploaded file exceeds the upload_max_filesize directive in php.ini).';
    $translation['uploaded_too_big_html']       = '?????????????????????????????????????????????????????? (the uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the html form).';
    $translation['uploaded_partial']            = '?????????????????????????????????????????????????????? (the uploaded file was only partially uploaded).';
    $translation['uploaded_missing']            = '?????????????????????????????????????????????????????? (no file was uploaded).';
    $translation['uploaded_no_tmp_dir']         = '?????????????????????????????????????????????????????? (missing a temporary folder).';
    $translation['uploaded_cant_write']         = '?????????????????????????????????????????????????????? (failed to write file to disk).';
    $translation['uploaded_err_extension']      = '?????????????????????????????????????????????????????? (file upload stopped by extension).';
    $translation['uploaded_unknown']            = '?????????????????????????????????????????????????????? (unknown error code).';
    $translation['try_again']                   = '?????????????????????????????????????????????????????? ?????????????????????????????????';
    $translation['file_too_big']                = '????????????????????????????????????';
    $translation['no_mime']                     = 'MIME????????????????????????????????????';
    $translation['incorrect_file']              = '???????????????????????????????????????';
    $translation['image_too_wide']              = '??????????????????????????????';
    $translation['image_too_narrow']            = '??????????????????????????????';
    $translation['image_too_high']              = '??????????????????????????????';
    $translation['image_too_short']             = '??????????????????????????????';
    $translation['ratio_too_high']              = '????????????????????????????????? (???????????????????????????)';
    $translation['ratio_too_low']               = '?????????????????????????????? (???????????????????????????)';
    $translation['too_many_pixels']             = '??????????????????????????????????????????';
    $translation['not_enough_pixels']           = '?????????????????????????????????????????????';
    $translation['file_not_uploaded']           = '?????????????????????????????????????????????????????? ??????????????????????????????????????????????????????';
    $translation['already_exists']              = '%s ?????????????????????????????? ?????????????????????????????????????????????';
    $translation['temp_file_missing']           = '??????????????????????????????????????? ??????????????????????????????????????????????????????';
    $translation['source_missing']              = '??????????????????????????????????????????????????? ??????????????????????????????????????????????????????';
    $translation['destination_dir']             = '??????????????????????????????????????????????????????????????? ??????????????????????????????????????????????????????';
    $translation['destination_dir_missing']     = '??????????????????????????????????????????????????? ??????????????????????????????????????????????????????';
    $translation['destination_path_not_dir']    = '???????????????????????????????????????????????????????????? ??????????????????????????????????????????????????????';
    $translation['destination_dir_write']       = '???????????????????????????????????????????????????????????????????????????????????? ??????????????????????????????????????????????????????';
    $translation['destination_path_write']      = '???????????????????????????????????????????????????????????? ??????????????????????????????????????????????????????';
    $translation['temp_file']                   = '???????????????????????????????????????????????????????????? ??????????????????????????????????????????????????????';
    $translation['source_not_readable']         = '???????????????????????????????????????????????? ??????????????????????????????????????????????????????';
    $translation['no_create_support']           = '%s ?????????????????????????????????';
    $translation['create_error']                = '????????????????????? %s ?????????????????????????????????';
    $translation['source_invalid']              = '???????????????????????????????????????????????????';
    $translation['gd_missing']                  = 'GD ????????????????????????';
    $translation['watermark_no_create_support'] = '????????????????????????????????????????????????%s ?????????????????????????????????';
    $translation['watermark_create_error']      = '%s ???????????????????????????????????????????????????????????????????????????????????????';
    $translation['watermark_invalid']           = '?????????????????????????????? ?????????????????????????????????????????????';
    $translation['file_create']                 = '%s ?????????????????????????????????';
    $translation['no_conversion_type']          = '?????????????????????????????????????????????';
    $translation['copy_failed']                 = '????????????????????????????????? copy() ????????????????????????';
    $translation['reading_failed']              = '????????????????????????????????????';
