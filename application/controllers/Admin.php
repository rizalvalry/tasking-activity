<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('menu_model');
        $this->load->model('project_model');
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $query = $this->db->query('SELECT * FROM product');
        $data['product'] = $query->num_rows();
        $data['profile'] = $this->db->get_where('profile')->row_array();
        $data['projectcount'] = $this->menu_model->getProject()->num_rows();
        $data['earnings'] = $this->menu_model->getTImeline();
        $data['pendingrequest'] = $this->project_model->deploycheck()->num_rows();
        $data['totalproject'] = $this->project_model->projecttotal()->num_rows();
        $data['percentage'] = $this->cal_percentage($data['earnings'],  $data['totalproject']);

        $this->template->load('template', 'admin/index', $data);
    }


        public function cal_percentage($num_amount, $num_total) {
        $count1 = $num_amount / $num_total;
        $count2 = $count1 * 100;
        $count = number_format($count2, 0);

        
        return $count;
        }

    // echo "Percentage of 39 in 100 : ".cal_percentage(39, 100).'%<br/>';


    public function role()
    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get('user_role')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role', $data);
        $this->load->view('templates/footer');
    }


    public function roleAccess($role_id)
    {
        $data['title'] = 'Role Access';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer');
    }


    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Access Changed!</div>');
    }

    public function addprofile() {

            $this->load->model('profile_model');
            if (isset($_POST['submit'])){
                $this->profile_model->id_exists();
                redirect('admin');
            }else{
                $data['profile'] = $this->profile_model->identitas()->row_array();
                $this->template->load('admin',$data);
            }

    }



    
}
