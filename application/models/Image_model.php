<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Image_model extends CI_Model {

    public function insert_image($image) {
        // assign the data to an array rp
        $data = array(
            'image_id' => $this->input->post('image_id'),
            'image_name' => $this->input->post('image_name'),
            'image_category' => $this->input->post('image_category'),
            'image' => $image,
            'computadora_id' => $this->input->post('computadora_id'),
            
        );
        //insert image to the database
        $this->db->insert('image_data', $data);
        }
        //get images from database
        public function get_images() {
            $this->db->select('a.*, b.*');
            $this->db->from('computadoras a' );
            $this->db->join('image_data b', 'a.id = b.computadora_id');
            $this->db->where('b.computadora_id ', $this->input->get('id'));
            $this->db->order_by('b.image_id');
            $query = $this->db->get();
            return $query->result();
        }
}