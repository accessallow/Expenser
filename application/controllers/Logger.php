<?php

Class Logger extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('logger_model');
    }

    public function add() {
        if ($this->input->post('link') && $this->input->post('info') && $this->input->post('chapter_id')) {
            $link = $this->input->post('link');
            $info = $this->input->post('info');
            $chapter_id = $this->input->post('chapter_id');

            $this->logger_model->addEntryToChapter($chapter_id, array(
                'link' => $link,
                'info' => $info,
                'user' => $this->session->userdata('username')
            ));
            $this->set_success_flash("Entry saved!");
            redirect('Logger/add');
        } else {
            $this->index();
        }
    }

    public function editEntry($id = null) {
        if ($this->input->post('link') && $this->input->post('info') && $this->input->post('id')) {
            $link = $this->input->post('link');
            $info = $this->input->post('info');
            $chapter_id = $this->input->post('chapter_id');
            $id = $this->input->post('id');

            $this->logger_model->update($id, array(
                'link' => $link,
                'info' => $info,
                'chapter_id' => $chapter_id
            ));

            $this->set_success_flash("Entry updated!");
            redirect('Logger');
        } else {
            $log_entry = $this->logger_model->get($id);
            $this->load_view_embedded("logger/edit", array(
                'log_entry' => $log_entry[0],
                'form_submit_url' => site_url('Logger/editEntry'),
                'back_url' => site_url('Logger'),
                'chapter_json_fetch_link' => site_url('Logger/chapter_json'),
                'chapters' => $this->logger_model->userChapters($this->session->userdata('username'))
            ));
        }
    }

    public function deleteEntry($id = null) {
        if ($this->input->post('id')) {
            $this->logger_model->delete($this->input->post('id'));
            $this->set_success_flash("Entry deleted!");
            redirect('Logger');
        } else {
            $data = array(
                'delete_form_url' => site_url('Logger/deleteEntry'),
                'confirmation_line' => 'Are you sure want to delete this Log Entry?',
                'back_url' => site_url('Logger'),
                'item_id' => $id
            );
            $this->load_view_embedded("common/delete", $data);
        }
    }

    public function index($chapter_id = null) {
        //$entries = $this->logger_model->get();
        $append_string="";
        $chapter_name = "All logs";
        if($chapter_id!=null){
            $append_string="/".$chapter_id;
            $chapter = $this->logger_model->getChapter($chapter_id);
            $chapter_name= $chapter->name;
        }
        if($chapter_id==null){
            $chapter_id=0;
        }
        $this->load_view_embedded("logger/dashboard1", array(
            'json_fetch_link' => site_url('Logger/index_json'.$append_string),
            'chapter_json_fetch_link' => site_url('Logger/chapter_json'),
            'add_entry_link' => site_url('Logger/add'),
            'add_chapter_link' => site_url('Logger/addChapter'),
            'chapter_edit_url' => site_url('Logger/editChapter'),
            'chapter_delete_url' => site_url('Logger/deleteChapter'),
            'entry_edit_url' => site_url('Logger/editEntry'),
            'entry_delete_url' => site_url('Logger/deleteEntry'),
            'chapter_name'=> $chapter_name,
            'chapter_id'=> $chapter_id
        ));
    }

    public function index_json($chapter_id = null) {
        $entries = $this->logger_model->getUserEntries($this->session->userdata('username'), $chapter_id);

        $this->output->set_content_type('application/json')
                ->set_output(json_encode($entries));
    }

    public function chapter_json() {
        $chapters = $this->logger_model->userChapters($this->session->userdata('username'));
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($chapters));
    }

    public function addChapter() {
        if ($this->input->post('chapter_name')) {
            $chapter_name = $this->input->post('chapter_name');
            if ($this->logger_model->chapterExist() == false) {
                //then only we add chapter
                $this->logger_model->addChapter($chapter_name, $this->session->userdata('username'));
                $this->set_success_flash('Chapter added successfully!');
            } else {
                $this->set_error_flash('Chapter with this name already exist!');
            }
            redirect('Logger');
        } else {
            //deliver chapter form
            $this->index();
        }
    }

    public function editChapter($chapter_id) {
        if ($this->input->post('chapter_name') && $this->input->post('chapter_id')) {
            $chapter_name = $this->input->post('chapter_name');
            $chapter_id = $this->input->post('chapter_id');

            if ($this->logger_model->chapterExist($chapter_name) == false) {
                $this->logger_model->updateChapter($chapter_id, $chapter_name);
                $this->set_success_flash("Chapter name updated!");
            } else {
                $this->set_error_flash("Chapter with this name already exist!!!");
            }
            redirect('Logger');
        } else {
            $this->load_view_embedded('logger/editChapter', array(
                'form_submit_url' => site_url('Logger/editChapter'),
                'back_url' => site_url('Logger'),
                'chapter' => $this->logger_model->getChapter($chapter_id)
            ));
        }
    }

    public function deleteChapter($chapter_id) {
        if ($this->input->post('id')) {

            $chapter_id = $this->input->post('id');
            $this->logger_model->deleteChapter($chapter_id);
            $this->set_success_flash("Chapter has been deleted!");
            redirect('Logger');
        } else {
            $chapter = $this->logger_model->getChapter($chapter_id);
            $this->load_view_embedded('common/delete', array(
                'delete_form_url' => site_url('Logger/deleteChapter'),
                'back_url' => site_url('Logger'),
                'item_id' => $chapter->id,
                'confirmation_line' => 'Are you sure want to delete this chapter? : ' . $chapter->name
            ));
        }
    }

}
