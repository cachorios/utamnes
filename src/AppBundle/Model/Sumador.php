<?php
/**
 * Created by PhpStorm.
 * User: cachorios
 * Date: 19/02/2015
 * Time: 1:57
 */

namespace AppBundle\Model;


class Sumador {
    private $x,$y;

    public function setX($x){
        $this->x = $x;
    }

    public function setY($y){
        $this->y = $y;
    }

    public function sumar(){
        return $this->x+ $this->y;
    }

}