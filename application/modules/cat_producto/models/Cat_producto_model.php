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

class Cat_producto_model extends CI_Model
{

    public $table = 'cat_producto';
    public $id = 'cat_producto.id_categoria';
    public $order = 'ASC';

    function __construct()
    {
        parent::__construct();       
    }

    // get all
    function get_all()
    {
        //$this->db->order_by($this->id, $this->order);
        $this->db->order_by('id_padre,nivel', $this->order);
        return $this->db->get($this->table)->result();
    }
    
    // get all catgorias para menu raiz
    function get_all_menu_padre()
    {    

        $this->db->where('cat_producto.id_padre',0);
        $this->db->order_by($this->id, 'ASC');
        return $this->db->get($this->table)->result();
    }
    
    // get all categorias con id_padre <> 0
    function get_all_menu_hijo()
    {           

        $this->db->where_not_in('cat_producto.id_padre',0);
        $this->db->order_by('id_padre', 'ASC');
        return $this->db->get($this->table)->result();
    }
    
     // get all categorias menu hijo
    function get_solo_hijo($idPadre)
    {           
        $this->db->select('id_categoria,id_padre,categoria,tiene_hijos');
        $this->db->where('cat_producto.id_padre',$idPadre);
        $this->db->order_by('id_categoria', 'ASC');
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
        
    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}// fin class
