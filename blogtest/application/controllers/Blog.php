<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Blog extends CI_Controller 
	{

		public function __construct()
		{
			parent::__construct();

			$this->load->model('blog_model');
		}

		public function index() 
		{
			if($this->session->userdata('logged_in'))
		    {	
		    	$sessionData = $this->session->userdata('logged_in');
				$data['title'] = "Blog";
				$data['header'] = "Articles";
				$data['username'] = $sessionData['username'];
				$data['query'] = $this->blog_model->getAllTopics();
				$this->load->view('blog_view', $data);
			} else {
				redirect('login', 'refresh');
			}
		}

		public function postComment()
		{
			if($this->session->userdata('logged_in'))
		    {	
				if($this->input->post('entry_id'))
					$entry_id = $this->input->post('entry_id');
				else
					redirect('blog/index');

				if($this->input->post('message', TRUE))
					$message = $this->input->post('message');
				else
					redirect('blog/getAllComments/'.$entry_id);

				if($this->input->post('author', TRUE))
					$author = $this->input->post('author');
				else
					redirect('blog/getAllComments/'.$entry_id);

				$parameters = array(
						"entry_id" => html_escape($entry_id),
						"author" => html_escape($author),
						"message" => html_escape($message)
					);

				$this->blog_model->postComment($parameters);
				redirect('blog/getAllComments/'.$entry_id);
			} else 
			{
				redirect('login', 'refresh');
			}
		}

		public function getComment() 
		{
			if($this->session->userdata('logged_in'))
		    {
		    	echo 'in getComments';
		    } else 
		    {
		    	redirect('login', 'refresh');
		    }
		}

		public function getAllComments()
		{
			if($this->session->userdata('logged_in'))
			{
				$segments = $this->uri->segment_array();
				if($segments[3] == null)
					redirect('blog/index');
				

				$data['title'] = "Comments from";
				$data['header'] = "Comments";
				$data['entry'] = $this->blog_model->getTopic($segments[3]);
				$data['comments'] = $this->blog_model->getAllComments($segments[3]);
				$this->load->view('comment_view', $data);	
			} else
			{
				redirect('login', 'refresh');
			}
			
		}

		public function postTopic() 
		{
			if($this->session->userdata('logged_in'))
			{
				if($this->input->post('title', TRUE))
					$title = $this->input->post('title');
				else
					redirect('blog/index/');

				if($this->input->post('body', TRUE))
					$body = $this->input->post('body');
				else
					redirect('blog/index/');



				$parameters = array(
						"title" => html_escape($title),
						"body" => html_escape($body)
					);

				$this->blog_model->postTopic($parameters);
				redirect('blog/index/');
			} else 
			{
				redirect('login', 'refresh');
			}
		}

		public function getTopic() 
		{
			if($this->session->userdata('logged_in'))
			{
				if($this->uri->segment(3) == null)
					redirect('blog/index');

				$id = html_escape($this->uri->segment(3));
				$data = $this->blog_model->getTopic($id);

				return $data;
			} else
			{
				redirect('login', 'refresh');
			}
		}

		public function getAllTopics() {
			if($this->session->userdata('logged_in'))
			{
				echo 'in getAllTopics';
			} else
			{
				redirect('login','refresh');
			}
		}


	}
?>