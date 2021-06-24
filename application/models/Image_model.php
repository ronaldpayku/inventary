<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Image_model extends CI_Model {

    public function insert_image($image) {
        // assign the data to an array
        $data = array(
            'image_id' => $this->input->post('image_id'),
            'image_name' => $this->input->post('image_name'),
            'image_category' => $this->input->post('image_category'),
            'image' => $image
        );
        //insert image to the database
        $this->db->insert('image_data', $data);
        }
        //get images from database
        public function get_images() {
            $this->db->select('*');
            $this->db->order_by('image_id');
            $query = $this->db->get('image_data');
            return $query->result();
        }
}