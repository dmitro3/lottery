<?php

namespace crawlmodule\loterie\XoSoSources;

use crawlmodule\loterie\Contracts\IXoSoSource;

abstract class AXoSoSource implements IXoSoSource
{
    private $date;
    public function __construct($date)
    {
        $this->date = $date;
    }
    protected function getTimeString()
    {
        $day = $this->date->day;
        $day = $day < 10 ? '0' . $day : $day;

        $month = $this->date->month;
        $month = $month < 10 ? '0' . $month : $month;
        return  $day . '-' . $month . '-' . $this->date->year;
    }
    protected function urlExists($url)
    {
        $headers = @get_headers($url);
        if (!is_array($headers)) {
            return false;
        }
        return stripos($headers[0], "200 OK") ? true : false;
    }
    protected function execCurl($url, $type = 'GET', $data = null, $headers = [])
    {
        $curl = curl_init();
        $params = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 100,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $type,
            CURLOPT_FOLLOWLOCATION => 0,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
        );
        if ($type == 'POST' && is_string($data)) {
            $params[CURLOPT_POSTFIELDS] = $data;
        }
        if ($type == 'POST' && is_array($data)) {
            $params[CURLOPT_POSTFIELDS] = http_build_query($data);
        }
        if ($type == 'GET' && is_array($data)) {
            $params[CURLOPT_URL] = $url . '?' . http_build_query($data);
        }
        if ($headers) {
            $params[CURLOPT_HTTPHEADER] = $headers;
        }
        curl_setopt_array($curl, $params);
        $res = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $err = curl_error($curl);
        curl_close($curl);
        if (!empty($err)) {
            return $err;
        }
        return $res;
    }
    public function getResults()
    {
        $link = $this->getLinkResult();
        if ($this->urlExists($link)) {
            @include_once(__DIR__ . '/../Libs/simple_html_dom.php');
            if ($result = $this->crawl($link)) {
                return $result;
            }
        }
        return false;
    }
    protected abstract function crawl($link);
}
