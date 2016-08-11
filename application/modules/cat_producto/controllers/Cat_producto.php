<?php

/* * **********************************************************
 * The MIT License
 *
 * Copyright 2016 Blas Monerris Alcaraz.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
  --------------------- xxxxxx -------------------------

  @Proyecto: MyCi_Proyecto
  @Autor:    Blas Monerris Alcaraz
  @Objeto:   Aprendizaje/Desarrollo
  @Comienzo: 09-08-2016
  @licencia  http://opensource.org/licenses/MIT  MIT License
  @link      https://expresoweb.joomla.com
  @Version   1.0.1

  @mail: expresoweb2015@gmail.com

  PHP7 + Codeigniter 3.1.0 + Bootstrap v3.1.1 + JqTree 1.3.3 + Datatables 1.10.0-dev

  Demo de aplicacion de jQtree + Datatables + MySql

  Script creado el 09-08-2016
 * ******************************************************************** */
defined('BASEPATH') OR exit('No direct script access allowed'); 


class Cat_producto extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Cat_producto_model');
        $this->load->library('form_validation');
        
    }

    public function index()
    {
        redirect(site_url('main/wcatprod'));
    }
    
    // presenta las categorias en una tabla
        public function wcatprod()
	{
            $this->load->model('Cat_producto_model');
            $cat_hijo  = $this->Cat_producto_model->get_all_menu_hijo();
            $cat_padre = $this->Cat_producto_model->get_all_menu_padre();

            $data = array(
                'cat_padre_data' => $cat_padre,
                'cat_hijo_data'  => $cat_hijo
            );
            
            $data['edita'] = 'NO';
            $this->load->view('wcrud_categorias', $data);
                                    
	}
        //realiza el mantenimiento de la tabla de categorias
        public function catprod()
	{
            $this->load->model('cat_producto/Cat_producto_model');
            $cat_hijo  = $this->Cat_producto_model->get_all_menu_hijo();
            $cat_padre = $this->Cat_producto_model->get_all_menu_padre();

            $data = array(
                'cat_padre_data' => $cat_padre,
                'cat_hijo_data'  => $cat_hijo
            );
            
            $this->session->set_flashdata('message', '<strong><small>Mantenimiento de la tabla de categorias</small></strong>'); 
            $data['edita'] = 'SI';
            $this->load->view('main/header_main');
            $this->load->view('main/nav_main');
            $this->load->view('main/body_container');
            $this->load->view('wcrud_categorias', $data);
            $this->load->view('main/footer_admin_cat');
                                    
	}
        
    public function read_p($id) 
    {
        
        $row = $this->Cat_producto_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_categoria' => $row->id_categoria,
		'id_padre' => $row->id_padre,
		'tiene_hijos' => $row->tiene_hijos,
		'categoria' => $row->categoria,               
		'descripcion_cat' => $row->descripcion_cat,		
		'nivel' => $row->nivel,
	    );
            $this->load->view('main/header_main');                               
            $this->load->view('cat_producto/cat_producto_read_p', $data);                                    
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');            
            redirect(site_url('catprod'));
        }
    }
    
    
    public function read_h($id,$idPadre) 
    {
        $rowp = $this->Cat_producto_model->get_by_id($idPadre);
        $row = $this->Cat_producto_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_categoria' => $row->id_categoria,
		'id_padre' => $row->id_padre,
		'tiene_hijos' => $row->tiene_hijos,
		'categoria' => $row->categoria,
                'cat_padre' => set_value('cat_padre',$rowp->categoria),
		'descripcion_cat' => $row->descripcion_cat,		
		'nivel' => $row->nivel,
	    );
            $this->load->view('main/header_main');
            
            if ($idPadre != 0){
                $this->load->view('cat_producto/cat_producto_read_h', $data);            
            }else { $this->load->view('cat_producto/cat_producto_read_p', $data);}
                                    
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('catprod'));
        }
    }

    
    // crea categoria padre
    public function create() 
    {
        $data = array(
            'button' => 'Nueva',
            'action' => site_url('cat_producto/create_action/0'),
	    'id_categoria' => set_value('id_categoria'),
	    'id_padre' => set_value('id_padre',0),
	    'tiene_hijos' => set_value('tiene_hijos','NO'),
	    'categoria' => set_value('categoria'),
	    'descripcion_cat' => set_value('descripcion_cat','Descripcion de la categoria'),
	    'alta' => set_value('alta',ahora()),
	    'baja' => set_value('baja'),
	    'modificado' => set_value('modificado'),
            'nivel' => set_value('nivel',0),
	);
        $this->load->view('cat_producto/cat_producto_form_p', $data);
    }
    
    //crea categoria hija
    public function create_h($idPadre) 
    {
        //leo datos de categoria padre
        $row = $this->Cat_producto_model->get_by_id($idPadre);
        
        $data = array(
            'button' => 'Nueva',
            'action' => site_url('cat_producto/create_action/'.$idPadre),
	    'id_categoria' => set_value('id_categoria'),
	    'id_padre' => set_value('id_padre',$idPadre),
            'cat_padre' => set_value('cat_padre',$row->categoria),
	    'tiene_hijos' => set_value('tiene_hijos','NO'),
	    'categoria' => set_value('categoria'),
	    'descripcion_cat' => set_value('descripcion_cat'),
	    'alta' => set_value('alta',  ahora()),
	    'baja' => set_value('baja'),
	    'modificado' => set_value('modificado'),
            'nivel' =>  set_value('nivel',++$row->nivel),
	);        
        $this->load->view('cat_producto/cat_producto_form_h', $data);
    }
    
    public function create_action($idPadre) 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id_padre' => $this->input->post('id_padre',TRUE),
		'tiene_hijos' => $this->input->post('tiene_hijos',TRUE),
		'categoria' => $this->input->post('categoria',TRUE),
		'descripcion_cat' => $this->input->post('descripcion_cat',TRUE),
		'alta' => $this->input->post('alta',TRUE),
		'baja' => $this->input->post('baja',TRUE),
		'modificado' => $this->input->post('modificado',TRUE),
                'nivel' => $this->input->post('nivel',TRUE),
	    );

            $this->Cat_producto_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            if ($idPadre != 0){$this->update_si_root($idPadre);}
            
            redirect(site_url('catprod'));
        }
    }
    
    //edit categoria padre
    public function update_p($id) 
    {
        $row = $this->Cat_producto_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Modificar',
                'action' => site_url('cat_producto/update_action'),
		'id_categoria' => set_value('id_categoria', $row->id_categoria),
		'id_padre' => set_value('id_padre', $row->id_padre),
		'tiene_hijos' => set_value('tiene_hijos', $row->tiene_hijos),
		'categoria' => set_value('categoria', $row->categoria),
		'descripcion_cat' => set_value('descripcion_cat', $row->descripcion_cat),
		'alta' => set_value('alta', $row->alta),
		'baja' => set_value('baja', $row->baja),
		'modificado' => set_value('modificado', ahora()),
                'nivel' => set_value('nivel', $row->nivel),
	    );
            $this->load->view('cat_producto/cat_producto_form_p', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('catprod'));
        }
    }
    
    public function update_h($id,$idPadre) 
    {
        //leo datos de categoria padre
        $rowp = $this->Cat_producto_model->get_by_id($idPadre);
        $row  = $this->Cat_producto_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Modificar',
                'action' => site_url('cat_producto/update_action'),
		'id_categoria' => set_value('id_categoria', $row->id_categoria),
		'id_padre' => set_value('id_padre', $row->id_padre),
                'cat_padre' => set_value('cat_padre',$rowp->categoria),
		'tiene_hijos' => set_value('tiene_hijos', $row->tiene_hijos),
		'categoria' => set_value('categoria', $row->categoria),
		'descripcion_cat' => set_value('descripcion_cat', $row->descripcion_cat),
		'alta' => set_value('alta', $row->alta),
		'baja' => set_value('baja', $row->baja),
		'modificado' => set_value('modificado', ahora()),
                'nivel' => set_value('nivel', $row->nivel),
	    );
            $this->load->view('cat_producto/cat_producto_form_h', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('catprod'));
        }
    }
    
    public function update_si_root($idPadre) 
    {    
        
        $data = array(		
            'tiene_hijos' => 'SI',		
            'modificado' => ahora(),
        );

        $this->Cat_producto_model->update($idPadre, $data);
        $this->session->set_flashdata('message', 'Update Record Success');       
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_categoria', TRUE));
        } else {
            $data = array(
		'id_padre' => $this->input->post('id_padre',TRUE),
		'tiene_hijos' => $this->input->post('tiene_hijos',TRUE),
		'categoria' => $this->input->post('categoria',TRUE),
		'descripcion_cat' => $this->input->post('descripcion_cat',TRUE),
		'alta' => $this->input->post('alta',TRUE),
		'baja' => $this->input->post('baja',TRUE),
		'modificado' => $this->input->post('modificado',TRUE),
                'nivel' => $this->input->post('nivel',TRUE),
	    );

            $this->Cat_producto_model->update($this->input->post('id_categoria', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('catprod'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Cat_producto_model->get_by_id($id);

        if ($row) {
            $this->Cat_producto_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('catprod'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('catprod'));
        }
    }

    public function _rules() 
    {	
	$this->form_validation->set_rules('categoria', 'categoria', 'trim|required|alpha_numeric_spaces');
	$this->form_validation->set_rules('descripcion_cat', 'descripcion cat', 'trim|alpha_numeric_spaces');			
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}
