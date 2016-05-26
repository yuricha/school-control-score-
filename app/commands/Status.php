<?php
/******
 * Created by JetBrains PhpStorm.
 * User: Yuri
 * Date: 30/11/12
 * Time: 06:53 PM
 * To change this template use File | Settings | File Templates.
 */
class Status
{
	const PENDING = 0;
	const ACTIVE = 1;
	const INACTIVE = 2;
	const LOCKED = 3;

	const STATUS_COMPLETE = 'complete';
	const STATUS_ERROR_PARAMETROS = 'error_parametros';
	const STATUS_ERROR_PROCESO = 'error_proceso';
	const STATUS_ERROR_DESCONOCIDO = 'error_desconocido';
	const STATUS_ERROR_CONEXION = 'error_conexion';
	const STATUS_ACCESS_DENIED = 'access_denied';
	const STATUS_ERROR_PAMETROS_DUPLICADOS = 'error_parametros_existe';
	const STATUS_ERROR_LIBRETAS_DUPLICADOS = 'error_libreta_duplicada';

	public $code;
	public $description;
	public $debug_string;
	public $details;
	public static $messages;

	public function __construct()
	{
		$this->code = '200';
		$this->description = 'Transacción exitosa';
	}

	/*
	 * Setea de manera automática los valores de la status
	 * @param string $_type Usar valores estaticos de la clase Quickdev_Status
	 */
	public function setStatus($_type)
	{
		$lista = $this->getMessages();
		if( isset($lista[$_type]) )
		{
			$this->code = $lista[$_type]['CODE'];
			$this->description = $lista[$_type]['MESSAGE'];
		}else{
			$this->code = $_type;
		}
	}

	/*
	 * @return array Listado de mensajes de sistema disponibles
	 */
	public static function getMessages()
	{
		$messages = array();
		$messages['complete']					= array('CODE'=>200, 'MESSAGE'=>'Proceso completado correctamente');
		$messages['error_parametros'] 			= array('CODE'=>210, 'MESSAGE'=>'Faltan parametros o no contienen la información necesaria');
		$messages['error_parametros_existe'] 	= array('CODE'=>211, 'MESSAGE'=>'Existen valores que ya se registraron');
		$messages['error_parametros_formato'] 	= array('CODE'=>212, 'MESSAGE'=>'El formato de los parametros no es correcto');
		$messages['error_proceso']				= array('CODE'=>220, 'MESSAGE'=>'Ocurrió un error al realizar el proceso, no se realizaron cambios');
		$messages['error_proceso_servidor']		= array('CODE'=>220, 'MESSAGE'=>'El servidor no pudo completar el proceso');
		$messages['error_proceso_bd']			= array('CODE'=>220, 'MESSAGE'=>'Ocurrió un problema con la base de datos');
		$messages['error_desconocido']			= array('CODE'=>230, 'MESSAGE'=>'Ocurrió un error desconocido');
		$messages['error_conexion']				= array('CODE'=>240, 'MESSAGE'=>'No se pudo conectar con un medio externo, por favor intentelo nuevamente');
		$messages['access_denied']				= array('CODE'=>250, 'MESSAGE'=>'No tiene permisos para acceder a esta sección o realizar esta operación');
		$messages['error_libreta_duplicada']	= array('CODE'=>220, 'MESSAGE'=>'Ya exite esta libreta en la base de datos');
		return $messages;
	}

	public static function getVal($_code)
	{
		$co = intval($_code);
		$ar = Status::getStatus();
		return $ar[$co]['name'];
	}


	/**
	 * @return array Retorna un listado de status disponibles para los registro devueltos
	 */
	public static function getStatus()
	{
		$status = array();
		$status[0] = array('name'=>'Pendiente', 'description'=>'Registro pendiente de aprobación o revisión');
		$status[1] = array('name'=>'Activo', 'description'=>'Correcto');
		$status[2] = array('name'=>'Seleccionado', 'description'=>'Activo y seleccionado de entre los otros registros');
		$status[3] = array('name'=>'Bloqueado', 'description'=>'Registro bloqueado');
		return $status;
	}
}