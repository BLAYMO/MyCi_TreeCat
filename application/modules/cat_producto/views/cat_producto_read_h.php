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
defined('BASEPATH') OR exit('No direct script access allowed');?> 


<!doctype html>
<html>
   <head>
      <title>Categoria Hija/Read</title>
      <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
      <style>
         body{
         padding: 15em;
         }
      </style>
   </head>
   <body>
      <div class="panel panel-info">
         <div class="panel-heading">
            <h3 class="panel-title">Datos Categoria Hija</h3>
         </div>
         <div class="panel-body">
            <table class="table table-bordered table-condensed table-responsive">
               <tr>
                  <td>Cat.Padre</td>
                  <td><?php echo $cat_padre; ?></td>
               </tr>               
               <tr>
                  <td>Categoria</td>
                  <td><?php echo $categoria; ?></td>
               </tr>
               <tr>
                  <td>Descripcion Categoria</td>
                  <td><?php echo $descripcion_cat; ?></td>
               </tr>
               <tr>
                  <td>Tiene Hijos</td>
                  <td><?php echo $tiene_hijos; ?></td>
               </tr>
               <tr>
                  <td>Nivel</td>
                  <td><?php echo $nivel; ?></td>
               </tr>
            </table>
         </div>
         <div class="panel-footer">
            <a href="<?php echo site_url('main') ?>" class="btn btn-primary">Home</a></td>         
         </div>
      </div>
   </body>
</html>

