<?php
class PacienteController {
    public function index() {
        $this->list(); //redirige a la lista de pacientes
    }
    
    //operación para listar todos los pacientes
    public function list(){
        //recuperar la lista de pacientes
        $pacientes = V_paciente::get();
        
        //cargar la vista que muestra el listado
        include '../views/paciente/lista.php';
    }
    
    //método para mostrar los detalles de un paciente
    public function show(int $id=0){
        //comprobar que recibimos el id del paciente por parámetro
        if (!$id) {
            throw new Exception("No se indicó el paciente");
        }
        
        //recuperar el paciente con dicho código
        $paciente = V_paciente::getById($id);
        
        //comprobar que el paciente se haya recuperado correctamente de la BDD
        if (!$paciente) {
            throw new Exception("No se ha encontrado el paciente $id");
        }
        
        //cargar la vista de detalles
        include '../views/paciente/detalles.php';
    }
    
    //método para guardar un nuevo paciente
    //PASO 1: muestra el formulario de nuevo paciente
    public function create(){
        include '../views/paciente/nuevo.php';
    }
    
    //PASO 2: guarda el nuevo paciente
    public function store(){
        //comprueba que llegue el formulario con los datos
        if (empty($_POST['guardar'])) {
            throw new Exception('No se recibieron datos');
        }
        
        $paciente = new Paciente(); //crea un nuevo paciente
        
        //recupera los datos del formulario que llegan por POST
        $paciente->dni = $_POST['dni'];
        $paciente->nombre = $_POST['nombre'];
        $paciente->apellidos = $_POST['apellidos'];
        $paciente->poblacion = $_POST['poblacion'];
        
        $paciente->guardar(); //guarda el paciente en BDD (si falla lanza excepci�n)
        
        $mensaje="Guardado del paciente $paciente->nombre $paciente->apellidos correcto.";
        include '../views/exito.php'; //muestra la vista de �xito
    }
    
    //m�todo para actualizar un paciente
    //PASO 1: muestra el formulario de edici�n de un paciente
    public function edit(int $id=0){
        //comprueba que llega el id del paciente a editar
        if (!$id){
            throw new Exception("No se indic� el paciente");
        }
        
        //recupera el paciente con dicho identificador
        $paciente = Paciente::getById($id);
        
        //comprueba que el paciente se pudo recuperar de la BDD
        if (!$paciente) {
            throw new Exception("No existe el paciente $id.");
        }

        //carga la vista del formulario
        include '../views/paciente/actualizar.php';
    }
    
    //PASO 2: aplica los cambios que vienen del formulario a la BDD
    public function update(){
        
        //comprueba que llegue el formulario con los datos
        if (empty($_POST['actualizar'])) {
            throw new Exception('No se recibieron datos');
        }
        
        $id= intval($_POST['id']); //recuperar el id v�a POST
        $paciente = Paciente::getById($id); //recupera el paciente desde la BDD
        
        if (!$paciente) {
            throw new Exception("No se encontrado el paciente $id.");
        }
        
        //recuperar el resto de campos
        $paciente->dni = $_POST['dni'];
        $paciente->nombre = $_POST['nombre'];
        $paciente->apellidos = $_POST['apellidos'];
        $paciente->poblacion = $_POST['poblacion'];
        
        try {
            $paciente->actualizar(); //actualiza en BDD, si falla lanza excepci�n.
            $GLOBALS['success'] = "Actualizaci�n del paciente $paciente->nombre $paciente->apellidos correcta.";
            
        } catch (Exception $e) {
            $GLOBALS['error'] = "No se pudo actualizar el $paciente->nombre $paciente->apellidos.";
        
        } finally {
            //repite la operaci�n edit, as� mantendr� al usuario en la vista de edici�n.
            $this->edit($paciente->id);
        }
        
        //NOTA 1: pongo los mensajes globales para disponer de ellos en las vistas
        //NOTA 2: cuando hagas pruebas, prueba a cambiar el edit por "show" o "list"...
    }
    
    //m�todo para eliminar un paciente
    //Eliminar se hace en 2 pasos si queremos hacerlo con formulario de confirmaci�n
    //PASO 1: muestra el formulario de confirmaci�n de eliminaci�n
    public function delete(int $id=0){
        
        //comprueba que me llega el identificador
        if (!$id){
            throw new Exception('No se indic� el paciente a borrar.');
        }
        
        //recupera el paciente con dicho identificador
        $paciente = Paciente::getById($id);
        
        //comprueba que el paciente existe
        if (!$paciente){
            throw new Exception("No existe el paciente $id ");
        }
        
        //ir al formulario de confirmaci�n
        include '../views/paciente/borrar.php';
    }
    
    //PASO 2: elimina el paciente
    public function destroy(){
        
        //comprueba que llegue el formulario de confirmaci�n
        if (empty($_POST['borrar'])) {
            throw new Exception('No se recibi� confirmaci�n');
        }
        
        //recupera el identificador v�a POST
        $id = intval($_POST['id']);
        
        //intenta borrar el paciente de la BDD
        if (Paciente::borrar($id)===FALSE) {
            throw new Exception('No se pudo borrar');
        }
        
        //muestra la vista de �xito
        $mensaje="Borrado del paciente $id correcto.";
        include '../views/exito.php'; //mostrar �xito
    }
}