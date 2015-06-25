<?php
function descargarArchivo($fichero)
{
    $basefichero = basename($fichero);
    header("Content-Type: application/octet-stream");
    header("Content-Length: ".filesize($fichero));
    header("Content-Disposition:attachement;filename=".$basefichero."");
    readfile($fichero);
}

$filename = "BoletaPago";

require_once("http://localhost:8080/JavaBridge/java/Java.inc");

require("../php-jru/php-jru.php");

$jru = new PJRU();

$reporte = "F:/web/utamnes/reportes/boleta_bco.jasper";

$salidaReporte = "F:/web/utamnes/reportes/".$filename;

$parametro = new java("java.util.HashMap");
$parametro->put("id",2);

$conn = new JdbcConnection("com.mysql.jdbc.Driver","jdbc:mysql://localhost/utamnes","root","7219");

$jru->runReportToPdfFile($reporte,$salidaReporte,$parametro, $conn);

if(file_exists($salidaReporte))
{
    descargarArchivo($filename);
    if(file_exists($salidaReporte)){
        if(unlink($salidaReporte)){
        }
    }

}


