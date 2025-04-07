<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

    public function __construct()
	{
		parent::__construct();

		$this->load->model('Product_model');
        $this->load->model('Common_model');
        
	}

	public function index() {
        $data['product'] = "Product";

        $this->load->view('admin/header');
		$this->load->view('admin/products/product_list', $data);
        $this->load->view('admin/footer');
    }

    public function ajax_get_product_list() {
        $field = 'products.*, categories.name';
        $join = [
            [
                'table' => 'categories',
                'condition' => 'categories.id = products.category_id',
                'type' => 'left'
            ]
        ];

        $query = $this->Product_model->get_record('products', '', $field, $join);
        $data['product_data'] = $query->result_array();
        
        echo $this->load->view('admin/ajax_get_products_list', $data, true);
    }

    public function addNewProductPopup() {
        $data['product'] = "Add Product";

        $query = $this->Common_model->get_record('categories');
        $data['categories'] = $query->result_array();
        
        echo $this->load->view('admin/models/add_new_product_popup', $data, true);
    }

    public function updateProductPopup() {
        $data['product'] = "Update Product";

        $productId = $this->input->post('id');

        if(!empty($productId)) {
            $this->db->where('id', $productId);
            $data['productData'] = $this->db->get('products')->row_array();
        }

        $query = $this->Common_model->get_record('categories');
        $data['categories'] = $query->result_array();
        
        echo $this->load->view('admin/models/add_new_product_popup', $data, true);
    }

    public function saveProductForm() {

        $this->load->library('form_validation');

        $this->form_validation->set_rules('title', 'Category Name', 'required|trim');
        $this->form_validation->set_rules('price', 'Price', 'required');
        $this->form_validation->set_rules('qty', 'Category Name', 'required');
        $this->form_validation->set_rules('description', 'Description Name', 'required');
        $this->form_validation->set_rules('category_id', 'category id', 'required');

        if ($this->form_validation->run() == FALSE) {
            $errors = validation_errors();
    
            $this->session->set_flashdata('error_message', $errors);
    
            echo json_encode(['errors' => true]);
            return;
        }
    
        $data = $this->input->post();
        $product_id = $data['product_id'];

        if (!empty($_FILES['image']['name'])) {

            $config['upload_path'] = './uploads/products/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = time() . '_' . $_FILES['image']['name'];
    
            $this->load->library('upload', $config);
    
            if ($this->upload->do_upload('image')) {
                $uploadData = $this->upload->data();
                if(!empty($uploadData)){
                    $data['image'] = $uploadData['file_name'];
                }else{
                    $data['image'] = $this->input->post('old_image');
                }
            } else {
                $error = $this->upload->display_errors();
                echo json_encode(['status' => false, 'message' => $error]);
                return;
            }
        }

        $formData = [
            'category_id' => $data['category_id'],
            'title' => $data['title'],
            'status' => 1,
            'image' => $data['image'],
            'price' => $data['price'],
            'qty' => $data['qty'],
            'description' => $data['description'],
        ];
    
        if (!empty($formData)) {
            $formData['created_at'] = date('Y-m-d H:i:s');
            $formData['status'] = 1;
            
            if(!empty($product_id)){
                
                $where = array('id' => $product_id);
                $inserted = $this->Common_model->update_data('products', $where, $formData);
            }else{
                $inserted = $this->Common_model->insert_data('products', $formData);
            }
    
            if ($inserted) {
                echo json_encode(['status' => true, 'message' => 'Form submitted successfully!']);
            } else {
                echo json_encode(['status' => false, 'message' => 'Failed to submit form!']);
            }
        } else {
            echo json_encode(['status' => false, 'message' => 'No form data received.']);
        }
    }
}
?>
