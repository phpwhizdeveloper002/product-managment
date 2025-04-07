<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

    public function __construct()
	{
		parent::__construct();

		$this->load->model('Category_model');
        $this->load->model('Common_model');
        
	}

	public function index() {
        $data['category'] = "Categories";
        
        $this->load->view('admin/header');
		$this->load->view('admin/category/category_list', $data);
        $this->load->view('admin/footer');
    }

    public function ajax_get_category_list() {
        $query = $this->Common_model->get_record('categories');
        // echo "Query: " . $this->db->last_query() . "<br><br>";

        $data['category_data'] = $query->result_array();
    
        echo $this->load->view('admin/ajax_get_customer_list', $data, true);
    }

    public function addNewCategoryPopup() {
        $data['category'] = "Category";
        
        echo $this->load->view('admin/models/add_new_category_popup', $data, true);
    }   

    public function saveCategoryForm() {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'Category Name', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $errors = validation_errors();
    
            $this->session->set_flashdata('error_message', $errors);
    
            echo json_encode(['errors' => true]); // Return error response
            return;
        }
    
        $formData = $this->input->post();

        if(!empty($formData)){

            $formData['created_at'] = date('Y-m-d H:i:s');
            $formData['status'] = 1;

            $inserted = $this->Common_model->insert_data('categories', $formData);
        
            if ($inserted) {
                echo json_encode(['message' => 'Form submitted successfully!']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to submit form!']);
            }
        }
    }

    public function updateCategoryPopup() {
        $categoryId = $this->input->post('id');
        
        if(!empty($categoryId)) {
            $this->db->where('id', $categoryId);
            $data['categoryData'] = $this->db->get('categories')->row_array();
        }
        
        echo $this->load->view('admin/models/update_category_popup', $data, true);
    }   

    public function updateCategoryForm() {

        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'Category Name', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $errors = validation_errors();
    
            $this->session->set_flashdata('error_message', $errors);
    
            echo json_encode(['errors' => true]);
            return;
        }
    
        $formData = $this->input->post();
        
        if(!empty($formData)){

            $updateData = [
                'name' => $this->input->post('name'),
                'status' => 1,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $inserted = $this->db->update('categories', $updateData, ['id' => $formData['categoryId']]);
        
            if ($inserted) {
                echo json_encode(['message' => 'Form Update successfully!']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to submit form!']);
            }
        }
    }
    
}
?>
