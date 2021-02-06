<?php

namespace NiagahosterTest\Controller;

use NiagahosterTest\Model\Price;
use NiagahosterTest\Util\Index as Util;

class IndexController
{

    private $twig;

    function __construct($twig)
    {
        $this->twig = $twig;
    }

    function index()
    {
        $prices = new Price();
        $response_prices = $prices->find();
        $max_values = array_map(function ($item) {
            return $item['total_usage'];
        }, $response_prices);

        $keySearch = array_search(max($max_values), $max_values);

        $response_prices = array_map(function ($item, $key) use ($keySearch) {
            $item['best_seller'] = $key == $keySearch;
            $item['discount'] = Util::formatCurrency(intval($item['price']) - intval($item['discount']));

            $item['price'] = Util::formatCurrency(intval($item['price']), "");
            $item['price'] = explode(".", $item['price']);
            $item['price'] = array_map(function ($item, $key) {
                $finalItem = $item;
                if ($key > 0) {
                    $finalItem = "." . $finalItem;
                }

                return html_entity_decode('<strong class="title is-' . ($key > 0 ? '4' : '2') . '">' . $finalItem  . '</strong>');
            }, $item['price'], array_keys($item['price']));
            $item['price'] = join("", $item['price']);

            return $item;
        }, $response_prices, array_keys($response_prices));

        $modules = array(
            array(
                "bcmath", "bz2", "calendar", "Core", "ctype", "curl", "date", "dba", "dom", "exif", "fileinfo",
                "filter", "ftp", "gd", "gettext", "gmp"
            ),
            array(
                "hash", "iconv", "intl", "json", "ldap", "libxml",
                "mbstring", "mysqli", "mysqlnd", "odbc", "openssl", "pcntl", "pcre", "PDO", "pdo_dblib",
                "pdo_mysql"
            ),
            array(
                "PDO_ODBC", "pdo_pgsql", "pdo_sqlite", "pgsql", "Phar", "phpdbg_webhelper",
                "posix", "pspell", "readline", "Reflection", "session", "shmop", "SimpleXML", "soap",
                "sockets", "sodium"
            ),
            array(
                "SPL", "sqlite3", "standard", "sysvmsg", "sysvsem", "sysvshm", "tidy",
                "tokenizer", "wddx", "xml", "xmlreader", "xmlrpc", "xmlwriter", "xsl", "Zend OPcache", "zip"
            )
        );

        $footer_menus = array(
            array("Hubungi kami", "0274-5305505", "24 Jam Nonstop", "", "Jl. Selokan Mataram Monjali", "Karangjati MT I/304", "Sinduadi, Mlati, Sleman", "Yogyakarta 55284"),
            array("Layanan", "Domain", "Shared Hosting", "Cloud VPS Hosting", "Manager VPS Hosting", "Web Builder", "Keamanan SSL / HTTPS", "Jasa Pembuatan Website", "Program Affiliasi"),
            array("Service Hosting", "Hosting Murah", "Hosting Indonesia", "Hosting Singapura SG", "Hosting PHP", "Hosting Wordpress", "Hosting Laravel", "", ""),
            array("Tutorial", "Knowledgebase", "Blog", "Cara Pembayaran"),
            array("Tentang Kami", "Tim Niagahoster", "Kurir", "Events", "Penawaran & Promo Spesial", "Kontak Kami"),
            array("Kenapa Pilih Niagahoster?", "Support Terbaik", "Garansi Harga Termurah", "Domain Gratis Selamanya", "Datacenter Hosting Terbaik", "Review Pelanggan"),
        );

        $payment_methods = array(
            "mandiri", "indomart", "jcb", "linkaja", "ovo", "paypal", "pegadaian", "pos", "shopeepay", "visa"
        );

        echo $this->twig->render('index.twig', ['modules' => $modules, 'payment_methods' => $payment_methods, 'footer_menus' => $footer_menus, 'prices' => $response_prices]);
    }
}
