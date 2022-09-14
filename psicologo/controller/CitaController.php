<?php
class CitaController {
    public function index() {
        $this->list(); //redirige a la lista de citas
    }
    
    //operación para listar todas las citas
    public function list(){
        //recuperar la lista de citas
        $citas = V_cita::get();
        
        //cargar la vista que muestra el listado
        include '../views/cita/lista.php';
    }
    
    //método para mostrar los detalles de una cita
    public function show(int $id=0){
        //comprobar que recibimos el id de la cita por parámetro
        if (!$id) {
            throw new Exception("No se indicó la cita");
        }
        
        //recuperar la cita con dicho código
        $cita = V_cita::getById($id);
        
        //comprobar que la cita se haya recuperado correctamente de la BDD
        if (!$cita) {
            throw new Exception("No se ha encontrado la cita $id");
        }
        
        //cargar la vista de detalles
        include '../views/cita/detalles.php';
    }
    
    //método para guardar una nueva cita
    //PASO 1: muestra el formulario de nueva cita
    public function create($id){
        
        Paciente::getById($id);
        $pacientes = Paciente::get();
        
        include '../views/cita/nuevo.php';
    }
    
    //PASO 2: guarda la nueva cita
    public function store(){
        //comprueba que llegue el formulario con los datos
        if (empty($_POST['guardar'])) {
            throw new Exception('No se recibieron datos');
        }
        
        $cita = new Cita(); //crea una nueva cita
        
        //recupera los datos del formulario que llegan por POST
        $cita->fecha = $_POST['fecha'];
        $cita->hora = $_POST['hora'];
        $cita->duracion = $_POST['duracion'];
        $cita->idpaciente = $_POST['idpaciente'];
        
        $cita->guardar(); //guarda la cita en BDD (si falla lanza excepción)
        
        $mensaje="Guardado de la cita $cita->fecha $cita->idpaciente correcto.";
        include '../views/exito.php'; //muestra la vista de éxito
    }
    
    //método para actualizar una cita
    //PASO 1: muestra el formulario de edici�n de una cita
    public function edit(int $id=0){
        //comprueba que llega el id de la cita a editar
        if (!$id){
            throw new Exception("No se indicó la cita");
        }
        
        //recupera la cita con dicho identificador
        $cita = Cita::getById($id);
        
        //comprueba que la cita se pudo recuperar de la BDD
        if (!$cita) {
            throw new Exception("No existe la cita $id.");
        }
        
        //carga la vista del formulario
        include '../views/cita/actualizar.php';
    }
    
    //PASO 2: aplica los cambios que vienen del formulario a la BDD
    public function update(){
        
        //comprueba que llegue el formulario con los datos
        if (empty($_POST['actualizar'])) {
            throw new Exception('No se recibieron datos');
        }
        
        $id= intval($_POST['id']); //recuperar el id vía POST
        $cita = Cita::getById($id); //recupera la cita desde la BDD
        
        if (!$cita) {
            throw new Exception("No se encontrado la cita $id.");
        }
        
        //recuperar el resto de campos
        $cita->fecha = $_POST['fecha'];
        $cita->hora = $_POST['hora'];
        $cita->duracion = $_POST['duracion'];
        
        try {
            $cita->actualizar(); //actualiza en BDD, si falla lanza excepción.
            $GLOBALS['success'] = "Actualización de la cita correcta.";
            
        } catch (Exception $e) {
            $GLOBALS['error'] = "No se pudo actualizar la cita.";
            
        } finally {
            //repite la operación edit, así mantendrá al usuario en la vista de edición.
            $this->edit($cita->id);
        }
        
        //NOTA 1: pongo los mensajes globales para disponer de ellos en las vistas
        //NOTA 2: cuando hagas pruebas, prueba a cambiar el edit por "show" o "list"...
    }
    
    //método para eliminar una cita
    //Eliminar se hace en 2 pasos si queremos hacerlo con formulario de confirmación
    //PASO 1: muestra el formulario de confirmación de eliminación
    public function delete(int $id=0){
        
        //comprueba que me llega el identificador
        if (!$id){
            throw new Exception('No se indicó la cita a borrar.');
        }
        
        //recupera la cita con dicho identificador
        $cita = Cita::getById($id);
        
        //comprueba que la cita existe
        if (!$cita){
            throw new Exception("No existe la cita $id ");
        }
        
        //ir al formulario de confirmación
        include '../views/cita/borrar.php';
    }
    
    //PASO 2: elimina la cita
    public function destroy(){
        
        //comprueba que llegue el formulario de confirmación
        if (empty($_POST['borrar'])) {
            throw new Exception('No se recibió confirmación');
        }
        
        //recupera el identificador vía POST
        $id = intval($_POST['id']);
        
        //intenta borrar la cita de la BDD
        if (Cita::borrar($id)===FALSE) {
            throw new Exception('No se pudo borrar');
        }
        
        //muestra la vista de �xito
        $mensaje="Borrado de la cita $id correcto.";
        include '../views/exito.php'; //mostrar éxito
    }
}