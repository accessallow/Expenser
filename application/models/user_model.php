<?php

class User_model extends CI_Model {

    private $table_name = "users";

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_all($id = null) {
        $query = null;
        $this->db->order_by("id", "desc");
        if ($id) {
            $query = $this->db->get_where($this->table_name, array(
                'id' => $id
            ));
        } else {
            $query = $this->db->get($this->table_name);
        }
        return $query->result();
    }

    public function getUserByUserName($username) {
        $query = $this->db->get_where($this->table_name, array(
            'username' => $username
        ));
         $userArray = $query->result();
         return $userArray[0];
    }

    public function add_new($user) {
        $this->db->insert($this->table_name, $user);
    }

    public function update($id, $user) {
        $this->db->update($this->table_name, $user, array(
            'id' => $id
        ));
    }

    public function delete($id) {
        $this->db->delete($this->table_name, array(
            'id' => $id
        ));
    }

    public function tryLogin($username, $password) {
        $query = $this->db->get_where($this->table_name,array(
            'username' => $username,
            'password' => $password
        ));
        
//        $user = $query->result();
//        $user = $user[0];
//        echo 'username = '.$user->username.' password = '.$user->password;
//        die();
        if (sizeof($query->result()) == 1) {
            return true;
        } else {
            return false;
        }
        
    }

//functions not being used here : 
    public function sum_bills($field_name, $whereArray) {
        $this->db->select_sum($field_name);
        $query = $this->db->get_where($this->table_name, $whereArray);
        $q = $query->result();
        return $q[0];
    }

    function count_users($whereArray) {
        $this->db->where($whereArray);
        $this->db->from($this->table_name);
        $q = $this->db->count_all_results();

        return $q;
    }

}
