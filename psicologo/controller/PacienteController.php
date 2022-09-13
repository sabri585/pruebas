<?php
class PacienteController {
    public function index() {
        $this->list(); //redirige a la lista de pacientes
    }
    
    //operaci�n para listar todos los pacientes
    public function list(){
        //recuperar la lista de pacientes
        $pacientes = Paciente::get();
        
        //cargar la vista que muestra el listado
        include '../views/paciente/lista.php';
    }
    
    //m�todo para mostrar los detalles de un paciente
    public function show(int $id=0){
        //comprobar que recibimos el id del libro por par�metro
        if (!$id) {
            throw new Exception("No se indic� el paciente");
        }
        
        //recuperar el paciente con dicho c�digo
        $paciente = Paciente::getById($id);
        
        //comprobar que el libro se haya recuperado correctamente de la BDD
        if (!$paciente) {
            throw new Exception("No se ha encontrado el paciente $id");
        }
        
        //cargar la vista de detalles
        include '../views/paciente/detalles.php';
    }
    
    //m�todo para guardar un nuevo paciente
    //PASO 1: muestra el formulario de nuevo libro
    public function create(){
        include '../views/paciente/nuevo.php';
    }
    
    //PASO 2: guarda el nuevo libro
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
            throw new Exception("No se encontrado el libro $id.");
        }
    }
    
}