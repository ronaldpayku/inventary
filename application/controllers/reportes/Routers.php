<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Routers extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
		$this->load->model("Routers_model");
	}

	public function index() {
		$fecinicio = $this->input->post("fecinicio");
		$fecfin    = $this->input->post("fecfin");

		if ($this->input->post("buscar")) {
			$routers = $this->Routers_model->getRouters(false,"",$fecinicio,$fecfin);
		}
		else{
			$routers = $this->Routers_model->getRouters(false,"");
		}

		$contenido_interno = array(
			"routers"   => $routers,
			"fecinicio" => $fecinicio,
			"fecfin"    => $fecfin
		);

		$contenido_externo = array(
			"contenido" => $this->load->view("admin/reportes/routers",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function search() {

		$buscar 		= $this->input->post("buscar");
		$numeropagina 	= $this->input->post("nropagina");
		$cantidad 		= $this->input->post("cantidad");
		$checkfecha 	= $this->input->post("checkfecha");
		$fecfin 		= $this->input->post("fecfin");
		$fecinicio 		= $this->input->post("fecinicio");
		$inicio 		= ($numeropagina -1)*$cantidad;

		if ($checkfecha == 1) {
			$routers = $this->Routers_model->getRouters(1,$buscar,$inicio,$cantidad,$fecinicio,$fecfin);
			$total   = $this->Routers_model->getRouters(1,$buscar,false,false,$fecinicio,$fecfin);
		}else{
			$routers = $this->Routers_model->getRouters(1,$buscar,$inicio,$cantidad);
			$total   = $this->Routers_model->getRouters(1,$buscar);
		}
		
		$data = array(
			"routers" 		 => $routers,
			"totalregistros" => count($total),
			"cantidad" 		 =>$cantidad
		);

		echo json_encode($data);
	}


	public function exportar() {
		
		$fechainicio 	= $this->input->post("fechainicio");
		$fechafin 		= $this->input->post("fechafin");
		$searchfecha 	= $this->input->post("searchfecha");
		$search 		= $this->input->post("search");
		$tipoarchivo 	= $this->input->post("tipoarchivo");

		if ($tipoarchivo == 1) {
			//Cargamos la librer??a de excel.
	    	$this->load->library('excel');
			$this->excel->setActiveSheetIndex(0);
	        $this->excel->getActiveSheet()->setTitle('routers');
	        //Contador de filas
	        $contador = 3;
	        //Le aplicamos ancho las columnas.
	        /*$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
	        $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
	        $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);*/
	        $this->excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
	        $this->excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
	        $this->excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
	        $this->excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
	        $this->excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
	        $this->excel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
	        $this->excel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
	        $this->excel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);

	        
	        //Le aplicamos negrita a los t??tulos de la cabecera.
	        $this->excel->getActiveSheet()->getStyle("A{$contador}")->getFont()->setBold(true);
	        $this->excel->getActiveSheet()->getStyle("B{$contador}")->getFont()->setBold(true);
	        $this->excel->getActiveSheet()->getStyle("C{$contador}")->getFont()->setBold(true);
	        
	        $this->excel->getActiveSheet()->getStyle("D{$contador}")->getFont()->setBold(true);
	        $this->excel->getActiveSheet()->getStyle("E{$contador}")->getFont()->setBold(true);
	        $this->excel->getActiveSheet()->getStyle("F{$contador}")->getFont()->setBold(true);
	        $this->excel->getActiveSheet()->getStyle("G{$contador}")->getFont()->setBold(true);
	        $this->excel->getActiveSheet()->getStyle("H{$contador}")->getFont()->setBold(true);
	        
	        //
	        $this->excel->getActiveSheet()->getRowDimension(1)->setRowHeight(35);
	        $objDrawing = new PHPExcel_Worksheet_Drawing();
			$objDrawing->setName("logo");
			$objDrawing->setDescription("Tt's my logo");
			$objDrawing->setPath("./assets/images/logo.png");
			$objDrawing->setOffsetY(10);
			$objDrawing->setOffsetX(10);
			$objDrawing->setCoordinates('B1');
			$objDrawing->setWidth(30);
			$objDrawing->setHeight(30);
			$objDrawing->setWorksheet($this->excel->getActiveSheet());

	        //Definimos los t??tulos de la cabecera.
	        // $this->excel->getActiveSheet()->setCellValue("C1", 'Payku Spa');	
	        $this->excel->getActiveSheet()->setCellValue("D1",date("d-m-Y"));	
	        // $this->excel->getActiveSheet()->setCellValue("A{$contador}", 'Nro.');	        
	        $this->excel->getActiveSheet()->setCellValue("B{$contador}", 'Codigo');
	        $this->excel->getActiveSheet()->setCellValue("C{$contador}", 'Fabricante');
	        $this->excel->getActiveSheet()->setCellValue("D{$contador}", 'Modelo');
	        
	        
	        $this->excel->getActiveSheet()->setCellValue("E{$contador}", 'Descripcion');
	        
	        
	        $this->excel->getActiveSheet()->setCellValue("F{$contador}", 'Usuario');
	        $this->excel->getActiveSheet()->setCellValue("G{$contador}", 'Fec. Registro');
	        $this->excel->getActiveSheet()->setCellValue("H{$contador}", 'Estado');

	        if ($fechainicio != "" && $fechafin != "") {
	        	$routers = $this->Routers_model->getRouters(1,$search,$fechainicio,$fechafin);
	        }else{
	        	$routers = $this->Routers_model->getRouters(1,$search,false,false);
	        }

	         //Definimos la data del cuerpo.
	        $i = 1;
	        foreach($routers as $mon){
	        	//Incrementamos una fila m??s, para ir a la siguiente.
	        	$contador++;
	        	//Informacion de las filas de la consulta.
				// $this->excel->getActiveSheet()->setCellValue("A{$contador}", $i);
		        $this->excel->getActiveSheet()->setCellValue("B{$contador}", $mon->codigo);
		        $this->excel->getActiveSheet()->setCellValue("C{$contador}", $mon->fabricante);
		        $this->excel->getActiveSheet()->setCellValue("D{$contador}", $mon->modelo);
		        $this->excel->getActiveSheet()->setCellValue("E{$contador}", $mon->descripcion);
		        $this->excel->getActiveSheet()->setCellValue("F{$contador}", $mon->nombres);
		        $this->excel->getActiveSheet()->setCellValue("G{$contador}", $mon->fecregistro);
		        $status = $mon->estado == 1 ? "Activo":"Inactivo"; 
		        $this->excel->getActiveSheet()->setCellValue("H{$contador}", $status);

		        $i++;
	        }
	        //Le ponemos un nombre al archivo que se va a generar.
	        $archivo = "Listado_de_puntos_de_acceso".date("dmYHis").".xls";
	        header('Content-Type: application/vnd.ms-excel');
	        header('Content-Disposition: attachment;filename="'.$archivo.'"');
	        header('Cache-Control: max-age=0');
	        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
	        //Hacemos una salida al navegador con el archivo Excel.
	        $objWriter->save('php://output');
		}
		else {
			$this->load->library('Pdf');
	        $pdf = new Pdf('L', 'mm', 'A4', true, 'UTF-8', false);
	  
	        $pdf->SetTitle('Reporte de Puntos de Acceso '.date("d-m-Y"));

			$pdf->SetPrintHeader(false);

			// Establecer el tipo de letra
			 
			//Si tienes que imprimir car??cteres ASCII est??ndar, puede utilizar las fuentes b??sicas como
			// Helvetica para reducir el tama??o del archivo.
        	$pdf->SetFont('Helvetica', '', 8, '', true);

			// A??adir una p??gina
			// Este m??todo tiene varias opciones, consulta la documentaci??n para m??s informaci??n.
			$pdf->AddPage("L");

        	//preparamos y maquetamos el contenido a crear
	        $html = '';
	        $html .= "<style type=text/css>";
			$html .= "@import url('https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,900')";
			$html .= "font-family: 'Nunito', sans-serif;font-size : 7px";
	        $html .= "th{color: #fff; background-color: #222}";
	        $html .= "h1{text-align: center;}";
	        $html .="#content {position: relative;}";
	        $html .= "img{top:0; position:absolute; margin-left:500px;}";
	        $html .= "</style>";
	        $html .= '<table width="100%" cellpadding="5" border="0"><thead>';
	        $html .= '<tr>';
	        $html .= '<td width="13%" rowspan="2"></td>';
			$html .= '<td width="13%" rowspan="2"></td>'; 
			$html .= '<td width="13%" rowspan="2"></td>';
	        $html .= '<td width="45%" rowspan="2"><img src="'.base_url("assets/images/logo.png").'" width="95" height="30" ></td>';
	        $html .= '<td width="15%"></td>';
	        $html .= '</tr>';
	        $html .= '<tr>';

	        $html .= '<td>Fecha: '.date("d-m-Y").'</td>';
	        $html .= '</tr>';
	        $html .= '</thead></table>';

	        $html .= '<h2>Reportes de Puntos de Acceso</h2>';
	
	        $html .= '<table width="100%" cellpadding="3" border="1"><thead>';
	        $html .= '<tr>';
            $html .= '<th>Codigo</th>';
            $html .= '<th>Fabricante</th>';
            $html .= '<th>Modelo</th>';
            $html .= '<th>Descripcion</th>';
            $html .= '<th>Ultimo Mant.</th>';
            $html .= '<th>Usuario</th>';
            
            $html .= '<th>Estado</th></tr></thead><tbody>';
    

            if ($fechainicio != "" && $fechafin != "") {
	        	$routers = $this->Routers_model->getRouters(1,$search,$fechainicio,$fechafin);
	        }else{
	        	$routers = $this->Routers_model->getRouters(1,$search,false,false);
	        }
        
	        //provincias es la respuesta de la funci??n getProvinciasSeleccionadas($provincia) del modelo
			foreach ($routers as $mon){
				$html.='<tr>';
				$html.='<td>'.$mon->codigo.'</td>';
				$html.='<td>'.$mon->fabricante.'</td>';
				$html.='<td>'.$mon->modelo.'</td>';
				
				$html.='<td>'.$mon->descripcion.'</td>';
				$html.='<td>'.$mon->ultimo_mante.'</td>';
				
				$html.='<td>'.$mon->nombres.'</td>';
				$status = $mon->estado == 1 ? "Activo":"Inactivo";
				$html.='<td>'.$status.'</td></tr>';
			}

	         $html.='</tbody></table>';
			//  print_r($html);
			//  exit();

			// Imprimimos el texto con writeHTMLCell()
        	$pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 0, $fill = 0, $reseth = true, $align = '', $autopadding = false);

			// ---------------------------------------------------------
			// Cerrar el documento PDF y preparamos la salida
			// Este m??todo tiene varias opciones, consulte la documentaci??n para m??s informaci??n.
        	$nombre_archivo = utf8_decode("Reportes_de_puntos_de_acceso_".date("dmYHis").".pdf");
        	$pdf->Output($nombre_archivo, 'D');
		}
	}
}
