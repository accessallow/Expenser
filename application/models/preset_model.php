<?php

class Preset_model extends CI_Model {

    var $table_name = 'shortcuts';
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function add_new($preset) {
        $this->db->insert($this->table_name, $preset);
    }

    public function update($id, $preset) {
        $this->db->update($this->table_name, $preset, array(
            'id' => $id
        ));
    }

    public function delete($id) {
        $this->db->delete($this->table_name, array(
            'id' => $id
        ));
    }

    public function get_user_presets($username){
        $query = $this->db->get_where($this->table_name,array(
            'user' => $username
        ));
        return $query->result();
    }
    
    public function get_one_user_preset($username,$preset_id){
        $query = $this->db->get_where($this->table_name,array(
            'user' => $username,
            'id' => $preset_id
        ));
        
        $preset_array =  $query->result();
        if(sizeof($preset_array)>0){
            return $preset_array[0];
        }else return null;
    }
}
