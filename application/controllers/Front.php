<?php

class Front extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('user_model');
    }

    public function login() {
        if ($this->input->post('password')) {

            $username = $this->input->post('username');
            $password = $this->input->post('password');

            if ($this->user_model->tryLogin($username, $password)) {

                $user = $this->user_model->getUserByUserName($username);

                $this->session->set_userdata(array(
                    'username' => $user->username,
                    'user_id' => $user->id,
                    'login'=> true
                ));
                //echo 'Here we come';
                redirect('Expense/dashboard');
            } else {
                $this->session->set_flashdata('message', 'Login failure.');
                redirect('Front/login');
            }
        } else {

            $this->load->view('common/login');
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('Front/login');
    }

}
