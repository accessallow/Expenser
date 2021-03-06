<?php

class ProductCategoryTags {

    public static $deleted = 0;
    public static $available = 1;

}

class Product_category_model extends CI_Model {

    var $product_category_name = "";
    var $tag = NULL;

    public function __construct() {
        $this->load->database();
    }

    function insert($name, $username) {
        $this->product_category_name = $name;
        $this->tag = ProductCategoryTags::$available;

        $this->db->insert("product_category", array(
            'product_category_name' => $name,
            'user' => $username,
            'tag' => ProductCategoryTags::$available
        ));
    }

    function edit($id, $updated_category) {
        $updated_category->tag = ProductCategoryTags::$available;
        $this->db->update("product_category", $updated_category, array('id' => $id));
    }

    function delete($id) {
        // bhai delete kuch nahi karenge..bas tag ki value "deleted" set kar denge
        // comman sense naam ki bhi koi cheej hoti hai

        $this->db->where('id', $id);
        $this->db->update("product_category", array('tag' => ProductCategoryTags::$deleted));
        // send all the orphans to orphanage
        // the products which were having that died-category are orphan records
        // all orphans products will fall under special category called "uncategorized"
        // programmers too have sentiments...
        // here I took a very big number 1000 as "uncategorized" category
        // if the business grows too much...ho sakta hai hame ye value change karni pade
        // and I hope this happens... :D
        // whatever it is...this logic works
        $product_category_update_query = "update expenses set"
                . " tag=1000 where tag=$id;";
        $this->db->query($product_category_update_query);
    }

    function get_all_entries() {
        $this->db->order_by("product_category_name", "asc");
        $query = $this->db->get_where("product_category", array('tag' => ProductCategoryTags::$available));
        return $query->result();
    }

    function get_all_user_entries($username) {
        $this->db->order_by("product_category_name", "asc");
        $query = $this->db->get_where("product_category", array(
            'tag' => ProductCategoryTags::$available,
            'user' => $username
        ));
        return $query->result();
    }

    function get_one_category($id) {

        $query = $this->db->get_where("product_category", array('id' => $id, 'tag' => ProductCategoryTags::$available));
        $category =  $query->result();
        return $category[0];
    }

    function get_category_name($id) {
        $a = $this->get_one_category($id);
        return $a[0]->product_category_name;
    }

    ///////////////////////////////////////////////////////////
    /////////////// METADATA QUERY FUNCTIONS //////////////////
    ///////////////////////////////////////////////////////////

    function get_total_categories() {
        $q = $this->db->count_all('products');

        return $q;
    }

}
