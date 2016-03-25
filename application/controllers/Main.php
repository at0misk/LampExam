<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index(){
		if(!$this->session->userdata('RegSuccess')){
			$this->session->set_userdata('RegSuccess', ' ');
		}
		$this->load->view('Main');
	}
	public function login(){
	    $this->load->library("form_validation");
	    $this->form_validation->set_rules("email", "Email", "trim|required");
		$this->form_validation->set_rules("password", "Password", "trim|required");
	    if($this->form_validation->run() === FALSE){
		     $this->session->set_userdata('errorsL', validation_errors());
		     $this->session->set_userdata('RegSuccess', ' ');
		     $this->session->set_userdata('errors', ' ');
		}
		else{   
	        $input = $this->input->post();
	        $this->load->model('User');
	        $logUser = $this->User->getUserByEmail($input['email']);
	        if($logUser && $logUser['password'] == $input['password']){
	        		$user = array(
	        	   'id' => $logUser['id'],
	               'name' => $logUser['name'],
	               'email' => $logUser['email'],
	               'is_logged_in' => true
	            );
	        	$this->session->set_userdata('id', $user['id']);
	        	$this->session->set_userdata('name', $user['name']);
	            $this->session->set_userdata('user', $user);
	            redirect('friends');
	        }
        }
        redirect('Main');
    }
    public function register(){
    	$this->load->library("form_validation");
    	$this->form_validation->set_rules("name", "Name", "trim|required");
		$this->form_validation->set_rules("alias", "Alias", "trim|required");
		$this->form_validation->set_rules("email", "Email", "trim|required");
		$this->form_validation->set_rules("password", "Password", "trim|required");
		$this->form_validation->set_rules("dob", "Date of Birth", "trim|required");
		if($this->form_validation->run() === FALSE){
		     $this->session->set_userdata('errors', validation_errors());
		     $this->session->set_userdata('RegSuccess', ' ');
		}
		else{
    	$input = $this->input->post();
        $this->load->model("User");
        $addedUser = $this->User->addUser($input);
        if($addedUser === TRUE) {
            $this->session->set_userdata('RegSuccess', 'User Added!');
            $this->session->set_userdata('errors', ' ');
        }
    	}	
    	redirect('Main');
    }
    public function dash(){
    	$this->load->model("User");
    	$others = $this->User->getOthers();
    	$friends = $this->User->getFriends();
	    $this->session->set_userdata('others', $others);
	    $this->session->set_userdata('friends', $friends);
    	$this->load->view('Dash');
    }
    public function users($id){
    	$this->load->model("User");
    	$clicked['clicked'] = $this->User->getFriendById($id);
    	$this->load->view('User', $clicked);
    }
    public function add($id){
    	$this->load->model("User");
    	$friend = $this->User->getFriendById($id);
    	// var_dump($friend);
    	// die();
    	$this->User->addFriend($friend);
    	// $deleted = $this->User->removeFriend($id);
    	redirect('friends');

    }
    public function remove($id){
    	$this->load->model("User");;
    	$deleted = $this->User->removeFriend($id);;
    	redirect('friends');
    }
    public function logout(){
    	session_destroy();
    	redirect('/');
    }

}