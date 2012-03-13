<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Feedback extends Public_Controller
{

	private $createorder_validation_rules = array(	
		array(
			'field' => 'f_name',
			'label' => 'lang:feedback.f_name',
			'rules' => 'trim|min_length[1]|max_length[100]|required'
		),
		array(
			'field' => 'f_email',
			'label' => 'lang:feedback.f_email',
			'rules' => 'trim|valid_email'
		)
		array(
			'field' => 'f_phone',
			'label' => 'lang:feedback.f_phone',
			'rules' => 'trim|min_length[7]|max_length[30]',
		),
		array(
			'field' => 'f_message',
			'label' => 'label:feedback.f_message',
			'rules' => 'trim|xss_clean|required'
		)
	);
	

	public function __construct()
	{
		parent::__construct();
		
		// Load the required classes
		$this->load->model('shipping_service_m');
		$this->load->model('templates/email_templates_m');
		/*************************/
		$this->load->library('form_validation');
		$this->load->library('settings/settings');
		/*************************/
		$this->lang->load('feedback');
		$this->load->helper('html');
		$this->load->helper('string');
		/*************************/
	}
	
	
	public function index(){
	die();
		redirect('feedback/createfeed');
	}
	

	public function createfeed(){
	
		$this->template
			 ->set('user',$this->current_user)
			 ->append_metadata('<script src="http://cdn.jquerytools.org/1.2.6/full/jquery.tools.min.js"></script>');
		/*
		*
		*	1. Check form validation
		*	2. Insert order
		*	3. Send email about create order to customer ? and may be admin ?
		*	4. View form
		*/
		
		$this->form_validation->set_rules($this->createorder_validation_rules);
		
		if( $this->form_validation->run() ){
		
			if( $order_id = $this->feedback_m->insert($this->input->post()) ){
			
			
				$this->template
					 ->build('createfeed',array(
							'msg'      => lang('feedback.success_insert_message')
					));
				return TRUE;
			}
		}
		
		$this->template
			 ->build('createfeed',array());
	}
	
}