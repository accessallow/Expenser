<?php

Class Shortcut extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        
    }

    public function add_shortcut() {
        if ($this->input->post('amount')&&$this->input->post('comment')&&$this->input->post('type')) {
            $post_date = $this->input->post('date');
//            $date_pieces = explode("-", $post_date);
//            $new_date = $date_pieces[2].'-'.$date_pieces[1].'-'.$date_pieces[0];
            $bill = array(
                'amount' => $this->input->post('amount'),
                'comment' => $this->input->post('comment'),
                'date' => $post_date,
                'user' => $this->session->userdata('username'),
                'tag' => $this->input->post('type'),
            );

            $this->expense_model->add_new($bill);
            $this->set_success_flash("Expense entry saved successfully.");
            redirect('Expense/add_new');
        } else {
            //deliver empty form
            //also send categories to choose from
            $this->load->model('product_category_model');
            $categories = $this->product_category_model->get_all_user_entries(
                    $this->session->userdata('username')
            );
            $data = array(
                'categories' => $categories,
                'back_url' => site_url('Expense/dashboard'),
                'form_submit_url' => site_url('Expense/add_new')
            );

            $this->load_view_embedded('expense/add_bill', $data);
        }
    }

    public function edit_shortcut() {
        if ($this->input->post('entry_id')) {
            $bill_id = $this->input->post('entry_id');
            $bill = array(
                'amount' => $this->input->post('amount'),
                'comment' => $this->input->post('comment'),
                'date' => $this->input->post('date'),
                'user' => $this->session->userdata('username'),
                'tag' => $this->input->post('type'),
            );

            $this->expense_model->update($bill_id, $bill);
            //$this->set_success_flash("Expense entry updated successfully.");
            redirect('Expense/dashboard');
        } else {
            //deliver loaded form
            $bill = $this->expense_model->get_all($id);
            $bill = $bill[0];
            $this->load->model('product_category_model');
            $categories = $this->product_category_model->get_all_user_entries(
                    $this->session->userdata('username')
            );

            $data = array(
                'categories' => $categories,
                'edit' => true,
                'entry' => $bill,
                'back_url' => site_url('Expense/dashboard'),
                'form_submit_url' => site_url('Expense/update/' . $id)
            );
//            $this->load->model("seller_model");
//            $data["sellers"] = $this->seller_model->get_all_entries(null);
            $this->load_view_embedded('expense/add_bill', $data);
        }
    }

    public function delete_shortcut() {
        if ($this->input->post('id')) {
            $this->expense_model->delete($this->input->post('id'));
            redirect('Expense/dashboard');
        } else {
            $entry = $this->expense_model->get_all($id, null);
            $entry = $entry[0];

            $data['delete_form_url'] = site_url('Expense/delete/' . $id);
            $data['confirmation_line'] = "Are you sure want to delete  : <b>$entry->comment - Rs $entry->amount/- </b>?";
            $data['back_url'] = site_url('Expense/dashboard');
            $data['item_id'] = $id;


            $this->load_view_embedded("common/delete", $data);
        }
    }

    public function single() {
        $data['upload_new_link'] = site_url('FileUpload/add_new?attachment_type=5&attachment_id=' . $id);
        $data['uploads_json_fetch_link'] = site_url('FileUpload/get_uploads/' . $id . '/5');
        $data['upload_base'] = base_url('assets/uploads/');

        $this->load->view("template/header", $this->activation_model->get_activation_data());
        $this->load->view("bill/single", $data);
        $this->load->view("template/footer");
    }

}
