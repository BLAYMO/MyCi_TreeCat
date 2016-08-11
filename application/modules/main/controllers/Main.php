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
 

class Main extends MX_Controller {
        
        var $menu;
        var $indice;
        var $add;
        
        function __construct()
        {
            parent::__construct();                       
            $this->initVar();            
        }
	
	public function index()
	{
            $data = array();
            if (!read_file(base_url().'data/arbol.json'))
            {
                $data['arbol_menu'] = $this->crea_arbol();
                
            } else {
                 // la siguiente linea es para la lectura de datos desde un fichero json
                $data['arbol_menu'] = file_get_contents(base_url().'data/arbol.json');}
            
            $this->session->set_flashdata('message', '<strong><small>Vista de categorias como Tabla</small></strong>'); 
            $this->load->view('header_main');
            $this->load->view('body_main',$data);            
	}
                 
        //Inicializa array de menu
        private function initVar() {
            $this->menu = array();
            $this->indice = array(); //array de indice para evitar duplicados
            $this->add = 0;                      
        }
        
                                  
        //crea el arbol de categorias para jqtree      
        public function crea_arbol()
        {
         //creo fichero json para arbol de menu
            
            $this->load->model('cat_producto/Cat_producto_model');
            $menu_padre = $this->Cat_producto_model->get_all_menu_padre();
            
            $n = 0;$rto = array(); 
            foreach ($menu_padre as $value) {
                //in_aray() no funciona en arrays multidimensionales.
                //para evitar duplicados he creado in array simple que 
                //hace de indice
                
                if(!in_array($value->id_categoria, $this->indice )){
                    $this->menu[$n]['name']           = utf8_encode($value->categoria);
                    $this->menu[$n]['id']             = $value->id_categoria;               
                    $this->indice[++$this->add]       = $value->id_categoria; 
                    
                    if ($value->tiene_hijos == 'SI'){
                        $rto = $this->nodo_hijo($value->id_categoria);
                        if ($rto != []){
                            $this->menu[$n]['children'] = $rto;}
                    }//fin if
                    ++$n;
                } //fin if
            }//fin foreach
            
            $jsonvar = json_encode($this->menu ,JSON_PRETTY_PRINT );
            
            if (!write_file('./data/arbol.json', $jsonvar))
            {                
                $this->session->set_flashdata('message', 'Error. Arbol de categorias no creado');  
            }
                        
            $this->initVar();
            return $jsonvar;
        
    }//fin crea_arbol

    /* ***************************************
     * crea el nodo hijo        
     * recibe id de la categoria padre         
     *****************************************/
    private function nodo_hijo($idPadre) {
        //leo las categorias hijas de idPadre
        $menu_hijo  = $this->Cat_producto_model->get_solo_hijo($idPadre);
        $j = 0; $hijo = array(); 
        foreach ($menu_hijo as $value2)
        {
            $hijo[$j]['name']             = utf8_encode($value2->categoria);
            $hijo[$j]['id']               = $value2->id_categoria;                    
            $this->indice[++$this->add]   = $value2->id_categoria; 
                if ($value2->tiene_hijos == 'SI'){
                    //empleo recursividad
                    $hijo[$j]['children'] = $this->nodo_hijo($value2->id_categoria);
                }
            ++$j; 
        }//fin foreach

        return $hijo;
    }//fin nodo_hijo
   
        
}//fin class

