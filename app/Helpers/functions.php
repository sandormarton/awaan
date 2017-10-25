<?php

namespace App\Helpers;

use DateTime;
use DateTimeZone;

class Functions
{

    /*
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */
    static function cleanurl($string) {
        $string = str_replace('\\', '-', $string);
        $string = str_replace('"', '\'', $string);
        $string = str_replace('/', '-', $string);
        $string = str_replace('\'', '', $string);
        $string = str_replace('!', '', $string);
        $string = str_replace('(', '', $string);
        $string = str_replace(')', '', $string);
        $string = str_replace('%', '', $string);

        $string = preg_replace('/[^\w\s\d\p{L}\.:?!-@]/u', '', $string);
        return preg_replace('/[\s_-]/', "-", $string);
    }

    static function get_useragent_info($ua = false)
    {
        //$useragent = ($ua) ? $_SERVER['HTTP_USER_AGENT'] : $ua;
        $useragent = "Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36";

        $browsers = Array('msie','chrome','safari','firefox','opera');
        preg_match("/(?:version\/|(?:msie|chrome|safari|firefox|opera) )([\d.]+)/i", $useragent, $matches);
        print_r($matches);
        //$version = $matches[1];
        $browser = "";
        foreach($browsers as $b)
        {
            if (stripos($useragent, $b) !== false)
            {
                $browser = ucfirst($b);
                break;
            }
        }
        return ['browser' => $browser, 'version' => $matches];
    } // End of Function

    public static function convertToAETime($date, $format = 'H:i')
    {
        $dt = new DateTime($date, new DateTimeZone('UTC'));

        // change the timezone of the object without changing it's time
        $dt->setTimezone(new DateTimeZone('Asia/Dubai'));

        // format the datetime
        return $dt->format($format);
    }

    public static function convertToGMTime($date, $format = 'H:i'){
        $dt = new DateTime($date, new DateTimeZone('Asia/Dubai'));

        // change the timezone of the object without changing it's time
        $dt->setTimezone(new DateTimeZone('UTC'));

        // format the datetime
        return $dt->format($format);
    }

    static function convertToAEDate($date)
    {
        $dt = new DateTime($date, new DateTimeZone('UTC'));

        // change the timezone of the object without changing it's time
        $dt->setTimezone(new DateTimeZone('Asia/Dubai'));

        // format the datetime
        return $dt->format('Y-m-d H:i:s');
    }

    public static function convertFormat($date, $format = 'H:i')
    {
        $dt = new DateTime($date, new DateTimeZone('UTC'));

        // format the datetime
        return $dt->format($format);
    }

    static function isImageFile($file)
    {
        $info = pathinfo($file);
        return (isset($info['extension']) && in_array(strtolower($info['extension']),
                array("jpg", "jpeg", "gif", "png", "bmp"))) ? true : false;
    }

    static function isValidURL($url)
    {
        return (filter_var($url, FILTER_VALIDATE_URL) != FALSE);
    }

    public static function convertToHoursMins($time, $format = '%02d h %02d m') {
        if ($time < 1) {
            return;
        }
        $hours = floor($time / 60);
        $minutes = ($time % 60);
        return sprintf($format, $hours, $minutes);
    }
}

