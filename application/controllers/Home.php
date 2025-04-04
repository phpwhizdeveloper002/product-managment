<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct()
	{
		parent::__construct();

		$this->load->model('Common_model');
        
	}

	public function index()
	{
		$query = $this->Common_model->get_record('categories');

        $data['category_count'] = count($query->result_array());

        $this->load->view('admin/header');
		$this->load->view('admin/dashboard', $data);
        $this->load->view('admin/footer');
	}
}
?>
