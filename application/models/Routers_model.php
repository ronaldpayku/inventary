<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Routers_model extends CI_Model {

    // obtiene todos los datos desde db
	public function getRouters($estado = false,$search,$fechainicio = false, $fechafinal =false){
		$this->db->select("r.*,f.nombre as fabricante,u.nombres");
		$this->db->from("routers r");
		$this->db->join("fabricantes f","r.fabricante_id = f.id");
		$this->db->join("usuarios u","r.usuario_id = u.id");
		if ($fechainicio !== false && $fechafinal !== false) {
			$this->db->where("r.fecregistro >=", $fechainicio." "."00:00:00");
			$this->db->where("r.fecregistro <=", $fechafinal." "."23:59:59");

		}
		if ($estado != false) {
			$this->db->where("r.estado",1);
		}
		$this->db->like("CONCAT(r.codigo, '', f.nombre, '',r.modelo,'',u.nombres)",$search);
		$resultados = $this->db->get();
		return $resultados->result();
	}

	public function infoRouter($id){
		$this->db->select("r.*, fa.nombre as fabricante");
		$this->db->from("routers r");
		$this->db->join("fabricantes fa","r.fabricante_id = fa.id");
		$this->db->where("r.id", $id);
		$resultados = $this->db->get();
		return $resultados->row();
	}

	public function save($data){
		return $this->db->insert("routers",$data);
	}

	public function getRouter($id){
		$this->db->where("id", $id);
		$resultados = $this->db->get("routers");
		return $resultados->row();
	}

	public function update($id,$data){
		$this->db->where("id", $id);
		return $this->db->update("routers",$data);
	}

	public function saveMante($data){
		return $this->db->insert("routers_mantenimientos",$data);
	}

	public function getMantenimientos($id){
		
		$this->db->where("router_id",$id);
		
		$resultados = $this->db->get("routers_mantenimientos");
		return $resultados->result();
	}


}