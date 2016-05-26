<?php

class Expense_model extends CI_Model {

    private $table_name = "expenses";

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_all($id = null, $tag = null) {
        $query = null;
        $this->db->order_by("id", "desc");
        if ($id && $tag) {
            $query = $this->db->get_where($this->table_name, array(
                'tag' => $tag,
                'id' => $id
            ));
        } else if ($id) {
            $query = $this->db->get_where($this->table_name, array(
                'id' => $id
            ));
        } else if ($tag) {
            $query = $this->db->get_where($this->table_name, array(
                'tag' => $tag,
            ));
        } else {

            $query = $this->db->get($this->table_name);
        }
        return $query->result();
    }
    
    public function get_all_user_bills($username) {
        $query = null;
        $this->db->order_by("id", "desc");
        
            $query = $this->db->get_where($this->table_name, array(
                'user' => $username,
            ));
          
        return $query->result();
    }
    
    public function datedUserBills($username,$date){
        $query = null;
        $this->db->order_by("id", "desc");
        
            $query = $this->db->get_where($this->table_name, array(
                'date' => $date,
                'user' => $username
            ));
          
        return $query->result();
    }

    public function add_new($bill) {
        $this->db->insert($this->table_name, $bill);
    }

    public function update($id, $bill) {
        $this->db->update($this->table_name, $bill, array(
            'id' => $id
        ));
    }

    public function delete($id) {
        $this->db->delete($this->table_name, array(
            'id' => $id
        ));
    }

    public function sum_bills($field_name, $whereArray) {
        $this->db->select_sum($field_name);
        $query = $this->db->get_where($this->table_name, $whereArray);
        $q = $query->result();
        return $q[0];
    }
    
    public function getWeeklySumReport(){
        $sql = $this->getDateQuery($this->getDates());
        $query = $this->db->query($sql);
        $r = $query->result();
        
        if(sizeof($r)>0){
            $r = $r[0];
        }
        return array(
            'currentWeek'=>$r->weekSum_0!=null ? $r->weekSum_0 : "0",
            'lastWeek'=>$r->weekSum_1!=null ? $r->weekSum_1 : "0",
            'secLastWeek'=>$r->weekSum_2!=null ? $r->weekSum_2 : "0",
            'thirdLastWeek'=>$r->weekSum_3!=null ? $r->weekSum_3 : "0",
            'fourthLastWeek'=>$r->weekSum_4!=null ? $r->weekSum_4 : "0"
        );
    }

    function count_bills($whereArray) {
        $this->db->where($whereArray);
        $this->db->from($this->table_name);
        $q = $this->db->count_all_results();

        return $q;
    }
    
    public function getDates() {
        $date = new DateTime();
        $date2 = new DateTime();

        $mondays = null;
        $sundays = null;
        for ($i = 0; $i <= 5; $i++) {
            $date->setTimestamp(strtotime("Monday -$i weeks"));
            $date2->setTimestamp(strtotime("Sunday -$i weeks"));

            $mondays[$i] = date_format($date, 'Y-m-d');
            $sundays[$i] = date_format($date2, 'Y-m-d');
        }
        
        //echo 'Mondays<br/><pre>';
        //print_r($mondays);
        //echo '<br/>Sundays<pre>';
        //print_r($sundays);

        $date_range = null;

        for ($a = 0; $a < 5; $a++) {
            $date_range[$a]['lower'] = $mondays[$a+1];
            $date_range[$a]['upper'] = $sundays[$a];
        }

        //print_r($date_range);
        //echo "<br/><pre><code>";
        //echo $this->getDateQuery($date_range);
        return $date_range;
    }
    
    public function getDateQuery($date_range) {
        $sql = "select ";
        for ($a = 0; $a < sizeof($date_range); $a++) {
            $date_lower = $date_range[$a]['lower'];
            $date_upper = $date_range[$a]['upper'];

            $queryPart = "(select sum(amount) from expenses 
            where 
            str_to_date(date,'%Y-%m-%d') >= str_to_date('$date_lower','%Y-%m-%d')
            and
            str_to_date(date,'%Y-%m-%d') <= str_to_date('$date_upper','%Y-%m-%d')
            ) as weekSum_$a";
            
            if($a!=  sizeof($date_range)-1){
                $queryPart = $queryPart.',';
            }
            
            $sql = $sql.$queryPart;
        }
        $sql = $sql." from dual";
        
        return $sql;
    }
    
    

}
