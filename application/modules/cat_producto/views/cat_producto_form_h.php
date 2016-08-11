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
      <title>Categorias/CRUD/Node</title>
      <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
      <link type="text/css" rel="stylesheet" href="<?=base_url()?>assets/blaymo.css" />
      <link rel="icon" href="<?=base_url()?>favicon.ico">
      <style>
         body{
         padding: 15em;
         }
      </style>
   </head>
   <body>
      <div class="panel panel-primary">
         <div class="panel-heading">
            <h3 class="panel-title"><?php echo $button ?> Categoria Hija</h3>
         </div>
         <div class="panel-body">            
            <form action="<?php echo $action; ?>" method="post" accept-charset="UTF-8">
               <div class="form-group">                  
                  <label>Categoria padre <?php echo $id_padre.', '.$cat_padre ?></label>                  
               </div>              
               <div class="form-group">
                  <label for="varchar">Categoria <?php echo form_error('categoria') ?></label>
                  <input type="text" class="form-control" name="categoria" id="categoria" placeholder="Categoria" value="<?php echo $categoria; ?>" />
               </div>
               <div class="form-group">
                  <label for="varchar">Descripcion <?php echo form_error('descripcion') ?></label>
                  <input type="text" class="form-control" name="descripcion_cat" id="descripcion" placeholder="Descripcion" value="<?php echo $descripcion_cat; ?>" />
               </div>                
               <input type="hidden" name="id_padre"  value="<?php echo $id_padre; ?>"/>
               <input type="hidden" name="tiene_hijos" value="<?php echo $tiene_hijos; ?>"/>  
               <input type="hidden" name="nivel" id="nivel" value="<?php echo $nivel; ?>" />                
               <input type="hidden" name="modificado" id="modificado" value="<?php echo $modificado; ?>" />
               <input type="hidden" name="baja" id="baja" value="<?php echo $baja; ?>" />
               <input type="hidden" name="alta" id="alta" value="<?php echo $alta; ?>" />
               <input type="hidden" name="id_categoria" value="<?php echo $id_categoria; ?>" /> 
               <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
               <a href="<?php echo site_url('catprod') ?>" class="btn btn-default">Cancel</a>
            </form>
         </div>
         <div class="panel-footer">Pie de pagina</div>
      </div>
   </body>
</html>

