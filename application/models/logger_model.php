<?php

class Logger_model extends CI_Model {

    private $table_name = "linklogs";

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('rb');
    }

    public function get($id = null) {
        $query = null;
        $this->db->order_by('date','desc');
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

    public function getUserEntries($username,$chapter_id=null) {
        $query = null;
        $this->db->order_by("id", "desc");
        $whereArray = array(
            'user' => $username
        );
        if($chapter_id!=null){
            $whereArray['chapter_id']=$chapter_id;
        }
        
        $query = $this->db->get_where($this->table_name,$whereArray);

        return $query->result();
    }

    public function update($id, $entry) {
        $this->db->update($this->table_name, $entry, array(
            'id' => $id
        ));
    }

    public function delete($id) {
        $this->db->delete($this->table_name, array(
            'id' => $id
        ));
    }

    public function count_entries($whereArray) {
        $this->db->where($whereArray);
        $this->db->from($this->table_name);
        $q = $this->db->count_all_results();

        return $q;
    }

    public function addChapter($chapter_name, $userName) {
        $chapter = R::dispense('chapter');
        $chapter->user = $userName;
        $chapter->name = $chapter_name;
        $id = R::store($chapter);
        return $id;
    }

    public function deleteChapter($id) {
        $chapter = R::load('chapter', $id);
        R::trash($chapter);
    }

    public function updateChapter($id, $newChapterName) {
        $chapter = R::load('chapter', $id);
        $chapter->name = $newChapterName;
        //$chapter->user = $newChapter['user'];
        R::store($chapter);
    }

    public function getChapter($id = null) {
        if ($id) {
            $chapter = R::load('chapter', $id);
            return $chapter;
        } else {
            $chapters = R::findAll('chapter');
            return $chapters;
        }
    }

    public function userChapters($user) {
        $this->load->database();
        $query = $this->db->get_where('chapter', array(
            'user' => $user
        ));
        $chapters = $query->result();
        return $chapters;
    }

    public function addEntryToChapter($chapter_id, $entry) {
        $chapter = R::load('chapter', $chapter_id);
        $log_entry = R::dispense($this->table_name);
        $log_entry->link = $entry['link'];
        $log_entry->info = $entry['info'];
        $log_entry->user = $entry['user'];
        $chapter->ownLinklogList[] = $log_entry;
        R::store($chapter);
    }

    public function deleteEntryFromChapter($chapter_id, $entry_id) {
        $chapter = R::load('chapter', $chapter_id);
        unset($chapter->ownLinklogList[$entry_id]);
        R::store($chapter);
    }

    public function chapterExist($chapter_name) {
        return false;
    }

}
