<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/JWT.php';
require APPPATH . '/libraries/ExpiredException.php';
require APPPATH . '/libraries/BeforeValidException.php';
require APPPATH . '/libraries/SignatureInvalidException.php';
require APPPATH . '/libraries/JWK.php';

use chriskacerguis\RestServer\RestController;
use \Firebase\JWT\JWT;
use \Firebase\JWT\ExpiredException;
use Firebase\JWT\Key;

class Api extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('project_model');
    }

    public function test_get(){
        $this->db->select('*');        
        $data = array ('data'=>$this->db->get('project')->result());  
        $this->response($data, 200 );
    }

    public function configToken(){
        $cnf['exp'] = 3600; //milisecond
        $cnf['secretkey'] = '2212336221';
        return $cnf;        
    }

    public function getToken_post(){               
        $exp = time() + 3600;
        $token = array(
            "iss" => 'apprestservice',
            "aud" => 'pengguna',
            "iat" => time(),
            "nbf" => time() + 10,
            "exp" => $exp,
            "data" => array(
                "username" => $this->input->post('username'),
                "password" => $this->input->post('password')
            )
        );       
    
    $jwt = JWT::encode($token, $this->configToken()['secretkey'], 'HS256');
    $output = [
            'status' => 200,
            'message' => 'Berhasil login',
            "token" => $jwt,                
            "expireAt" => $token['exp']
        ];      
        // var_dump($output);die();
    $data = array('kode'=>'200', 'pesan'=>'token', 'data'=>array('token'=>$jwt, 'exp'=>$exp));
    $this->response($data, 200 );       
}


public function authtoken(){
    $secret_key = $this->configToken()['secretkey']; 
    $token = null; 
    $authHeader = $this->input->request_headers()['Authorization'];
    $arr = explode(" ", $authHeader); 
    $token = $arr[1];        
    if ($token){
        try{
            $decoded = JWT::decode($token, new Key($this->configToken()['secretkey'], 'HS256'));   
                
            if ($decoded){
                return 'benar';
            }
        } catch (\Exception $e) {
            $result = array('pesan'=>'Kode Signature Tidak Sesuai');
            return 'salah';
            
        }
    }       
}

public function projectdor_get(){             
        
    if ($this->authtoken() == 'salah'){
        return $this->response(array('kode'=>'401', 'pesan'=>'signature tidak sesuai', 'data'=>[]), '401');
        die();
    }
    $this->db->select('*');        
    $data = array ('data'=>$this->db->get('project')->result());        
    $this->response($data, 200 );
}



    // public function users_get()
    // {
    //     // Users from a data store e.g. database
    //     $users = [
    //         ['id' => 0, 'name' => 'John', 'email' => 'john@example.com'],
    //         ['id' => 1, 'name' => 'Jim', 'email' => 'jim@example.com'],
    //     ];

    //     $id = $this->get( 'id' );

    //     if ( $id === null )
    //     {
    //         // Check if the users data store contains users
    //         if ( $users )
    //         {
    //             // Set the response and exit
    //             $this->response( $users, 200 );
    //         }
    //         else
    //         {
    //             // Set the response and exit
    //             $this->response( [
    //                 'status' => false,
    //                 'message' => 'No users were found'
    //             ], 404 );
    //         }
    //     }
    //     else
    //     {
    //         if ( array_key_exists( $id, $users ) )
    //         {
    //             $this->response( $users[$id], 200 );
    //         }
    //         else
    //         {
    //             $this->response( [
    //                 'status' => false,
    //                 'message' => 'No such user found'
    //             ], 404 );
    //         }
    //     }
    // }
}   