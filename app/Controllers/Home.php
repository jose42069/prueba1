<?php

namespace App\Controllers;

class Home extends BaseController
{
	private $session;
    private $db;
    

    public function __construct(){
        $this->session = session();
        $this->db = db_connect();
    }

	public function index()
	{
		helper(['formdate','url']);

        $pager = \Config\Services::pager();
        $page = ($this->request->getGet('page') > 0 ) ? $this->request->getGet('page') : 1;

        $limit = 20;
        $offset = ($page * $limit) - $limit;
        $user = $this->session->nombre;
         

        if($this->session->asignacion == 1){
            $total = $this->db->table('semanas')->countAllResults();
            $query = $this->db->table('semanas')
           ->select('*,(SELECT CONCAT(nombre) as nombre FROM usuarios WHERE usuarios.id=semanas.usuario) AS usuarios', false)
           ->limit($limit,$offset)
           ->get();
        }else if($this->session->asignacion != 1){
            $total = $this->db->table('semanas')->where('usuario',$this->session->id)->countAllResults();
            $query = $this->db->table('semanas')
           ->select('*,(SELECT CONCAT(nombre) as nombre FROM usuarios WHERE usuarios.id=semanas.usuario) AS usuarios', false)
           ->where('usuario',$this->session->id)
           ->limit($limit,$offset)
           ->get();

        }

        

        
        
        $data = [
            'pagination' => $pager->makeLinks($page, $limit, $total),
            'semanas' => $query->getResult(),
            
        ];

		$data['id'] = $this->session->id;
        $data['status'] = $this->session->asignacion;
        $data['proyectos'] = $this->db->table('proyectos')->get()->getResult();
        

        
        
        

        
        echo view('listado',$data);
		
	}

    public function bitacora($año = 0, $semana = 0, $usuario = 0){
        helper(['formdate','url']);

        $pager = \Config\Services::pager();
        $page = ($this->request->getGet('page') > 0 ) ? $this->request->getGet('page') : 1;
        $limit = 9;
        $offset = ($page * $limit) - $limit;
        $user = $this->session->nombre;
        $id = $this->session->id;

        $total = $this->db->table('bitacora')->countAllResults();
        if($this->session->asignacion == 1){
            $query = $this->db->table('bitacora')
            ->where('semana',$semana)
            ->where('año',$año)
            ->where('usuario',$usuario)
            ->limit($limit,$offset)
            ->get();
        }else if($this->session->asignacion != 1){
            $query = $this->db->table('bitacora')
            ->where('semana',$semana)
            ->where('año',$año)
            ->where('usuario',$id)
            ->limit($limit,$offset)
            ->get();
        }
        

        $query2 = $this->db->table('semanas')
        ->where('semana',$semana)
        ->where('año',$año)
        ->where('usuario',$id)
        ->get();

        


        $data = [
            'bitacora' => $query->getResult(),
            'nueva' => $query2->getResult()
        ];
        $data['id'] = $this->session->id;
        $data['proyectos'] = $this->db->table('proyectos')->get()->getResult();

        echo view('bitacora',$data);

    }

    public function nueva_actividad($año = 0, $semana = 0){
        helper(['form', 'url']);
        
        if($this->request->getPost('guardar')){
            $validando = $this->validate([
                'actividad' => 'required',
                'cliente' => 'required',
                'proyecto' => 'required',
                'tipo' => 'required',
                'unidad' => 'required'

            ]);
            $actividad = [
                'semana' => $semana,
                'año' => $año,
                'usuario' => $this->session->id,
                'actividad' => $this->request->getPost('actividad'),
                'cliente' => $this->request->getPost('cliente'),
                'proyecto' => $this->request->getPost('proyecto'),
                'tipo' => $this->request->getPost('tipo'),
                'unidad' => $this->request->getPost('unidad'),
                'lun' => 0,
                'mar' => 0,
                'mie' => 0,
                'jue' => 0,
                'vie' => 0,
                'sab' => 0,
                'dom' => 0
                
            ];
            
            if(!$validando){
                $data['validation'] = $this->validator;
            }else{
                $this->db->table('bitacora')->insert($actividad);
                return $this->response->redirect(base_url('Home'));
            }
            
            

            
        }else{
            $actividad = [
                'semana' => "",
                'año' => "",
                'usuario' => "",
                'actividad' => "",
                'cliente' => "",
                'proyecto' => "",
                'tipo' => "",
                'unidad' => "", 
                'lun' => 0,
                'mar' => 0,
                'mie' => 0,
                'jue' => 0,
                'vie' => 0,
                'sab' => 0,
                'dom' => 0
            ];
            $data['enviado'] = "no";
        }
        
        
        
        
        
        $data['validation'] = \Config\Services::validation();
        $data['proyectos'] = $this->db->table('proyectos')->get()->getResult();
        $data['clientes'] = $this->db->table('clientes')->get()->getResult();
        $data['actividad'] = $actividad;
        

      
        
        
        

        
         
        echo view('nueva_actividad',$data);
        
    }

