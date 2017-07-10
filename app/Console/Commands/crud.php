<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class crud extends Command
{
	protected $signature = 'crud 
		{modulo : Nombre del Modulo} 
		{nombre : Nombre de la Tabla, si no se especifica creará archivos con poco contenido} 
		{--c|controller : Define si se crea el archivo Control}
		{--m|model : Define si se crea el archivo de Modelo}
		{--r|request : Define si se crea el archivo de Request}
		{--w|view : Define si se crea el archivo de Vista}
		{--css : Define si se crea el archivo de CSS dentro de los Assets} 
		{--js : Define si se crea el archivo de JS dentro de los Assets}
		{--e|eliminar : Elimina los archivos asociados a la tabla}
		{--f|forzar : Forzar a crear los archivos, no preguntara si existe}
		{--s|estructura : Forzar a crear los archivos en base a una estructura vacia}
	';

	protected $description = 'Creacion de archivos para un crud simple';

	protected $indices = [];
	protected $columnas = [];
	protected $columnas_tipos = [];

	protected $modulo = '';
	protected $nombre = '';
	protected $tabla  = '';

	protected $opciones = [];
	protected $ruta     = '';

	protected $timestamps  = false;
	protected $softDeletes = false;

	public function __construct(Filesystem $files)
	{
		parent::__construct();

		$this->files = $files;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		$this->opciones();
		
		$this->columnas();

		// crear control
		$this->controllers();

		// crear request
		$this->requests();

		// crear modelo
		$this->model();

		// crear vista
		$this->view();

		// crear css
		$this->css();

		// crear js
		$this->js();
	}
	
	protected function opciones(){
		$this->modulo = studly_case($this->argument('modulo'));
		$this->nombre = trim($this->argument('nombre'));
		$this->opciones = $this->option();

		if (!is_dir('Modules/' . $this->modulo)){
			$this->error("No existe el modulo: " . $this->modulo);
			exit();
		}

		if ($this->opciones["controller"] === false &&
			$this->opciones["model"] === false &&
			$this->opciones["request"] === false &&
			$this->opciones["view"] === false &&
			$this->opciones["css"] === false &&
			$this->opciones["js"] === false)
		{
			$this->opciones["controller"] 	= true;
			$this->opciones["model"] 		= true;
			$this->opciones["request"] 		= true;
			$this->opciones["view"] 		= true;
			$this->opciones["css"] 			= true;
			$this->opciones["js"] 			= true;
		}

		if ($this->opciones["estructura"] === true){
			return;
		}

		if ($this->opciones["eliminar"] === true){
			$this->columnas();
			$this->eliminar();
			return;
		}
	}

	protected function columnas(){
		$this->tabla = $this->nombre;
		if (strpos($this->nombre, '/') !== false){
			$this->tabla = substr($this->nombre, strpos($this->nombre, '/') + 1);
			$this->ruta = substr($this->nombre, 0, strpos($this->nombre, '/') + 1);

			if (strlen($this->ruta) > 0){
				$this->ruta = '\\' . str_replace('/', '\\', $this->ruta);
			}
		}

		$conexion = \DB::connection();
		$schema = $conexion->getDoctrineSchemaManager();
		$this->indices = $schema->listTableIndexes($this->tabla);

		$this->columnas = \Schema::getColumnListing($this->tabla);
		
		if ($this->opciones["estructura"]){
			return;
		}

		if (empty($this->columnas)){
			if (!$this->confirm('No existe la tabla: ' . $this->tabla . ', desea continuear? [y|N]')){
				exit();
			}

			return;
		}

		foreach ($this->columnas as $nombre_columna) {
			if ($nombre_columna === 'created_at' || $nombre_columna === 'updated_at'){
				$this->timestamps = true;
				continue;
			}

			if ($nombre_columna === 'deleted_at'){
				$this->softDeletes = true;
				continue;
			}

			//$this->columnas_tipos[$nombre_columna] = \DB::connection()->getDoctrineColumn($this->tabla, $nombre_columna)->getType()->getName();

			$this->columnas_tipos[$nombre_columna] = $conexion->getDoctrineColumn($this->tabla, $nombre_columna);
			$this->columnas_tipos[$nombre_columna]->isForeign = false;
			$this->columnas_tipos[$nombre_columna]->isUnique = false;
			$this->columnas_tipos[$nombre_columna]->isPrimary = false;

			foreach ($this->indices as $indice) {
				if (in_array($nombre_columna, $indice->getColumns())){
					if ($indice->isUnique()){
						$this->columnas_tipos[$nombre_columna]->isUnique = true;
					}elseif ($indice->isPrimary()){
						$this->columnas_tipos[$nombre_columna]->isPrimary = true;
					}

					if (strpos($indice->getName(), 'foreign') !== false) {
					    $this->columnas_tipos[$nombre_columna]->isForeign = true;
					}
				}
			}
		}
		
		$this->columnas = array_keys($this->columnas_tipos);
	}

	protected function eliminar(){
		if (!$this->confirm('Seguro que desea eliminar todos los arhivos de ' . $this->tabla . '? [y|N]')){
			return true;
		}

		$tipos = ["controller", "model", "request", "view", "css", "js"];
		foreach ($tipos as $tipo) {
			if ($this->opciones[$tipo] === true){
				$archivo = $this->nombreArchivo($tipo);
				if (is_file($archivo)){

					if (unlink($archivo)){
						$this->info("Archivo Eliminado: " . $archivo);
					}else{
						$this->error("No se puedo eliminar el archivo: " . $archivo);
					}
				}else{
					$this->info("No exist el archivo: " . $archivo);
				}
			}
		}

		exit();
	}

	protected function nombreArchivo($tipoArchivo){
		$archivo = 'Modules/' . $this->modulo;
		$ruta = str_replace('\\', '/', $this->ruta);
		$prefijoArchivo = $ruta . studly_case($this->tabla);

		switch ($tipoArchivo) {
			case 'controller':
				$archivo .= '/Http/Controllers/' . $prefijoArchivo . 'Controller.php';
				break;
			case 'model':
				$archivo .= '/Model/' . $prefijoArchivo . '.php';
				break;
			case 'request':
				$archivo .= '/Http/Requests/' . $prefijoArchivo . 'Request.php';
				break;
			case 'view':
				$archivo .= '/Resources/Views/' . $prefijoArchivo . '.blade.php';
				break;
			case 'css':
				$archivo .= '/Assets/css/' . $prefijoArchivo . '.css';
				break;
			case 'js':
				$archivo .= '/Assets/js/' . $prefijoArchivo . '.js';
				break;
		}
		
		$archivo = str_replace('//', '/', $archivo);

		return $archivo;
	}

	protected function archivo($tipoArchivo, $data){
		if (!$this->opciones[$tipoArchivo]){
			$this->info('No se Creara el archivo de ' . $tipoArchivo);
			return true;
		}

		$archivo = $this->nombreArchivo($tipoArchivo);

		$directorio = substr($archivo, 0, strrpos($archivo, "/"));

		if (!is_dir($directorio)){
			mkdir($directorio, 0777, true);
		}
		
		if (is_file($archivo)){
			if ($this->opciones["forzar"] === false){
				if (!$this->confirm('El archivo ' . $archivo . ' ya existe, desea sobreescribirlo? [y|N]')){
					return true;
				}
			}
			unlink($archivo);
		}
		
		$contenidoArchivo = $this->files->get(__DIR__ . '/plantillas/' . $tipoArchivo . '.stub');
		$contenidoArchivo = $this->plantilla($contenidoArchivo, $data);
		
		$this->files->put($archivo, $contenidoArchivo);

		chmod($archivo, 0755);

		$this->info('Se creo el archivo: ' . $archivo);

		return true;
	}

	protected function nombre($nombre = ''){
		return ucwords(str_replace('_', ' ', $nombre === '' ? $this->tabla : $nombre));
	}

	protected function controllers(){
		$namespace = 'Modules\\' . studly_case($this->modulo);
		$tabla = strtolower($this->tabla);
		
		$this->archivo('controller', [
			'namespace' 		=> $namespace . '\\Http\\Controllers' . rtrim($this->ruta, '\\'),
			'namespaceParent' 	=> $namespace . '\\Http\\Controllers\\Controller',
			'request' 			=> $namespace . '\\Http\\Requests\\' . ltrim($this->ruta, '\\') . studly_case($this->tabla) . 'Request',
			'model' 			=> $namespace . '\\Model\\' . ltrim($this->ruta, '\\') . studly_case($tabla),
			'classname' 		=> studly_case($this->tabla) . 'Controller',
			'titulo' 			=> $this->nombre(),
			'view' 				=> strtolower($this->modulo) . '::' . str_replace('\\', '.', ltrim($this->ruta, '\\')) . studly_case($this->tabla),
			'table' 			=> studly_case($this->tabla),
			'datatable' 		=> "'" . implode("', '", $this->columnas) . "'" . ($this->softDeletes ? ", 'deleted_at'" : "")
		]);
	}

	protected function requests(){
		$columnas = $this->columnas_tipos;
		
		unset($columnas['id']);
		$reglas = [];

		foreach($columnas as $nombre => $columna){
			$propiedades = [];
			if ($columna->getNotnull()){
				$propiedades[] = 'required';
			}
			
			switch ($columna->getType()->getName()) {
				case 'integer':
					$propiedades[] = 'integer';
					break;

				case 'string':
					$propiedades[] = 'min:3';
					$propiedades[] = 'max:' . $columna->getLength();
					break;

				case 'date':
					$propiedades[] = 'date_format:"d/m/Y"';
					break;
			}

			if ($columna->isUnique){
				$propiedades[] = 'unique:' . $this->tabla . ',' . $nombre;
			}

			$reglas[] = "'" . $nombre . "' => ['" . implode("', '", $propiedades) . "']";
		}

		$this->archivo('request', [
			'namespace' => "Modules\\" . studly_case($this->modulo) . "\\Http\\Requests" . rtrim($this->ruta, '\\'),
			'classname' => studly_case($this->tabla) . 'Request',
			'table' => $this->tabla,
			'rules' => "[\n\t\t" . implode(", \n\t\t", $reglas) . "\n\t]"
		]);
	}

	protected function model(){
		$columnas = $this->columnas;
		array_shift($columnas);
		
		$data = [
			'namespace' => "Modules\\" . studly_case($this->modulo) . "\\Model" . rtrim($this->ruta, '\\'),
			'extends' => 'Model',
			'table' => $this->tabla,
			'namespaceParent' => 'Illuminate\Database\Eloquent\Model',
			'classname' => studly_case($this->tabla),
			'fillable' => json_encode($columnas),
			'hidden' => [],
			'campos' => [],
			'options' => [],
			'rules' => []
		];

		if ($this->timestamps){
			$data['hidden'] = ['created_at', 'updated_at'];
		}

		if ($this->softDeletes){
			$data['extends'] = 'modelo';
			$data['namespaceParent'] = 'Modules\Admin\Model\Modelo';
			$data['hidden'][] = 'deleted_at';
		}

		$campos = [];
		foreach ($this->columnas_tipos as $nombre_columna => $campo) {
			if ($campo->getAutoincrement() || $nombre_columna === 'created_at' || $nombre_columna === 'updated_at' || $nombre_columna === 'deleted_at'){
				continue;
			}
			
			$label = title_case(str_replace('_', ' ', snake_case($nombre_columna)));
			$label = str_replace(' Id', '', $label);

			$placeholder = $label . ' del ' . title_case(str_replace('_', ' ', snake_case($this->tabla)));
			

			$propiedades = [
				'type' 			=> $this->getInputType($campo->getType()->getName()),
				'label'			=> $label,
				'placeholder'	=> $placeholder,
			];

			$validate = [];

			if ($campo->getNotnull()){
				$propiedades['required'] = true;
				$validate[] = 'required';
			}
			
			switch ($campo->getType()->getName()) {
				case 'integer':
					$validate[] = 'integer';
					break;

				case 'string':
					$validate[] = 'min:3';
					$validate[] = 'max:' . $campo->getLength();
					break;

				case 'date':
					$validate[] = 'date_format:"d/m/Y"';
					break;
			}

			if ($campo->isUnique){
				$validate[] = 'unique:' . $this->tabla . ',' . $nombre_columna;
			}

			if ($campo->isForeign){
				$propiedades['type'] = 'select';
				//$propiedades['placeholder'] = '- Seleccione';
				$propiedades['placeholder'] = '- Seleccione un ' . $label;
				$propiedades['url'] = 'Agrega una URL Aqui!';


				foreach ($this->indices as $indice) {
					if (in_array($nombre_columna, $indice->getColumns())){
						$nombreindice = str_replace(['_id_foreign', $this->tabla], '', $indice->getname());
						$nombreindice = trim($nombreindice, '_');
						$nombreindice = studly_case($nombreindice);

						$data['options'][] = "\$this->campos['$nombre_columna']['options'] = $nombreindice::pluck('nombre', 'id');";
					}
				}
			}

			$reglas[][$nombre_columna] = $validate;


			$campos[$nombre_columna] = $propiedades;
		}


		$data['hidden'] = json_encode($data['hidden']);
		$data['campos'] = str_replace(['{', '}', '": ', '"'], ['[', ']', '" => ', "'"], json_encode($campos, JSON_PRETTY_PRINT));
		$data['rules'] = str_replace(['{', '}', '": ', '"'], ['[', ']', '" => ', "'"], json_encode($reglas, JSON_PRETTY_PRINT));
		$data['options'] = implode("\n\t\t", $data['options']);

		//dd($data);
		$this->archivo('model', $data);
	}

	protected function view(){
		$columnas = $this->columnas_tipos;
		
		unset($columnas['id']);
		$campos = [];
		$thtable = [];

		foreach ($columnas as $nombre => $columna){
			$thtable[] = "'" . $this->nombre($nombre) . "' => '" . (100 / count($columnas)) . "'";

			switch ($columna->getType()->getName()) {
				case 'integer':
					$campos[] = "
			{{ Form::bsNumber('" . $nombre . "', '', [
				'label' => '" . $this->nombre($nombre) . "',
				'placeholder' => '" . $this->nombre($nombre) . "',
				'required' => 'required'
			]) }}";
					break;
				case 'string':
					$campos[] = "
			{{ Form::bsText('" . $nombre . "', '', [
				'label' => '" . $this->nombre($nombre) . "',
				'placeholder' => '" . $this->nombre($nombre) . "',
				'required' => 'required'
			]) }}";
					break;
				
				default:
					$campos[] = "
			{{ Form::bsText('" . $nombre . "', '', [
				'label' => '" . $this->nombre($nombre) . "',
				'placeholder' => '" . $this->nombre($nombre) . "',
				'required' => 'required'
			]) }}";
					break;
			}
		}


		$this->archivo('view', [
			'thtable' => implode(",\n\t\t", $thtable),
			'nombre' => $this->nombre(),
			'table' => studly_case($this->tabla),
			'campos' => implode(' ', $campos)
		]);
	}

	protected function css(){
		$this->archivo('css', [
			'tabla' => $this->tabla
		]);
	}
	protected function js(){
		$columnas = $this->columnas_tipos;
		
		unset($columnas['id']);
		$camposDT = [];

		foreach ($columnas as $nombre => $columna){
			$camposDT[] = [
				'data' => $nombre,
				'name' => $nombre
			];
		}

		$this->archivo('js', [
			'campos' => json_encode($camposDT)
		]);
	}

	public function plantilla($plantilla, $data){
		if (!is_array($data)) return '';
		
		$variables = array_keys($data);
		$datos = array_values($data);
		for ($i = 0, $c = count($variables); $i < $c; $i++) {
			if (is_array($variables[$i])){
				$variables[$i] = json_encode($variables[$i]);
			}

			$variables[$i] = '{{' . trim($variables[$i]) . '}}';
		}

		return str_replace($variables, $datos, $plantilla);
	}

	protected function getInputType($dataType){
		$lookup = array(
			'string'  => 'text',
			'integer' => 'number',
			'float'   => 'number',
			'date'    => 'date',
			'text'    => 'textarea',
			'boolean' => 'checkbox'
		);
		return array_key_exists($dataType, $lookup)
			? $lookup[$dataType]
			: 'text';
	}
}