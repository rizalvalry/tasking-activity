<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
{

    public function __construct(){
        parent::__construct();
        $this->load->library('datatables');
        $this->load->model('product_model');
      }

    public function index() {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = "Product";

        // $this->load->model('Product_model', 'product');
        $data['row'] = $this->product_model->getProd();

        // $data['row'] = $this->db->get('product');

        $this->template->load('template', 'product/index', $data);
    }

    public function ajax_add() {
      $data = array(
          'slug' => $this->input->post('slug'),
          'title' => $this->input->post('title'),
          'description' => $this->input->post('description'),
          'price' => $this->input->post('price')
        );
      $insert = $this->product_model->save($data);
      echo json_encode(array("status" => TRUE));

      // $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Product added!</div>');
      //   redirect('product');
    }

  public function ajax_update() {
		$data = array(
      'slug' => $this->input->post('slug'),
      'title' => $this->input->post('title'),
      'description' => $this->input->post('description'),
      'price' => $this->input->post('price')
			);
		$this->product_model->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
  }

  public function ajax_edit($id)
	{
		$data = $this->product_model->get_by_id($id);
		echo json_encode($data);
	}
  
  public function ajax_delete($id) {
		$this->product_model->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}


  public function get_json() {
    
    $list = $this->product_model->get_datatables();
    $data = array();
    $no = $_POST['start'];
    foreach ($list as $product) {
      $no++;
      $row = array();
      $row[] = $no;
      $row[] = $product->slug;
      $row[] = $product->title;
      $row[] = $product->description;
      $row[] = $product->price;

      //add html for action
      $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_product('."'".$product->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
          <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_product('."'".$product->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
    
      $data[] = $row;
    }

    $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->product_model->count_all(),
            "recordsFiltered" => $this->product_model->count_filtered($_POST),
            "data" => $data,
        );
    //output to json format
    // print_r(json_encode($output));
    // die;
    echo json_encode($output);

  }
      

      
      // function get_guest_json() { //data data produk by JSON object
      //   header('Content-Type: application/json');
      //   echo $this->product_model->get_all_produk();
      // }
      
      // function insert_dumy(){
      //     // jumlah data yang akan di insert
      //     $jumlah_data = 100;
      //     for ($i=1;$i<=$jumlah_data;$i++){
      //         $data   =   array(
      //             "slug"  =>  "Product ke -".$i,
      //             "title"         =>  "Barang ke -".$i,
      //             "description"         =>  'Description Product',
      //             "price"          =>  "250".$i,
      //             "is_available"          =>  1
      //         );
      //         $this->db->insert('product',$data); 
      //     }
      //     echo $i.' Data Berhasil Di Insert';
      // }
}