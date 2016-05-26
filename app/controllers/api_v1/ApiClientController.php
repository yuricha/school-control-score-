<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 13/11/2014
 * Time: 10:21 AM
 */

class ApiClientController extends ApiBaseController
{
    public function index()
    {
        return View::make('admin.home');
    }


    public function newclient()
    {
        $r = new ApiResponse();
        $_error = false;
        $entry = null;
        $data = Input::all();
        $entry = new Client;
        if($entry->isValid($data))
        {
            $entry->fill($data);
            $entry->save();
        }
        else
        {
            $r->status->setStatus(Status::STATUS_ERROR_PARAMETROS);
        }
        return Response::json($r, $r->status->code);
    }



    public function download()
    {
        
        $r = new ApiResponse();
        $_error = false;
        $entry = null;

        $entries=Client::get(array('name as Nombre','surname_father as Apellido_Paterno','phone as Telefono','surname_mother as Apellido_Materno','dni as Dni','email as Email','created_at'));
        $entry = array();
        for ($count = 0; $count < sizeof($entries) ;$count++){
            $entry[$count]['Nombre'] = $entries[$count]->Nombre;
            $entry[$count]['Apellido_Paterno'] = $entries[$count]->Apellido_Paterno;
            $entry[$count]['Apellido_Materno'] = $entries[$count]->Apellido_Materno;
            $entry[$count]['Dni'] = $entries[$count]->Dni;
            $entry[$count]['Email'] = $entries[$count]->Email;
            $entry[$count]['Teléfono'] = $entries[$count]->Telefono;
            $entry[$count]['Fecha_de_Creación'] = $entries[$count]->created_at;
        }
        if(count($entries)==0)
        {
            $r->status->code='220';
            $r->status->description='No se encontraron registros';
            return Response::json($r, $r->status->code);
        }
        else {
            Excel::create('Reporte clientes Cencosud', function ($excel) use ($entry){
                $excel->sheet('Clientes', function ($sheet) use ($entry){
                    $count=count($entry)+3;
                    $sheet->setBorder('B3:H'.$count,'thin',false,'#8684FF');

                    $sheet->cells('B3:H3', function($cells){
                        $cells->setBackground('#AECBEC');
                    });

                    $sheet->cells('B4:H'.$count, function($cells){
                        $cells->setBackground('#E3F0FF');
                    });
                    $sheet->fromArray($entry, true, 'B3', true, true);
                });
            })->export('xls');
        }
    }

} 