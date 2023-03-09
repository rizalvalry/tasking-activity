<?php 
class Model_identitas extends CI_model{
    function identitas(){
        return $this->db->query("SELECT * FROM identitas ORDER BY id_identitas DESC LIMIT 1");
    }

    function identitas_update(){
            $config['upload_path'] = 'asset/';
            $config['allowed_types'] = 'ico';
            $config['max_size'] = '20'; // kb
            $this->load->library('upload', $config);
            $this->upload->do_upload('i');
            $hasil=$this->upload->data();
            if ($hasil['file_name']==''){
                    $datadb = array('nama_website'=>$this->db->escape_str($this->input->post('a')),
                                    'alamat_website'=>$this->db->escape_str($this->input->post('c')),
                                    'meta_deskripsi'=>$this->db->escape_str($this->input->post('g')),
                                    'meta_keyword'=>$this->db->escape_str($this->input->post('h')));
            }else{
                    $datadb = array('nama_website'=>$this->db->escape_str($this->input->post('a')),
                                    'alamat_website'=>$this->db->escape_str($this->input->post('c')),
                                    'meta_deskripsi'=>$this->db->escape_str($this->input->post('g')),
                                    'meta_keyword'=>$this->db->escape_str($this->input->post('h')),
                                    'favicon'=>$hasil['file_name']);
            }
            $this->db->where('id_identitas',1);
            $this->db->update('identitas',$datadb);
    }
}