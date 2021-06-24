<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Image_model_monitor extends CI_Model {

    public function insert_image($image_monitor) {
        // assign the data to an array
        $data = array(
            'image_id_monitor' => $this->input->post('image_id_monitor'),
            'image_name_monitor' => $this->input->post('image_name_monitor'),
            'image_category_monitor' => $this->input->post('image_category_monitor'),
            'image_monitor' => $image_monitor
        );
        //insert image to the database
        $this->db->insert('image_data_monitor', $data);
    }
        //get images from database
        public function get_images() {
            $this->db->select('*');
            $this->db->order_by('image_id_monitor');
            $query = $this->db->get('image_data_monitor');
            return $query->result();
        }
}