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



   <!-- Fixed navbar -->
   <?php require_once 'nav_main.php';?>
   <!--------------------------- fin nav ----------------------------->
   <div class="container">
      <div class="row">         
         <div class="col-md-3">
             <div class="well-sm">
                 <p><h5><strong>Vista en arbol</strong></h5></p>
            <div id="tree1"></div>
             </div>
         </div>         
         <div class="col-md-9">
             <div class="well-sm">
            <?php  echo Modules::run('cat_producto/Cat_producto/wcatprod'); ?> 
             </div>
         </div>
      </div>
   </div>
   <div class="container">
      <hr>
      <!-- Footer -->
      <footer>
         <div class="row">
            <div class="col-lg-12">
               <p>Copyright &copy; TreeCat 2016</p>
            </div>
         </div>
      </footer>
   </div>
   <!-- /.container -->
   <!----------------------------------------------------------------------->
   <script src="<?=base_url()?>assets/jquery/dist/jquery.min.js"></script>
   <script src="<?=base_url()?>assets/jqtree/tree.jquery.js"></script>
   <script src="<?=base_url()?>assets/bootstrap/js/bootstrap.min.js"></script>
   <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
   <script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
   <script type="text/javascript">
      //manejo arbol menu 
      var datos = eval(<?=$arbol_menu?>);
      $(function() {
        var $tree = $('#tree1');
        $tree.tree({
            data: datos,
            autoOpen: 1,
            onCreateLi: function(node, $li) {
                // Append a link to the jqtree-element div.
                // The link has an url '#node-[id]' and a data property 'node-id'.
                $li.find('.jqtree-element').append(
                    '<a href="<?=site_url('cat_producto/read_p')?>'+ '/' + node.id +'" class="edit" data-node-id="'+
                    node.id +'"> Sel</a>'
                );
            }
        });
      
      });
   </script>
    <script type="text/javascript">
        //manejo de tabla de categorias
            $(document).ready(function () {
                $("#mytablecat").dataTable( { responsive: true, lengthMenu: [ 2,4 ], searching: false });
            });
        </script>
</body>
</html>