    public function horas($id){
        helper(['form', 'url']);

        
        
        if($this->request->getPost('guardar')){
             

            
            $horas = [
                'lun' => $this->request->getPost('lun'),
                'mar' => $this->request->getPost('mar'),
                'mie' => $this->request->getPost('mie'),
                'jue' => $this->request->getPost('jue'),
                'vie' => $this->request->getPost('vie'),
                'sab' => $this->request->getPost('sab'),
                'dom' => $this->request->getPost('dom')
                
            ];
            
            
                $this->db->table('bitacora')
                ->where('id',$id)
                ->update($horas);
                return $this->response->redirect(base_url('Home'));
            
            
            

            
        }else{
            $horas = [
                'lun' => 0,
                'mar' => 0,
                'mie' => 0,
                'jue' => 0,
                'vie' => 0,
                'sab' => 0,
                'dom' => 0
            ];
            $data['enviado'] = "no";
        }
        
        
        
        
        
        $data['validation'] = \Config\Services::validation();
        $data['horas'] = $horas;
        

      
        
        
        

        
         
        echo view('horas',$data);
        
    }

    public function nueva(){
        helper(['form', 'url']);

        $validando = $this->validate([
            'año' => 'required'

        ]);

        if($this->request->getPost('guardar')){
            $semana = [
            [    
                'semana' => 1,
                'usuario' => $this->session->id,
                'año' => $this->request->getPost('año')
            ],
            [
                'semana' => 2,
                'usuario' => $this->session->id,
                'año' => $this->request->getPost('año')
            ],
            [    
                'semana' => 3,
                'usuario' => $this->session->id,
                'año' => $this->request->getPost('año')
            ],
            [
                'semana' => 4,
                'usuario' => $this->session->id,
                'año' => $this->request->getPost('año')
            ],
            [    
                'semana' => 5,
                'usuario' => $this->session->id,
                'año' => $this->request->getPost('año')
            ],
            [
                'semana' => 6,
                'usuario' => $this->session->id,
                'año' => $this->request->getPost('año')
            ],
            [    
                'semana' => 7,
                'usuario' => $this->session->id,
                'año' => $this->request->getPost('año')
            ],
            [
                'semana' => 8,
                'usuario' => $this->session->id,
                'año' => $this->request->getPost('año')
            ],
            [    
                'semana' => 9,
                'usuario' => $this->session->id,
                'año' => $this->request->getPost('año')
            ],
            [
                'semana' => 10,
                'usuario' => $this->session->id,
                'año' => $this->request->getPost('año')
            ],
            [    
                'semana' => 11,
                'usuario' => $this->session->id,
                'año' => $this->request->getPost('año')
            ],
            [
                'semana' => 12,
                'usuario' => $this->session->id,
                'año' => $this->request->getPost('año')
            ],
            [    
                'semana' => 13,
                'usuario' => $this->session->id,
                'año' => $this->request->getPost('año')
            ],
            [
                'semana' => 14,
                'usuario' => $this->session->id,
                'año' => $this->request->getPost('año')
            ],
            [    
                'semana' => 15,
                'usuario' => $this->session->id,
                'año' => $this->request->getPost('año')
            ],
            [
                'semana' => 16,
                'usuario' => $this->session->id,
                'año' => $this->request->getPost('año')
            ],
            [    
                'semana' => 17,
                'usuario' => $this->session->id,
                'año' => $this->request->getPost('año')
            ],
            [
                'semana' => 18,
                'usuario' => $this->session->id,
                'año' => $this->request->getPost('año')
            ],
            [    
                'semana' => 19,
                'usuario' => $this->session->id,
                'año' => $this->request->getPost('año')
            ],
            [
                'semana' => 20,
                'usuario' => $this->session->id,
                'año' => $this->request->getPost('año')
            ],
            [    
                'semana' => 21,
                'usuario' => $this->session->id,
                'año' => $this->request->getPost('año')
            ],
            [
                'semana' => 22,
                'usuario' => $this->session->id,
                'año' => $this->request->getPost('año')
            ],
            [    
                'semana' => 23,
                'usuario' => $this->session->id,
                'año' => $this->request->getPost('año')
            ],
            [
                'semana' => 24,
                'usuario' => $this->session->id,
                'año' => $this->request->getPost('año')
            ],
            [    
                'semana' => 25,
                'usuario' => $this->session->id,
                'año' => $this->request->getPost('año')
            ],
            [
                'semana' => 26,
                'usuario' => $this->session->id,
                'año' => $this->request->getPost('año')
            ],
            [    
                'semana' => 27,
                'usuario' => $this->session->id,
                'año' => $this->request->getPost('año')
            ],
            [
                'semana' => 28,
                'usuario' => $this->session->id,
                'año' => $this->request->getPost('año')
            ],
            [    
                'semana' => 29,
                'usuario' => $this->session->id,
                'año' => $this->request->getPost('año')
            ],
            [
                'semana' => 30,
                'usuario' => $this->session->id,
                'año' => $this->request->getPost('año')
            ],
            [    
                'semana' => 31,
                'usuario' => $this->session->id,
                'año' => $this->request->getPost('año')
            ],
            [
                'semana' => 32,
                'usuario' => $this->session->id,
                'año' => $this->request->getPost('año')
            ],
            [    
                'semana' => 33,
                'usuario' => $this->session->id,
                'año' => $this->request->getPost('año')
            ],
            [
                'semana' => 34,
                'usuario' => $this->session->id,
                'año' => $this->request->getPost('año')
            ],
            [    
                'semana' => 35,
                'usuario' => $this->session->id,
                'año' => $this->request->getPost('año')
            ],
            [
                'semana' => 36,
                'usuario' => $this->session->id,
                'año' => $this->request->getPost('año')
            ],
            [    
                'semana' => 37,
                'usuario' => $this->session->id,
                'año' => $this->request->getPost('año')
            ],
            [
                'semana' => 38,
                'usuario' => $this->session->id,
                'año' => $this->request->getPost('año')
            ],
            [    
                'semana' => 39,
                'usuario' => $this->session->id,
                'año' => $this->request->getPost('año')
            ],
            [
                'semana' => 40,
                'usuario' => $this->session->id,
                'año' => $this->request->getPost('año')
            ],
            [    
                'semana' => 41,
                'usuario' => $this->session->id,
                'año' => $this->request->getPost('año')
            ],
            [
                'semana' => 42,
                'usuario' => $this->session->id,
                'año' => $this->request->getPost('año')
            ],
            [    
                'semana' => 43,
                'usuario' => $this->session->id,
                'año' => $this->request->getPost('año')
            ],
            [
                'semana' => 44,
                'usuario' => $this->session->id,
                'año' => $this->request->getPost('año')
            ],
            [    
                'semana' => 45,
                'usuario' => $this->session->id,
                'año' => $this->request->getPost('año')
            ],
            [
                'semana' => 46,
                'usuario' => $this->session->id,
                'año' => $this->request->getPost('año')
            ],
            [    
                'semana' => 47,
                'usuario' => $this->session->id,
                'año' => $this->request->getPost('año')
            ],
            [
                'semana' => 48,
                'usuario' => $this->session->id,
                'año' => $this->request->getPost('año')
            ],
            [    
                'semana' => 49,
                'usuario' => $this->session->id,
                'año' => $this->request->getPost('año')
            ],
            [
                'semana' => 50,
                'usuario' => $this->session->id,
                'año' => $this->request->getPost('año')
            ],
        ];
            if(!$validando){
                $data['validation'] = $this->validator;
            }else{
                $this->db->table('semanas')->insertBatch($semana);
                return $this->response->redirect(base_url('Home/index'));
            }
            
            
        }else{
            $semana = [
            'semana' => "",
            'usuario' => "",
            'año' => ""
            ];
        }

        $data['validation'] = \Config\Services::validation();
        $data['semana'] = $semana;
        
         
        echo view('nueva_semana',$data);
        

    }

