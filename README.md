# MyCi_TreeCat
Demo de aplicacion de Codeigniter 3.1.0 + jQtree + Datatables + Bootstrap para el mantenimiento de una tabla de categorías
y subcategorías.
He empleado la libreria jQtree para visualizar el arbol de categorías y Datatables para el mantenimiento de la tabla de categorías
y subcategorías. El número de subcategorías es ilimitado.
Básicamente la aplicación lee los datos de la tabla "cat_producto.sql" y los prepara en "data/arbol.json" para presentarlos después en pantalla.
En controller Main, el código que genera el arbol es el siguiente:
**********************************************************************************************************************
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
        
    }

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
    
**************************************************************************************************************
Utilizo jQtree para leer el "arbol.json" y presentar en pantalla el árbol de categorías y Datatables para el CRUD de la tabla "cat_productos".
Todo el codigo realizado se publica bajo licencia MIT. 
Las librerías de terceros se publican con sus respectivas licencias que figuran en /assets/jQtree ... etc.
He empleado parte del código generado por https://bitbucket.org/harviacode/codeigniter-crud-generator, para los scripts de mantenimiento de la tabla de categorías.

Agradezco cualquier sugerencia, mejora, detección de errores,...etc.
expresoweb2015@gmail.com.
https://expresoweb.joomla.com
