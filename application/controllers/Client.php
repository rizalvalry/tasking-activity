<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Client extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->library('datatables');
        $this->load->model('client_model');
      }
      
    public function index() {
        $data['title'] = 'Client';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        
        // get model
        $data['row'] = $this->client_model->getClient();

        // get template
        $this->template->load('template', 'client/client_data', $data);
    }

    public function get_json() {
        $this->load->library('datatables');
        // $this->datatables->add_column('no', 'ID-$1', 'id');
        $this->datatables->select('client_name, status, duration, order_type');
        // $this->datatables->add_column('action', anchor('product', 'Update', array('class' => 'btn btn-primary')). " ".
        // anchor('product', 'Delete', array('class' => 'btn btn-danger')), 'id');
        $this->datatables->from('client');
        $this->db->order_by('id_client', 'desc');
        return print_r($this->datatables->generate());
      }

      public function save() {
        $data = array(
          'client_name'
        );
      }

}