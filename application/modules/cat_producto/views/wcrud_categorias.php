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

<!--<body style="padding: 5em;">-->
<!--<div class="container-fluid">-->
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <h4 style="margin-top:0px">Categorias</h4>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <?php if ($edita == 'SI'){echo anchor(site_url('cat_producto/create'), '[+] Cat. Padre', 'class="btn btn-primary"');} ?>                
	    </div>
        </div>
        <table class="table table-bordered table-responsive table-striped" id="mytablecat">
            <thead>
                <tr>                   
		    <th>Nivel-Categoria</th>
		    <th>SubCat</th>		   		   
                </tr>
            </thead>
	    <tbody>
            <?php
            
            $start = 0;
            foreach ($cat_padre_data as $cat_padre)
            {
                ++$start;
                ?>
                <tr>		    	    		    
                    <td><?php echo $cat_padre->nivel.'-'.$cat_padre->categoria ?><br/><small><?=$cat_padre->descripcion_cat?></small><br/><hr>
                         <div style="text-align:center">
                        <?php 
                        if ($edita == 'SI'){echo anchor(site_url('cat_producto/create_h/'.$cat_padre->id_categoria),'[+] SubCat').'<br/>';}
                        if ($edita == 'SI'){echo anchor(site_url('cat_producto/update_p/'.$cat_padre->id_categoria),'Edit').'<br/>';} 
                         echo anchor(site_url('cat_producto/read_p/'.$cat_padre->id_categoria),'Read'); 
			?>
                         </div>
                    </td>
		    <td>                        
                        <!----------------- tabla cat hijas--------------->
                        <?php
                            if ($cat_padre->tiene_hijos == 'SI'){
                            tabla_hija($cat_padre->id_categoria,$cat_hijo_data,$edita);} ?>
                        <!-------------------- fin tabla hijas --------------------->
                    </td>		  		    
	        </tr>
                <?php
            }
            ?>
            </tbody>
        </table>    
        
        <script>
        <?php
            function tabla_hija($id_cat_padre,$oDatosHija,$edita)
            {?>
                <table class="table table-bordered table-responsive table-striped" id="mytablehija" style="font-size: 100%">
                            <thead>
                            <tr>                               
                                <th>Categoria</th>
                                <th>SubCat</th>		                                  
                            </tr>
                        </thead>
                        <tbody>
                        <?php                        
                        foreach ($oDatosHija as $cat_hijo)
                        {
                            if($id_cat_padre == $cat_hijo->id_padre){
                            ?>
                            <tr>                                
                                <td><?php echo $cat_hijo->nivel.'-'.$cat_hijo->categoria ?><br/><small><?=$cat_hijo->descripcion_cat?></small><br/><hr>
                                <div style="text-align:center">
                                <?php 
                                    if ($edita == 'SI'){echo anchor(site_url('cat_producto/create_h/'.$cat_hijo->id_categoria),'[+] SubCat').'<br/>';}
                                    if ($edita == 'SI'){echo anchor(site_url('cat_producto/update_h/'.$cat_hijo->id_categoria.'/'.$id_cat_padre),'Edit').'<br/>';}
                                    echo anchor(site_url('cat_producto/read_h/'.$cat_hijo->id_categoria.'/'.$id_cat_padre),'Read'); 
                                    ?>
                                </div>
                                </td>
                                <td>
                                    <?php
                                        if ($cat_hijo->tiene_hijos == 'SI'){
                                        tabla_hija($cat_hijo->id_categoria,$oDatosHija,$edita);} ?>         
                                </td>                               
                            </tr>                                                            
                            <?php }
                            else {
                                //echo anchor(site_url('cat_producto/create_h/'.$cat_hijo->id_categoria),'[+] SubCat'); 
                            }
                        }
                        ?>
                        </table>                    
            <?php }                
        ?>
        </script>
        
        
       
<!--</div>-->
 <!--</body>-->
<!--</html>-->    
    
