<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Routers extends CI_Controller {

	private $modulo = "Puntos de Acceso";
	public function __construct(){
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
		$this->load->model("Routers_model");
		$this->load->model("Fabricantes_model");
	}

    // funcion principal muestra el listado de los routers
	public function index()	{

		$contenido_interno = array(
			"routers" => $this->Routers_model->getRouters(false,""),
		);
		$contenido_externo = array(
			"contenido" => $this->load->view("admin/routers/list",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function add() {

		$contenido_interno = array(
			"fabricantes" => $this->Fabricantes_model->getFabricantes(),
		);
		$contenido_externo = array(
			"contenido" => $this->load->view("admin/routers/add",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

    // guardar un nuevo router
	public function store() {

		if ($this->input->post("guardar")) {
			$codigo 		= $this->input->post("codigo");
			$modelo 		= $this->input->post("modelo");
			$descripcion 	= $this->input->post("descripcion");
			$fabricante 	= $this->input->post("fabricante");

			$data = array(
				"codigo" 		=> $codigo,
				"modelo" 		=> $modelo,
				"descripcion" 	=> $descripcion,
				"fabricante_id" => $fabricante,
				"estado" 		=> 1,
				"fecregistro" 	=> date("Y-m-d H:i:s"),
				"usuario_id" 	=> $this->session->userdata("id"),
			);

			if ($this->Routers_model->save($data)) {
				$this->backend_lib->savelog($this->modulo,"Inserción de nuevo Punto de acceso con Codigo ".$codigo);
				$this->session->set_flashdata("success", "Los datos fueron guardados exitosamente");
				redirect(base_url()."equipos/routers");
			} else {
				$this->session->set_flashdata("error", "Los datos no fueron guardados");
				redirect(base_url()."equipos/routers/add");
			}
		} else {
			redirect(base_url()."equipos/routers/add");
		}
	}

	public function view() {
		$id = $this->input->post("id");

		$data = array(
			"router" 			=> $this->Routers_model->infoRouter($id),
			"mantenimientos" 	=> $this->Routers_model->getMantenimientos($id)
		);

		$this->load->view("admin/routers/view", $data);
	}

	public function delete($id) {
		$router = $this->Routers_model->getRouter($id);
		$data = array(
			"estado" => "0"
		);

		$this->Routers_model->update($id, $data);
		$this->backend_lib->savelog($this->modulo,"Eliminación del Punto de acceso con Serial ".$router->codigo);
		echo "equipos/routers";
	}

	public function edit($id) {
		$contenido_interno = array(
			"router" 		=> $this->Routers_model->getRouter($id),
			"fabricantes" 	=> $this->Fabricantes_model->getFabricantes(),
		);

		$contenido_externo = array(
			"contenido" => $this->load->view("admin/routers/edit",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function update() {
		$id = $this->input->post("idRouter");
		$codigo 		= $this->input->post("codigo");
		$modelo 		= $this->input->post("modelo");
		$descripcion 	= $this->input->post("descripcion");
		$fabricante 	= $this->input->post("fabricante");

		$estado = 1;

		if ($this->input->post("estado") ) {
			if ($this->input->post("estado") == 2) {
				$estado = 0;
			}
		}

		$data = array(
			"codigo" 		=> $codigo,
			"modelo" 		=> $modelo,
			"descripcion" 	=> $descripcion,
			"fabricante_id" => $fabricante,
			"estado" 		=> $estado,
		);
		if ($this->Routers_model->update($id, $data)) {
			$this->backend_lib->savelog($this->modulo,"Actualización del Punto de acceso con Serial ".$codigo);
			$this->session->set_flashdata("success", "Los datos fueron guardados exitosamente");
			redirect(base_url()."equipos/routers");
		} else {
			$this->session->set_flashdata("error", "Los datos no fueron guardados");
			redirect(base_url()."equipos/routers/edit/".$id);
		}
	}

	public function addmantenimiento(){
		$id 		 = $this->input->post("idequipo");
		$fecha 		 = $this->input->post("fecha");
		$tecnico 	 = $this->input->post("tecnico");
		$descripcion = $this->input->post("descripcion");

		$data = array(
			"router_id" 	=> $id,
			"fecha" 		=> $fecha,
			"tecnico" 		=> $tecnico,
			"descripcion" 	=> $descripcion
		);

		$dataRouter = array(
			"ultimo_mante" => $fecha
		);

		if ($this->Routers_model->saveMante($data)) {
			$router = $this->Routers_model->getRouter($id);
			$this->backend_lib->savelog($this->modulo,"Registro de Mantenimiento al Punto de acceso con Serial ".$router->codigo);
			$this->Routers_model->update($id,$dataRouter);
			$this->session->set_flashdata("success", "Los datos fueron guardados exitosamente");
			redirect(base_url()."equipos/routers");
		}else{
			$this->session->set_flashdata("error", "Los datos no fueron guardados");
			redirect(base_url()."equipos/routers");
		}
 	}

 	public function getMantenimientos(){
 		$id = $this->input->post("idequipo");
 		$mantenimientos = $this->Routers_model->getMantenimientos($id);
 		echo json_encode($mantenimientos);
 	}

}