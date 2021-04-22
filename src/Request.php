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

namespace RobertSaupe\Helper;

class Request {

    private static ?string $folder = null;
    private static ?string $file = null;

    private static ?string $request_string = null;
    private static ?array $request_array = null;

    public static function Set_Folder(?string $folder = null) {
        if ($folder == null)  {
            $folder = dirname($_SERVER['SCRIPT_NAME']);
            if (strlen($folder) <= 1) $folder = '';
            $folder .= '/';
        }
        self::$folder = $folder;
    }

    public static function Set_File(?string $file = null) {
        if ($file == null) $file = basename($_SERVER['SCRIPT_NAME']);
        self::$file = $file;
    }

    public static function Load(?string $folder = null, ?string $file = null) {
        self::Set_Folder($folder);
        self::Set_File($file);

        //remove folder
        $request = implode('', explode(self::$folder, $_SERVER['REQUEST_URI'], 2));

        //remove file
        $request = implode('', explode(self::$file, $request, 2));

        //remove get
        $request = explode('?', $request, 2)[0];

        //clean
        $request = Clean::String($request);

        //remove / from begin and end
        if (substr($request, 0, 1) == '/') $request = substr($request, 1);
        if (substr($request, -1, 1) == '/') $request = substr($request, 0, strlen($request) - 1);

        self::$request_string = $request;
        self::$request_array = explode('/', $request);
    }

    public static function String():string {
        if (self::$request_string == null) self::Load();
        return self::$request_string;
    }

    public static function Array():array {
        if (self::$request_array == null) self::Load();
        return self::$request_array;
    }

}
?>