<?php

namespace RBSoft\UtilidadBundle\Libs;

class Util
{

    public static function getSlug($cadena, $separador = '-')
    {
        // Código copiado de http://cubiq.org/the-perfect-php-clean-url-generator
        $slug = iconv('UTF-8', 'ASCII//TRANSLIT', $cadena);
        $slug = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $slug);
        $slug = strtolower(trim($slug, $separador));
        $slug = preg_replace("/[\/_|+ -]+/", $separador, $slug);

        return $slug;
    }

    public static function search($array, $key, $value)
    {
        $results = array();

        if (is_array($array)) {
            if (isset($array[$key]) && $array[$key] == $value) {
                $results[] = $array;
            }

            foreach ($array as $subarray) {
                $results = array_merge($results, search($subarray, $key, $value));
            }
        }

        return $results;
    }

    public static function formatCuit($cuit){
        return sprintf("%d-%s/%d",substr($cuit,0,2),
            number_format(substr($cuit,2,8),0,",","."),
            substr($cuit,10,1));
    }
}



