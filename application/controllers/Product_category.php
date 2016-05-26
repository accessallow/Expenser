<?php

class Product_category extends MY_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model("product_category_model");
    }

    public function index() {

        $data["categories"] = $this->product_category_model->get_all_entries();
        $data['json_fetch_link'] = site_url('Product_category/index_json');
        $data['categories'] = $this->product_category_model->get_all_user_entries(
                $this->session->userdata('username')
        );

        $this->load_view_embedded("product/category/list_all_categories", $data);
    }

    public function load_view_embedded($view, $data = null) {
        $this->load->view("template/header");
        $this->load->view($view, $data);
        $this->load->view("template/footer");
    }

    public function index_json() {

        $categories = $this->product_category_model->get_all_entries();
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($categories));
    }

    public function add_new() {
        if ($this->input->post('product_category_name')) {



            $this->product_category_model->insert(
                    $this->input->post("product_category_name"), 
                    $this->session->userdata('username')
            );

            $this->session->set_flashdata('message', 'Category saved.');
            redirect('Product_category');
        } else {
            $this->load_view_embedded("product/category/add_new");
        }
    }

    public function delete($id = NULL) {
        if ($this->input->post('id')) {

            $this->product_category_model->delete($this->input->post('id'));
            $this->index();
        } else {

            $ourCategory = $this->product_category_model->get_one_category($id);
            $ourCategory = $ourCategory[0];

            $data = array(
                'confirmation_line' => 'Are you sure want to delete this category ' . $ourCategory->product_category_name,
                'delete_form_url' => site_url() . '/Product_category/delete',
                'back_url' => site_url() . '/Product_category/',
                'item_id' => $ourCategory->id
            );


            $this->load_view_embedded("common/delete", $data);
        }
    }

    public function edit($id = NULL) {
        if ($id) {

            $data['category'] = $this->product_category_model->get_one_category($id);

            $this->load_view_embedded("product/category/edit", $data);
        } else if ($this->input->post('product_category_name')) {

            $id = $this->input->post('id');

            $category = $this->product_category_model->get_one_category($id);
            $category->product_category_name = $this->input->post("product_category_name");
            $category->user = $this->session->userdata('username');
            
            $this->product_category_model->edit($this->input->post("id"),$category);
            
            $this->index();
        } else {

            $this->load_view_embedded("product/category/edit");
        }
    }

}
