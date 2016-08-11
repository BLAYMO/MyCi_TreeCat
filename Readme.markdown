***MyCi_TreeCat***

Demo de aplicacion de PHP7 + Codeigniter 3.1.0 + jQtree + Datatables + Bootstrap para el mantenimiento de una tabla de categorías y subcategorías. He empleado la libreria ***Qtree*** para visualizar el arbol de categorías y ***Datatables*** para el mantenimiento de la tabla de categorías y subcategorías.
El número de subcategorías es ilimitado. Básicamente la aplicación lee los datos de la tabla "cat_producto.sql" (MySql) y los prepara en "data/arbol.json" para presentarlos después en pantalla.
En controller Main, el código que genera el arbol es el siguiente:
```php
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
    
```

El código que lo presenta es el siguiente:
```php
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
```

Todo se ha desarrollado bajo el 'pattern' HMVC, estando los controladores en la  carpeta '/modules'.
La instalción es muy sencilla:

    - Descargar el zip.
    - Descomprimirlo en la carpeta raiz del servidor web.
    - Configurar database.php con los datos de accesso a mysql.

La estructura de la tabla de categorias esta en 'myci_treecat.sql'.

Todo el código se distibuye bajo licencia MIT. Las librerías de terceros se distribuyen con sus respectivas licencias que figuran en la carpeta '/assets'.

He empleado para HMVC: https://bitbucket.org/wiredesignz/codeigniter-modular-extensions-hmvc

Tambien he utilizado parte del código generado por el generador CRUD de:https://bitbucket.org/harviacode/codeigniter-crud-generator

Mi profundo reconocimiento a todos los colaboradores de GitHub, sin los cuales sería imposible avanzar en la programación.

Agradezco cualquier sugerencia, comentario y corrección de errores. 
Ni que decir tiene que el código que he depositado en este repositorio es infinitamente mejorable y optimizable.
Todo se ha desarrollado con 'corazón' y para ser compartido.

[expresoWeb](https://expresoweb.joomla.com "")

[Mail](expresoweb2015@gmail.com "")


Vistas de la aplicación:
![pantalla_main.png](https://github.com/BLAYMO/MyCi_TreeCat/assets/pantalla_main.png "")


![pantalla_main2.png](https://github.com/BLAYMO/MyCi_TreeCat/assets/pantalla_main2.png "") 
