<?php

// GET Proxy List:
error_reporting(E_ERROR | E_PARSE);
header("Content-Type: text/txt; charset=utf-8");
$url = "https://www.google.com";

$proxyList = array();
$proxyListRunning = array();

getProxies();

function getProxies()
{
    $pList = file_get_contents('https://www.sslproxies.org/');

    $exp = explode('<tbody>', $pList);
    $exp1 = explode('</table>', $exp[1]);
    $proxies = explode('<tr>', $exp1[0]);
    $i = 0;
    foreach ($proxies as $p) {
        $i++;
        $cells = explode('</td>', $p);
        $adress = strip_tags($cells[0]) . ':' . strip_tags($cells[1]);
        if (trim($adress) != ':') {
            $proxyList[] = $adress;
        }

    }
    
    foreach ($proxyList as $proxy) {
        $splited = explode(':', $proxy);
        if ($con = @fsockopen($splited[0], $splited[1], $eroare, $eroare_str, 1)) {
            $proxyListRunning[] = $proxy;
        } else {
        }
    }

    print_r( $proxyListRunning );
}
