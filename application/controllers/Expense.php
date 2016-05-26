<?php

class Expense extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('preset_model');
        $this->load->model('expense_model');
    }

    public function index() {
        $this->dashboard();
    }

    public function todayTotal() {
        date_default_timezone_set('UTC');
        $date = date("Y-m-d");
        $sum = $this->expense_model->sum_bills('amount', array(
            'user' => $this->session->userdata('username'),
            'date' => $date
        ));

        return $sum->amount == null ? '0' : $sum->amount;
    }

    public function allTotal() {
        $sum = $this->expense_model->sum_bills('amount', array(
            'user' => $this->session->userdata('username'),
        ));

        return $sum->amount == null ? '0' : $sum->amount;
    }

    public function password() {
        //getting the session stored user 
        $user_id = $this->session->userdata('user_id');
        //echo 'user_id ='.$user_id.' ';
        $data = null;
        if ($this->input->post('current_pwd') && $this->input->post('new_pwd')) {

            $current_pwd = $this->input->post('current_pwd');
            $new_pwd = $this->input->post('new_pwd');

            //echo 'Here';

            $user = $this->user_model->get_all($user_id);
            $user = $user[0];
            //echo $user->username.'  '.$user->password.' currnet pwd = '.$current_pwd.' new pwd = '.$new_pwd;

            if ($user != null && strcmp($current_pwd, $user->password) == 0) {
                $user->password = $new_pwd;
                $this->user_model->update($user_id, $user);
                $this->session->set_flashdata('message', 'Password changed.');
                $this->session->set_flashdata('glyph', 'glyphicon-ok');
                $this->session->set_flashdata('alert', 'success');
            } else {
                $this->session->set_flashdata('message', 'Password not changed.');
                $this->session->set_flashdata('glyph', 'glyphicon-remove');
                $this->session->set_flashdata('alert', 'danger');
            }
            redirect('Expense/password');
        }

        $data['form_submit_url'] = site_url('Expense/password');

        $data['user_id'] = $user_id;

        $this->load->view('template/header');
        $this->load->view('common/change_password', $data);
        $this->load->view('template/footer');
    }

    public function add_new() {
        if ($this->input->post('amount')) {
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

    public function update($id) {
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

    public function dashboard() {
        $username = $this->session->userdata('username');
        $bills = $this->expense_model->get_all_user_bills($username);
        $this->load->model('product_category_model');

        $data = array(
            'categories' => $this->product_category_model->get_all_user_entries($username),
            'bills' => $bills,
            'addButtonLabel' => 'Add new',
            'analyseButtonLabel' => 'Analyze',
            'analyze_link' => site_url('Analyzer/dashboard'),
            'add_link' => site_url('Expense/add_new'),
            'label' => 'Expense records',
            'todayTotal' => $this->todayTotal(),
            'allTotal' => $this->allTotal(),
            'presets' => $this->preset_model->get_user_presets($username),
            'todayExpenseFetchUrl' => site_url('Expense/getTodayExpensesJson'),
            'hitPresetUrl' => site_url('Expense/hitPreset')
        );
        $this->load_view_embedded("expense/dashboard", $data);
    }

    public function delete($id) {
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

    public function single($id) {
        $data['upload_new_link'] = site_url('FileUpload/add_new?attachment_type=5&attachment_id=' . $id);
        $data['uploads_json_fetch_link'] = site_url('FileUpload/get_uploads/' . $id . '/5');
        $data['upload_base'] = base_url('assets/uploads/');

        $this->load->view("template/header", $this->activation_model->get_activation_data());
        $this->load->view("bill/single", $data);
        $this->load->view("template/footer");
    }

    public function getTodayExpensesJson() {
        $username = $this->session->userdata('username');
        
        $bills = $this->expense_model->datedUserBills($username, $this->todaysDate());
        $weekReport = $this->expense_model->getWeeklySumReport();
        
        $data = array(
            'bills' => $bills,
            'weekReport' => $weekReport
        );
        
        $this->output_json($this, $data);
    }

    public function hitPreset($preset_id) {
        if ($preset_id) {
            $username = $this->session->userdata('username');
            $preset = $this->preset_model->get_one_user_preset($username, $preset_id);

            $bill = array(
                'amount' => $preset->amount,
                'comment' => $preset->comment,
                'date' => $this->todaysDate(),
                'user' => $this->session->userdata('username'),
                'tag' => $preset->tag
            );

            $this->expense_model->add_new($bill);
        }
    }

    public function exp() {

        //$date = strtotime("Monday last week");
        $date = new DateTime();
        for ($i = 0; $i <= 5; $i++) {
            $date->setTimestamp(strtotime("Monday -$i weeks"));
            echo date_format($date, 'Y-m-d') . "<br/>";
        }
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
        $dates = array(
            'this_week_monday' => null
        );
        echo 'Mondays<br/><pre>';
        print_r($mondays);
        echo '<br/>Sundays<pre>';
        print_r($sundays);

        $date_range = null;

        for ($a = 0; $a < 5; $a++) {
            $date_range[$a]['lower'] = $mondays[$a+1];
            $date_range[$a]['upper'] = $sundays[$a];
        }

        print_r($date_range);
        echo "<br/><pre><code>";
        echo $this->getDateQuery($date_range);
    }

    public function allEntries(){
         $username = $this->session->userdata('username');
        $bills = $this->expense_model->get_all_user_bills($username);
        $this->load->model('product_category_model');

        $data = array(
            'categories' => $this->product_category_model->get_all_user_entries($username),
            'bills' => $bills,
            'addButtonLabel' => 'Add new',
            'analyseButtonLabel' => 'Analyze',
            'analyze_link' => site_url('Analyzer/dashboard'),
            'add_link' => site_url('Expense/add_new'),
            'label' => 'Expense records',
            'todayTotal' => $this->todayTotal(),
            'allTotal' => $this->allTotal(),
            'presets' => $this->preset_model->get_user_presets($username),
            'todayExpenseFetchUrl' => site_url('Expense/getTodayExpensesJson'),
            'hitPresetUrl' => site_url('Expense/hitPreset')
        );
        $this->load_view_embedded("expense/dashboard", $data);
    }
}
