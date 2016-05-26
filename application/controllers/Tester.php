<?php

Class Tester extends MY_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->library('unit_test');
        $this->load->model('logger_model');
    }
    public function index(){
        $this->insertTest();
        echo $this->unit->report();
    }
    public function insertTest(){
        $id = $this->logger_model->addChapter('chapter1','user1');
        $test_name = 'Chapter Insert Test';
        $notes = 'This test add a chapter into user1\'s account';
        return $this->unit->run($id,'is_int',$test_name,$notes);
    }
    public function getChapterTest(){
        
    }
}
