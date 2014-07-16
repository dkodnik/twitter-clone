<?php
  class User_model extends CI_Model {

    public function __construct(){
      parent::__construct();
      $this->load->database();
    }

    public function get_user(){
      if($slug === FALSE){
        //no user, return nothing
        return null;
      }

      $query = $this->db->get_where('user', array('slug' => $slug));
      return $query->row_array();
    }

    public function set_user() {
      $this->load->helper('url');
      $this->load->helper('security');

      $slug = url_title($this->input->post('username'), 'dash', TRUE);
      $password = hash ( "sha256", $this->input->post('password') . '_' .  $this->input->post('username'));
      $passwordVersion = 1;

      $data = array(
        'username' => $this->input->post('username'),
        'email' => $this->input->post('email'),
        'slug' => $slug,
        'password' => $password,
        'password_version' => 1
      );

      return $this->db->insert('user', $data);
    }
  }

?>