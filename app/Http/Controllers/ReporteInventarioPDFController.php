<?php
namespace App\Http\Controllers;

use App\Medicamento;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;

class ReporteInventarioPDFController extends Controller
{
    /**
    * Determina si el usuario esta autenticado en la aplicacion.
    *
    * @return void
    */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function imprimirReporte(Request $request){
    	//return view('reportesPDF.reporteInventario');
        $fechaInicial = $request->get('fechaIni');
        $fechaFinal = $request->get('fechaFin');

        
    	$medicamentos = Medicamento::all();
    	$vista =view('reportesPDF.reporteInventario')->with('medicamentos', $medicamentos);
    	
    	ob_start();
    	$vista;
        $content = ob_get_clean();
        $html2 = base_path('/vendor/libraryPDF/html2pdf/html2pdf.class.php');
        include_once($html2);

        try {
            $html2pdf = new \HTML2PDF('P', 'A4', 'es', true, 'UTF-8',5);
            $html2pdf->pdf->SetTitle('Inventario FARMADIF');
            $html2pdf->pdf->SetDisplayMode('fullpage');
            $html2pdf->WriteHTML($vista);
            $html2pdf->Output('inventarioTotal.pdf');

            ob_flush();
            ob_end_clean();
        }
        catch (HTML2PDF_exception $e) {
            echo $e;
            exit;
        }
		

    }
    
}