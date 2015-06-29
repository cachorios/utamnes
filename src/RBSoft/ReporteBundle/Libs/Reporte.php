<?php
/**
 * Created by PhpStorm.
 * User: cachorios
 * Date: 28/06/2015
 * Time: 08:54 PM
 */


//namespace RBSoft\ReporteBundle\Libs;



class ReporteMan
{

    protected $driverManager;

    public function __construct()
    {
        define('JAVA_INC_URL', 'http://localhost:8080/JavaBridge/java/Java.inc');

        if (!function_exists('java')) {
            if (ini_get("allow_url_include")) {
                require_once(JAVA_INC_URL);
            } else {
                die ('necesita habilitar allow_url_include en php.ini para poder usar RBSoft/ReporteBundle.');
            }
        }

        java_set_file_encoding("UTF-8");
        set_time_limit(0);

        $class = new JavaClass("java.lang.Class");
        $class->forName("com.mysql.jdbc.Driver");
        $this->driverManager = new JavaClass("java.sql.DriverManager");
    }

    /**
     * Compilar :
     * @param $archivoReporte
     * @return mixed
     *
     */
    protected function compilar($archivoReporte)
    {
        $compileManager = new JavaClass("net.sf.jasperreports.engine.JasperCompileManager");
        $report = $compileManager->compileReport(realpath($archivoReporte));

        return $report;
    }

    /**
     * generarParametro
     * @param array $parametro
     * @return Java
     */
    protected function generarParametro($parametros = array()){
        $params = new Java("java.util.HashMap");

        foreach($parametros as $name => $valor){
            $params->put($name,$valor);
        }
        return $params;
    }

    /**
     * @param string $tipo
     * @param array $conexion
     * @return Java
     */
    protected function getConexion($conexion = array()){
        $db = "";
        $user ="";
        $password="";

        if(count($conexion) > 0){
            switch($conexion['tipo']){
                case "mysql":
                    if(isset($conexion['database']))
                        $db = $conexion['database'];
                    if(isset($conexion['user']))
                        $user = $conexion['user'];
                    if(isset($conexion['password']))
                        $password= $conexion['password'];

                    $strConn = "jdbc:mysql://localhost:3306/$db?user=$user&password=$password";
                    break;
                case "pgsql":
                    break;
            }

            $conn = $this->driverManager->getConnection($strConn);
        }else{
            $conn = new Java("net.sf.jasperreports.engine.JREmptyDataSource");

        }

        return $conn;
    }

    public function procesar($archivoReporte, $parametros, $conexion = array(), $ouput ){
        //Compilar
        $reporte = $this->compilar($archivoReporte);
        $params = $this->generarParametro($parametros);
        $conn = $this->getConexion($conexion);

        $runmanager = new Java("net.sf.jasperreports.engine.JasperRunManager");
        $fillManager = new JavaClass("net.sf.jasperreports.engine.JasperFillManager");
        $jasperPrint = $fillManager->fillReport($reporte, $params, $conn);
        $ouputfile = $ouput;


       $exporter= new Java("net.sf.jasperreports.engine.export.JRPdfExporter");

       $exporter->setParameter(java("net.sf.jasperreports.engine.JRExporterParameter")->JASPER_PRINT,$jasperPrint);
       $exporter->setParameter(java("net.sf.jasperreports.engine.JRExporterParameter")->OUTPUT_FILE_NAME,$ouputfile);
       /*
        $exportManager = new JavaClass("net.sf.jasperreports.engine.JasperExportManager");
        $exportManager->exportReportToPdfFile($jasperPrint, $ouputfile);
        */
    }

}