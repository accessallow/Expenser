<?php

class ExpensePresets extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('preset_model');
        $this->load->model('product_category_model');
    }

    /**
     * Deliver the complete preset dashboard [basically empty dashboard]
     * which will later fetch its data using angularJS
     */
    public function index() {

        $categories = $this->product_category_model->get_all_user_entries(
                $this->session->userdata('username')
        );

        $data = array(
            'categories' => $categories,
            'presets_fetch_url' => site_url('ExpensePresets/getAllPresets'),
            'presets_add_post_url' => site_url('ExpensePresets/addPreset'),
            'preset_update_url' => site_url('ExpensePresets/updatePreset'),
            'preset_delete_url' => site_url('ExpensePresets/deletePreset')
        );
        $this->load_view_embedded('expense/presets_dashboard', $data);
    }

    /**
     * Accept the preset http post request and add the preset entry to
     * the database
     * on success return 0
     * on failure return 1
     */
    public function addPreset() {
        $result = 1;
        if ($this->input->post('amount')) {
            $preset = array(
                'amount' => $this->input->post('amount'),
                'comment' => $this->input->post('comment'),
                'user' => $this->session->userdata('username'),
                'tag' => $this->input->post('tag'),
            );
            $this->preset_model->add_new($preset);
            $result = 0;
        }

        $this->output_json($this, array(
            'result' => $result
        ));
    }

    /**
     * return all the preset entries in JSON Format
     */
    public function getAllPresets() {
        $categories = $this->product_category_model->get_all_user_entries(
                $this->session->userdata('username')
        );
        $category_array = array();
        foreach ($categories as $c) {
            $category_array[$c->id] = $c->product_category_name;
        }
        $username = $this->session->userdata('username');
        $user_presets = $this->preset_model->get_user_presets($username);
        foreach($user_presets as $u){
            $u->category_name = $category_array[$u->tag];
        }
        $this->output_json($this, $user_presets);
    }

    public function getOnePreset($preset_id) {
        $username = $this->session->userdata('username');
        $preset_array = $this->preset_model->get_one_user_preset($username, $preset_id);
        $output = null;
        if (sizeof($preset_array) > 0) {
            $output = $preset_array[0];
        }
        $this->output_json($this, $output);
    }

    /**
     * It will recieve a preset id for deletion purpose
     * @param type $preset_id
     */
    public function deletePreset($preset_id) {
        $this->preset_model->delete($preset_id);
        $this->output_json($this, array(
            'result' => 0
        ));
    }

    /*
     * It will recieve an http post request with 
     * the preset data
     */

    public function updatePreset($preset_id) {
        $result = 1;
        if ($this->input->post('id')) {
            $preset = array(
                'id' => $this->input->post('id'),
                'amount' => $this->input->post('amount'),
                'comment' => $this->input->post('comment'),
                'user' => $this->session->userdata('username'),
                'tag' => $this->input->post('tag'),
            );
            $this->preset_model->update($preset_id, $preset);
            $result = 0;
        }

        $this->output_json($this, array(
            'result' => $result
        ));
    }

}
