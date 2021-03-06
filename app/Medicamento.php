<?php

namespace App;

use Mpociot\Firebase\SyncsWithFirebase;
use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model
{
    // use SyncsWithFirebase;

	/**
    * @param $table, nombre de la tabla de la base de datos
    */
    protected $table = 'tb_medicamentos';

    /**
    * @param $primaryKey, nombre del id de la tabla de la base de datos
    */
    protected $primaryKey = 'id_medicamento';
    
    /**
    * @param $timestamps, especifica si se requiere fechas en la tabla.
    */
    public	$timestamps	=	false;

    /**
    * Metodo que realiza una busqueda del medicamento
    * @param $query 
    * @param String nombre, nombre comercial del medicamento
    * @return $void
    */
    public function scopeBuscarMedicamento($query, $medicamento)
    {
    	if (trim($medicamento) != "") {
    		 $query->where(\DB::raw("CONCAT(nombre_comercial, ' ', nombre_compuesto, ' ', num_etiqueta, ' ', num_folio, ' ', anio_caducidad, ' ', mes_caducidad, ' ', dosis, ' ', solucion_tableta, ' ', tipo_contenido)"), 'LIKE', "%$medicamento%");
    	}
    }

    
    public function scopeBuscarMedicamentoSalida($query, $medicamento)
    {
        if (trim($medicamento) != "") {
            $query->where('nombre_comercial', 'LIKE', "%$medicamento%")->where('estatus', 'existencia');
        }

        //id_medicamento, nombre_comercial, nombre_compuesto, num_etiqueta, num_folio, anio_caducidad, mes_caducidad, dosis, solucion_tableta, tipo_contenido, fecha_registro, estatus, tipo_bloqueo, dia_bloqueo, dia_desbloqueo
    }


    
    /**
    * Metodo que obtiene los medicamentos para la API
    * @return Array (JSON)
    */
    public static function medicamentosApi()
    {
       $medicamentos  = \DB::select('SELECT id_medicamento, nombre_comercial, nombre_compuesto, solucion_tableta, tipo_contenido, dosis   
        FROM tb_medicamentos');

       return $medicamentos;
    }

    public static function medicamentosInventariomos()
    {
        $medicamentosDonador  = \DB::select("select * from tb_medicamentos where estatus='existencia' order by nombre_comercial");
        return $medicamentosDonador;
    }

    public static function medicamentosDelDonador($idDonador)
    {
        $medicamentosDonador  = \DB::select('select tb_medicamentos.* from tb_entrada_medicamento,tb_medicamentos where tb_medicamentos.id_medicamento=tb_entrada_medicamento.tb_medicamentos_id_medicamento and tb_donadores_id_donador ='.$idDonador);
        return $medicamentosDonador;
    }

    public static function obtineMedicamentoRequeridos(){
        $medicamentosRequeridos = \DB::select('select * from tb_medicamentos where tb_medicamentos.estatus=\'requerido\' order by nombre_comercial');
        return $medicamentosRequeridos;
    }
    public static function obtineMedicamentoRequeridosFecha($fechaInicial,$fechaFinal){
        $medicamentosRequeridos = \DB::select("select * from tb_medicamentos where tb_medicamentos.estatus='requerido' and tb_medicamentos.fecha_registro between '".$fechaInicial."' and '".$fechaFinal."' order by nombre_comercial");
        return $medicamentosRequeridos;
    }
    public static function medicamentosVencidos(){
        $medicamentos = \DB::select('select * from tb_medicamentos where mes_caducidad < MONTH(NOW())  and anio_caducidad < YEAR(NOW()) order by nombre_comercial');
        return $medicamentos;
    }
     public static function medicamentosVencidosFecha($fechaInicial,$fechaFinal){
        $medicamentos = \DB::select("select * from tb_medicamentos where mes_caducidad <= MONTH(NOW())  and anio_caducidad < YEAR(NOW()) and    ((mes_caducidad between DATE_FORMAT('".$fechaInicial."',\"%m\") and DATE_FORMAT('".$fechaFinal."',\"%m\") and  (anio_caducidad between DATE_FORMAT('".$fechaInicial."',\"%Y\") and DATE_FORMAT('".$fechaFinal."',\"%Y\")) )) order by nombre_comercial ");
        return $medicamentos;
    }

    public static function salidasMedicamentos(){
        $medicamentos = \DB::select('select * from tb_salida_medicamento,tb_medicamentos,tb_beneficiarios where tb_medicamentos.id_medicamento = tb_salida_medicamento.tb_medicamentos_id_medicamento and tb_beneficiarios.id_beneficiario=tb_salida_medicamento.tb_beneficiarios_id_beneficiario order by nombre_comercial');
        return $medicamentos;
    }
    public static function salidasMedicamentosFecha($fechaInicial,$fechaFinal){
        $medicamentos = \DB::select("select * from tb_salida_medicamento,tb_medicamentos,tb_beneficiarios where tb_medicamentos.id_medicamento = tb_salida_medicamento.tb_medicamentos_id_medicamento and tb_beneficiarios.id_beneficiario=tb_salida_medicamento.tb_beneficiarios_id_beneficiario  and (tb_salida_medicamento.fecha_salida_medicamento between '".$fechaInicial."' and '".$fechaFinal."') order by nombre_comercial");
        return $medicamentos;
    }

    public static function entradaMedicamentos(){

        $medicamentos = \DB::select('select * from tb_entrada_medicamento,tb_medicamentos,tb_donadores where tb_medicamentos.id_medicamento = tb_entrada_medicamento.tb_medicamentos_id_medicamento and tb_donadores.id_donador = tb_entrada_medicamento.tb_donadores_id_donador order by nombre_comercial ');
        return $medicamentos;
    }

    public static function entradaMedicamentosFecha($fechaInicial,$fechaFinal){

        $medicamentos = \DB::select("select * from tb_entrada_medicamento,tb_medicamentos,tb_donadores where tb_medicamentos.id_medicamento = tb_entrada_medicamento.tb_medicamentos_id_medicamento and tb_donadores.id_donador = tb_entrada_medicamento.tb_donadores_id_donador and (tb_entrada_medicamento.fecha_entrada between '".$fechaInicial."' and '".$fechaFinal."')order by nombre_comercial");
        return $medicamentos;
    }
    public static function medicamentosProximosVencer(){
        $medicamentos = \DB::select('select *  from tb_medicamentos where anio_caducidad = YEAR(NOW()) and mes_caducidad= MONTH(NOW()) order by nombre_comercial');
        return $medicamentos;
    }


    public static function medicamentosTotales(){
        $medicamentos = \DB::select("select  *, count(estatus) as cantidad from tb_medicamentos where nombre_comercial=nombre_comercial and estatus='existencia' group by nombre_comercial order by nombre_comercial");
        return $medicamentos;
    }


    public static function obtenerTodosLosMedicamentos()
    {
        $medicamentos = \DB::select('SELECT * FROM tb_medicamentos WHERE estatus = \'existencia\' AND tipo_bloqueo = \'desbloqueado\'');

        return $medicamentos;

    }



}
