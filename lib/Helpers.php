<?php

namespace lib;

// Configuration Class
class Helpers {

    public static function getInstance() {
        if (!isset(self::$instance))
        {
            $object = __CLASS__;
            self::$instance = new $object;
        }
        return self::$instance;
    }

    public static function dateBR($datetime)
    {
        return date('d/m/Y',strtotime($datetime));
    }

    public static function timeBR($datetime)
    {
        return date('H:i',strtotime($datetime));
    }

    public static function dateTimeBR($datetime)
    {
        return date('d/m/Y - H:i:s',strtotime($datetime));
    }

    public static function dateDB($date)
    {
        $dateArr = explode('/',$date);
        $date = date_create($dateArr[2].'-'.$dateArr[1].'-'.$dateArr[0]);
        return date_format($date,"Y-m-d");
    }

    public static function dateTimeDB($date,$time)
    {
        $dateArr = explode('/',$date);
        $date = date_create($dateArr[2].'-'.$dateArr[1].'-'.$dateArr[0]);
        return date_format($date,"Y-m-d").' '.$time.':00';
    }

}