<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frontend extends CI_Controller {

    public function __construct()
	{
		parent::__construct();

		$this->load->model('Common_model');
        
	}

	public function index()
	{
		$data['products'] = "Products";

		$query = $this->Common_model->get_record('categories');
        $data['categories'] = $query->result_array();

		$this->load->view('list', $data);
	}

	public function ajax_get_product_list() {
		$category_id = $this->input->get('category_id');
	
		// Properly create a WHERE clause array
		$where = [];
		if (!empty($category_id)) {
			$where = ['category_id' => $category_id];
		}
	
		$query = $this->Common_model->get_record('products', $where);
	
		$data['product_data'] = $query->result_array();
	
		echo $this->load->view('ajax_get_products_list', $data, true);
	}
	
	public function product_buy($id){
		$where = array('id' => $id);
        $data['productData'] = $this->Common_model->get_data('products', $where);

		$this->load->view('product/product_buy', $data);
	}

	public function add_to_cart($id) {
		$where = array('id' => $id);
        $data['productData'] = $this->Common_model->get_data('products', $where);
		$whishList = $data['productData'] ? 0 : 1;
		
		$addToWhishList = $this->db->update('products', ['is_wishlist' => $whishList], ['id' => $id]);

		redirect('Frontend/index');
	}

	public function showWhishListData() {
		
		
		$where = ['is_wishlist' => 0];
	
		$query = $this->Common_model->get_record('products', $where);
	
		$data['product_data'] = $query->result_array();
		
		$this->load->view('product/whish_list', $data);
	}

	public function remove_add_to_cart($id) {
		$where = array('id' => $id);
        $data['productData'] = $this->Common_model->get_data('products', $where);
		$whishList = $data['productData'] ? 1 : 0;
		
		$addToWhishList = $this->db->update('products', ['is_wishlist' => $whishList], ['id' => $id]);

		redirect('Frontend/showWhishListData');
	}
}
?>