    public function proyectos(){
        helper(['formdate','url']);

        $pager = \Config\Services::pager();
        $page = ($this->request->getGet('page') > 0 ) ? $this->request->getGet('page') : 1;

        $limit = 20;
        $offset = ($page * $limit) - $limit;

        $total = $this->db->table('proyectos')->countAllResults();
        $query = $this->db->table('proyectos')
        ->limit($limit,$offset)
        ->get();

        $data = [
            'pagination' => $pager->makeLinks($page, $limit, $total),
            'proyectos' => $query->getResult()
            
        ];

		$data['id'] = $this->session->id;
        $data['status'] = $this->session->asignacion;
        

        
        
        

        
        echo view('proyectos',$data);

    }

    public function nuevo_proyecto(){
        helper(['form', 'url']);
        
        if($this->request->getPost('guardar')){
            $validando = $this->validate([
                'proyecto' => 'required',
                'tipo' => 'required',
                'cliente' => 'required'

            ]);
            $proyecto = [
                'proyecto' => $this->request->getPost('proyecto'),
                'tipo' => $this->request->getPost('tipo'),
                'cliente' => $this->request->getPost('cliente')
                
                
            ];
            
            if(!$validando){
                $data['validation'] = $this->validator;
            }else{
                $this->db->table('proyectos')->insert($proyecto);
                return $this->response->redirect(base_url('Home/proyectos'));
            }
            
            

            
        }else{
            $proyecto = [
                'proyecto' => "",
                'tipo' => "",
                'cliente' => ""
            ];
            $data['enviado'] = "no";
        }
        
        
        
        
        
        $data['validation'] = \Config\Services::validation();
        
        $data['proyecto'] = $proyecto;
        

      
        
        
        

        
         
        echo view('nuevo_proyecto',$data);

    }

