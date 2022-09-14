<?php
class DolenciaController {
    public function index() {
        $this->list(); //redirige a la lista de dolencias
    }
    
    //operación para listar todas las dolencias
    public function list(){
        //recuperar la lista de dolencias
        $dolencias = Dolencia::get();
        
        //cargar la vista que muestra el listado
        include '../views/dolencia/lista.php';
    }
    
    //método para mostrar los detalles de una dolencia
    public function show(int $id=0){
        //comprobar que recibimos el id de la dolencia por parámetro
        if (!$id) {
            throw new Exception("No se indicó la dolencia");
        }
        
        //recuperar la dolencia con dicho código
        $dolencia = Dolencia::getById($id);
        
        //comprobar que la dolencia se haya recuperado correctamente de la BDD
        if (!$dolencia) {
            throw new Exception("No se ha encontrado la dolencia $id");
        }
        
        //cargar la vista de detalles
        include '../views/dolencia/detalles.php';
    }
    
    //método para guardar una nueva dolencia
    //PASO 1: muestra el formulario de nueva dolencia
    public function create(){
        include '../views/dolencia/nuevo.php';
    }
    
    //PASO 2: guarda la nueva dolencia
    public function store(){
        //comprueba que llegue el formulario con los datos
        if (empty($_POST['guardar'])) {
            throw new Exception('No se recibieron datos');
        }
        
        $dolencia = new Dolencia(); //crea una nueva dolencia
        
        //recupera los datos del formulario que llegan por POST
        $dolencia->nombre = $_POST['nombre'];
        $dolencia->descripcion = $_POST['descripcion'];
        $dolencia->tratamiento = $_POST['tratamiento'];
        
        $dolencia->guardar(); //guarda la dolencia en BDD (si falla lanza excepción)
        
        $mensaje="Guardado de la dolencia $dolencia->nombre correcto.";
        include '../views/exito.php'; //muestra la vista de éxito
    }
    
    //m�todo para actualizar una dolencia
    //PASO 1: muestra el formulario de edici�n de una dolencia
    public function edit(int $id=0){
        //comprueba que llega el id de la dolencia a editar
        if (!$id){
            throw new Exception("No se indicó la dolencia");
        }
        
        //recupera la dolencia con dicho identificador
        $dolencia = Dolencia::getById($id);
        
        //comprueba que la dolencia se pudo recuperar de la BDD
        if (!$dolencia) {
            throw new Exception("No existe la dolencia $id.");
        }
        
        //carga la vista del formulario
        include '../views/dolencia/actualizar.php';
    }
    
    //PASO 2: aplica los cambios que vienen del formulario a la BDD
    public function update(){
        
        //comprueba que llegue el formulario con los datos
        if (empty($_POST['actualizar'])) {
            throw new Exception('No se recibieron datos');
        }
        
        $id= intval($_POST['id']); //recuperar el id vía POST
        $dolencia = Dolencia::getById($id); //recupera la dolencia desde la BDD
        
        if (!$dolencia) {
            throw new Exception("No se encontrado la dolencia $id.");
        }
        
        //recuperar el resto de campos
        $dolencia->nombre = $_POST['nombre'];
        $dolencia->descripcion = $_POST['descripcion'];
        $dolencia->tratamiento = $_POST['tratamiento'];
        
        try {
            $dolencia->actualizar(); //actualiza en BDD, si falla lanza excepción.
            $GLOBALS['success'] = "Actualización de la dolencia $dolencia->nombre correcta.";
            
        } catch (Exception $e) {
            $GLOBALS['error'] = "No se pudo actualizar la dolencia $dolencia->nombre.";
            
        } finally {
            //repite la operación edit, así mantendrá al usuario en la vista de edición.
            $this->edit($dolencia->id);
        }
        
        //NOTA 1: pongo los mensajes globales para disponer de ellos en las vistas
        //NOTA 2: cuando hagas pruebas, prueba a cambiar el edit por "show" o "list"...
    }
    
    //método para eliminar una dolencia
    //Eliminar se hace en 2 pasos si queremos hacerlo con formulario de confirmación
    //PASO 1: muestra el formulario de confirmación de eliminación
    public function delete(int $id=0){
        
        //comprueba que me llega el identificador
        if (!$id){
            throw new Exception('No se indicó la dolencia a borrar.');
        }
        
        //recupera la dolencia con dicho identificador
        $dolencia = Dolencia::getById($id);
        
        //comprueba que la dolencia existe
        if (!$dolencia){
            throw new Exception("No existe la dolencia $id ");
        }
        
        //ir al formulario de confirmación
        include '../views/dolencia/borrar.php';
    }
    
    //PASO 2: elimina la dolencia
    public function destroy(){
        
        //comprueba que llegue el formulario de confirmación
        if (empty($_POST['borrar'])) {
            throw new Exception('No se recibió confirmación');
        }
        
        //recupera el identificador vía POST
        $id = intval($_POST['id']);
        
        //intenta borrar la dolencia de la BDD
        if (Dolencia::borrar($id)===FALSE) {
            throw new Exception('No se pudo borrar');
        }
        
        //muestra la vista de �xito
        $mensaje="Borrado de la dolencia $id correcto.";
        include '../views/exito.php'; //mostrar éxito
    }
}