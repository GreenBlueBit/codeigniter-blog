<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Login extends CI_Controller 
	{

		public function __construct()
		{
			parent::__construct();
			$this->load->model('login_model');
		}

		public function index() 
		{
	    	$data['title'] = "LOGIN";
			$data['header'] = "Login";
			$this->load->view('login_view', $data);
		}
		public function verifyLogin()
		{
			$this->load->library('form_validation');
			$this->load->helper('security');

		    $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		    $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_checkDatabase');

		    if($this->form_validation->run() == FALSE)
		    {
		      	//Field validation failed.  User redirected to login page
		      	$data['title'] = "LOGIN";
				$data['header'] = "Login";
				$this->load->view('login_view', $data);
		    }
		    else
		    {
		      //Go to private area
		      redirect('blog/index');
		    }
		}
		public function logout() 
		{
			$this->session->unset_userdata('logged_in');
		    session_destroy();
		    redirect('login', 'refresh');
		}
		public function checkDatabase()
		 {
		   //Field validation succeeded.  Validate against database
		   $username = $this->input->post('username');
		   $password = $this->input->post('password');

		   //query the database
		   $result = $this->login_model->login($username, $password);

		   if($result)
		   {
		     $sess_array = array();
		     foreach($result as $row)
		     {
		       $sess_array = array(
		         'id' => $row->id,
		         'username' => $row->username
		       );
		       $this->session->set_userdata('logged_in', $sess_array);
		     }
		     return TRUE;
		   }
		   else
		   {
		     $this->form_validation->set_message('check_database', 'Invalid username or password');
		     return false;
		   }
		 }
	}