    public function editar_proyecto($id){
        helper(['form', 'url']);

        $proyecto = $this->db->table('proyectos')->where('id',$id)->get()->getRowArray();

        if($this->request->getPost('guardar')){
            $validando = $this->validate([
                'proyecto' => 'required',
                'tipo' => 'required',
                'cliente' => 'required'

            ]);
            $proyecto = [
                'proyecto' => $this->request->getPost('proyecto'),
                'tipo' => $this->request->getPost('tipo'),
                'cliente' => $this->request->getPost('cliente')
            ];
            
            if(!$validando){
                $data['validation'] = $this->validator;
            }else{
                $this->db->table('proyectos')->where('id',$id)->update($proyecto);
                return $this->response->redirect(base_url('Home/proyectos'));
            }
            
            

            
        }



        $data['validation'] = \Config\Services::validation();
        $data['proyecto'] = $proyecto;

        echo view('nuevo_proyecto',$data);
    }

    public function eliminar_proyecto($proyecto){
        $query = $this->db->table('bitacoras')->select('*,(SELECT CONCAT(proyecto) as proyecto FROM proyectos WHERE proyectos.id=bitacoras.proyecto) AS proyecto', false)
        ->where('proyecto',$proyecto)
        ->get();
        

        if(empty($query)){
            $this->db->table('proyectos')->where('id',$proyecto)->delete();
            return $this->response->redirect(base_url('Home/proyectos'));
        }else{
            return $this->response->redirect(base_url('Home/proyectos'));
        }

    }

    
    public function clientes(){
        helper(['formdate','url']);

        $pager = \Config\Services::pager();
        $page = ($this->request->getGet('page') > 0 ) ? $this->request->getGet('page') : 1;

        $limit = 20;
        $offset = ($page * $limit) - $limit;

        $total = $this->db->table('clientes')->countAllResults();
        $query = $this->db->table('clientes')
        ->limit($limit,$offset)
        ->get();

        $data = [
            'pagination' => $pager->makeLinks($page, $limit, $total),
            'clientes' => $query->getResult()
            
        ];

		$data['id'] = $this->session->id;
        $data['status'] = $this->session->asignacion;
        

        
        
        

        
        echo view('clientes',$data);

    }

    public function nuevo_cliente(){
        helper(['form', 'url']);
        
        if($this->request->getPost('guardar')){
            $validando = $this->validate([
                'cliente' => 'required'

            ]);
            $cliente = [
                'cliente' => $this->request->getPost('cliente')
            ];
            
            if(!$validando){
                $data['validation'] = $this->validator;
            }else{
                $this->db->table('clientes')->insert($cliente);
                return $this->response->redirect(base_url('Home/clientes'));
            }
            
            

            
        }else{
            $cliente = [
                'cliente' => ""
            ];
            $data['enviado'] = "no";
        }
        
        
        
        
        
        $data['validation'] = \Config\Services::validation();
        
        $data['cliente'] = $cliente;
        

      
        
        
        

        
         
        echo view('nuevo_cliente',$data);

    }

    public function editar_cliente($id){
        helper(['form', 'url']);

        $cliente = $this->db->table('clientes')->where('id',$id)->get()->getRowArray();

        if($this->request->getPost('guardar')){
            $validando = $this->validate([
                
                'cliente' => 'required'

            ]);
            $cliente = [
                'cliente' => $this->request->getPost('cliente')
            ];
            
            if(!$validando){
                $data['validation'] = $this->validator;
            }else{
                $this->db->table('clientes')->where('id',$id)->update($cliente);
                return $this->response->redirect(base_url('Home/clientes'));
            }
            
            

            
        }



        $data['validation'] = \Config\Services::validation();
        $data['cliente'] = $cliente;

        echo view('nuevo_cliente',$data);
    }

    public function eliminar_cliente($cliente){
        $query = $this->db->table('bitacoras')->select('*,(SELECT CONCAT(cliente) as cliente FROM clientes WHERE clientes.id=bitacoras.cliente) AS cliente', false)
        ->where('cliente',$cliente)
        ->get();
        

        if(empty($query)){
            $this->db->table('clientes')->where('id',$cliente)->delete();
            return $this->response->redirect(base_url('Home/clientes'));
        }else{
            return $this->response->redirect(base_url('Home/clientes'));
        }

    }



    

	public function user(){
        if($this->session->logueado == true){
            return "Bienvenido, {$this->session->nombre} | ";
        }else{
            return "";
        }
        
    }
}
