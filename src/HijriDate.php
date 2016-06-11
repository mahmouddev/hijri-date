<?php

namespace Mahmouddev\HijriDate;

use Carbon\Carbon;

class HijriDate
{
    public function Hijri2Greg($day, $month, $year, $string = false)
    {
        $day   = (int) $day;
        $month = (int) $month;
        $year  = (int) $year;

        //boilerplates for CURL
        $url = 'http://api.aladhan.com/hToG';
        $params = [
            'date' => $day.'-'.$month.'-'.$year,
        ];

        $tuCurl = curl_init();

        curl_setopt($tuCurl, CURLOPT_URL, $url . (strpos($url, '?') === false ? '?' : '') . http_build_query($params));
        if (strpos($url, 'https') === false) {
            curl_setopt($tuCurl, CURLOPT_PORT, 80);
        } else {
            curl_setopt($tuCurl, CURLOPT_PORT, 443);
        }

        curl_setopt($tuCurl, CURLOPT_RETURNTRANSFER, 1);
        $tuData = curl_exec($tuCurl);
        if (curl_errno($tuCurl)) {
            throw new \Exception('Curl Error : ' . curl_error($tuCurl));
        }

        $data          = array();
        $tuData        = json_decode($tuData, true);
        $date['year']  = (int)$tuData['data']['gregorian']['year'];
        $date['month'] = (int)$tuData['data']['gregorian']['month']['number'];
        $date['day']   = (int)$tuData['data']['gregorian']['day'];
        
        if (!$string)
            return $date;
        else
            return     "{$year}-{$month}-{$day}";
    }

    public function Greg2Hijri($day, $month, $year, $string = false)
    {
        $day   = (int) $day;
        $month = (int) $month;
        $year  = (int) $year;

        //boilerplates for CURL
        $url = 'http://api.aladhan.com/gToH';
        $params = [
            'date' => $day.'-'.$month.'-'.$year,
        ];

        $tuCurl = curl_init();

        curl_setopt($tuCurl, CURLOPT_URL, $url . (strpos($url, '?') === false ? '?' : '') . http_build_query($params));
        if (strpos($url, 'https') === false) {
            curl_setopt($tuCurl, CURLOPT_PORT, 80);
        } else {
            curl_setopt($tuCurl, CURLOPT_PORT, 443);
        }

        curl_setopt($tuCurl, CURLOPT_RETURNTRANSFER, 1);
        $tuData = curl_exec($tuCurl);
        if (curl_errno($tuCurl)) {
            throw new \Exception('Curl Error : ' . curl_error($tuCurl));
        }

        $data          = array();
        $tuData        = json_decode($tuData, true);
        $date['year']  = (int)$tuData['data']['hijri']['year'];
        $date['month'] = (int)$tuData['data']['hijri']['month']['number'];
        $date['day']   = (int)$tuData['data']['hijri']['day'];

        if (!$string)
            return $date;
        else
            return     "{$year}-{$month}-{$day}";
    }

    protected function intPart($float)
    {
        if ($float < -0.0000001)
            return ceil($float - 0.0000001);
        else
            return floor($float + 0.0000001);
    }
}