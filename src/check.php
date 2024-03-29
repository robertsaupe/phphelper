<?php
/**
 * phpHelper
 * 
 * Please report bugs on https://github.com/robertsaupe/phphelper/issues
 *
 * @author Robert Saupe <mail@robertsaupe.de>
 * @copyright Copyright (c) 2018, Robert Saupe. All rights reserved
 * @link https://github.com/robertsaupe/phphelper
 * @license MIT License
 */

namespace robertsaupe\helper;

class check {

    public static function is_ssl():bool {
        if( !empty( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] != 'off' ) return true;
        else if( !empty( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' ) return true;
        else return false;
    }

    public static function is_insecure():bool {
        return !self::is_ssl();
    }

    public static function is_secure():bool {
        return self::is_ssl();
    }

    public static function is_http():bool {
        return !self::is_ssl();
    }

    public static function is_https():bool {
        return self::is_ssl();
    }

    public static function is_mail(string $mail):bool {
        if (preg_match('/^[^@]+@[a-zA-Z0-9._-]+\.[a-zA-Z]+$/', $mail)) return true; else return false;
    }

    public static function is_text(string $text):bool {
        if (preg_match('/[^a-zA-Z0-9._-]/i',$text)) return false; else return true;
    }

    public static function implements_class_interface(string $class_name, string $interface_name):bool {
        $interfaces = class_implements( $class_name );
        return isset($interfaces[$interface_name]) ? true : false ;
    }

}
?>