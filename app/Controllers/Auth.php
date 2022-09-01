<?php

namespace App\Controllers;

class Auth extends BaseController
{
    private $session;
    private $db;

    function __construct(){
        $this->session = session();
        $this->db = db_connect();
    }

    public function index()
	{
        helper(['form', 'url']);
        $data = [
            'email'         => ['name'=>'usuario','id'=>'inputEmail','class'=>'form-control'],
            'password'      => ['name'=>'clave','id'=>'inputPassword','class'=>'form-control','type'=>'password'],
            'boton_submit'  => ['class'=>'w-100 btn btn-lg btn-primary'],
        ];
		echo view('login',$data);
	}

    

    public function login(){
        $usuario = $this->request->getPost('usuario');
        $clave = md5($this->request->getPost('clave'));
        $validar = $this->db->table('usuarios')->where('usuario',$usuario)
                                               ->where('clave',$clave)
                                               ->get()
                                               ->getRow();
        if ($validar) {
            $this->session->set('logueado',true);
            $this->session->set('nombre',$validar->nombre);
            $this->session->set('id',$validar->id);
            $this->session->set('asignacion',$validar->asignacion);
            return redirect()->to('/Home/index');
        }else {
            $this->session->set('logueado',false);
            
            return redirect()->to('/');
        }
        
	}
    public function logout(){
        $this->session->set('logueado',false);
        $this->session->set('nombre',"");
        $this->session->set('id', "");
        return redirect()->to('/');
     }
    public function validar()
	{
		$data = [
            'email'     => $this->request->getPost('inputEmail'),
            'password'  => $this->request->getPost('inputPassword'),
        ];
        return view('validar',$data);
	}

    
}