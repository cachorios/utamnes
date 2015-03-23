<?php
/**
 * Created by PhpStorm.
 * User: cachorios
 * Date: 19/03/2015
 * Time: 0:07
 */

$prefijos = array("Lar", "LAR", "LAr", "L_A_R", "L-A-R", "EA", "eA", "Taragui", "MunDo");

echo $prefijos[rand(0, count($prefijos) - 1)].substr(microtime(), 0, -5)."\n";
echo microtime().' - '.substr(microtime(), 0, -5)."\n";
echo $prefijos[rand(0, count($prefijos) - 1)].substr(microtime(), 0, -5)."\n";

