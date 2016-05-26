<?php
/**
 * Created by PhpStorm.
 * User: Yuri
 * Date: 09/04/2015
 * Time: 03:54 PM
 */

class AdminRatingController extends BaseController {
    protected $layout = 'ci.tpl_admin';
    public function index(){
        // var_dump('hola');
        $persone=Person::find(Auth::user()->id);
        $this->layout->curmenu="rating";
        if(Auth::user()->is('Administrador')||Auth::user()->is('Tutor')){
            $this->layout->content = View::make('admin/rating', array('person' => $persone));
        }elseif(Auth::user()->is('Alumno')){
            $this->layout->content = View::make('admin/ratingStudents', array('person' => $persone));
        }

    }

    public function postRatingalumno(){
        $r = new ApiResponse();
        if(Auth::user()->is('Alumno')){
            $rating = Rating::where("user_id","=",Auth::user()->id)->get();

            $json=array();
            $page=1;
            $rows=10;
            if(Input::has('page')) $page = Input::get('page');
            if(Input::has('rows')) $rows = Input::get('rows');
            $start=intval($page-1)*$rows;
            $end=$start+$rows-1;
            $cont=0;
            foreach($rating as $v){
                if($cont>=$start && $cont<=$end){
                    $temp["ID"]=$cont;
                    $temp["id"]=$v->user_id;
                    $temp["year"]=$v->year;
                    //$temp["grade"]=$v->nameGrade;
                    $temp["bimester"]=$v->semester;
                    $temp["nombre"]=$v->file;
                    if($v->status==1)$temp["status"]="Disponible";
                    else$temp["status"]="No disponible";
                    $temp["notas"]='<a href="javascript:void(0)"onclick="objUser.getDoc('.$v->id.','.Auth::user()->id.')" ><img src="'.URL::to('/').'/images/app/icon-download.png">  Descargar</a>';

                    $cont++;
                    $temp["num"]=$cont;
                    $json[]=$temp;
                }
            }
            $r->rows=$json;
            $r->total=count($json);
        }
        return Response::json($r);
    }
    public function postRatinguser(){
        $r = new ApiResponse();
        if(Auth::user()->is('Alumno')){
            $rating = Rating::where("user_id","=",Auth::user()->id)->get();

            $json=array();
            $page=1;
            $rows=10;
            if(Input::has('page')) $page = Input::get('page');
            if(Input::has('rows')) $rows = Input::get('rows');
            $start=intval($page-1)*$rows;
            $end=$start+$rows-1;
            $cont=0;
            foreach($rating as $v){
                if($cont>=$start && $cont<=$end){
                    $temp["ID"]=$cont;
                    $temp["id"]=$v->user_id;
                    $temp["year"]=$v->year;
                    //$temp["grade"]=$v->nameGrade;
                    $temp["bimester"]=$v->semester;
                    $temp["nombre"]=$v->file;
                    if($v->status==1)$temp["status"]="Disponible";
                    else$temp["status"]="No disponible";
                    $temp["notas"]='<a href="javascript:void(0)"onclick="objUser.getDoc('.$cont.')" ><img src="'.URL::to('/').'/images/app/icon-download.png">  Descargar</a>';

                    $cont++;
                    $temp["num"]=$cont;
                    $json[]=$temp;
                }
            }
            $r->rows=$json;
            $r->total=count($json);
        }
        return Response::json($r);
    }
    public function postUpload(){
        $r = new ApiResponse();
        $pathRelative = '/' ."public". '/' . "upload" . '/';
        $destinationPath = base_path(). $pathRelative;

        if(Input::hasFile('myfile')){//validate for role teacher and admin

            $file = Input::file('myfile'); // your file upload input field in the form should be named 'file'

            // Declare the rules for the form validation.
            $rules = array('myfile'  => 'mimes:jpg,jpeg,bmp,png,pdf,doc,docx|max:20000');
            $data = array('myfile' => Input::file('myfile'));

            // Validate the inputs.
            $validation = Validator::make($data, $rules);

           //f ($validation->fails())
            if (false)
            {
                $r->status->setStatus(Status::STATUS_ERROR_PARAMETROS);
                return Response::json($r);
            }

            if(is_array($file))
            {
                foreach($file as $part) {
                    $filename = $part->getClientOriginalName();
                    $part->move($destinationPath, $filename);
                }
            }
            else //single file
            {
                $filename = $file->getClientOriginalName();
                $file_name = pathinfo($filename, PATHINFO_FILENAME);//onlyname
                $fileParts = explode("_",$file_name);
                if(isset($fileParts[2])){
                    $rpt=$this->findDniPeople($fileParts[2]);
                    $isvalidSemester=$this->checkSemester(Input::get('semester'),$fileParts[2]);
                    if($rpt){
                            if($isvalidSemester){
                            $idUser    = $rpt[0]->userid;
                            $levelUser = $rpt[0]->levelName;//validation teacher level
                            $gradeName = $rpt[0]->gradeName;//validation teacher grade

                            $uploadSuccess=false;
                            if(Input::has('semester')){
                                $semester=Input::get('semester');
                                $uploadSuccess = Input::file('myfile')->move($destinationPath, $semester.'_'.$filename);
                            }
                            if( $uploadSuccess ) {
                                $publication = new Publication();
                                $publication->detail="";
                                $publication->status=0;
                                $publication->publicated_at=date('Y-m-d H:i:s');
                                $publication->created_at=date('Y-m-d H:i:s');
                                $publication->save();
                                DB::table('user_publication')->insert(array("user_id"=>$idUser,"publication_id"=>$publication->id,"created_at"=>date('Y-m-d H:i:s')));


                                $rating  = new Rating();
                                $rating->path=$pathRelative;
                                $rating->user_id=$idUser;
                                $rating->file=$semester.'_'.$filename;
                                $rating->semester=$semester;
                                $rating->year=date('Y');
                                $rating->status="1";
                                $rating->save();
                                DB::table('publication_rating')->insert(array("publication_id"=>$publication->id,"rating_id"=>$rating->id,"created_at"=>date('Y-m-d H:i:s')));

                                return Response::json($r);
                            } else {
                                $r->rpt=$uploadSuccess;
                                $r->status->setStatus(Status::STATUS_ERROR_PARAMETROS);
                                return Response::json($r);
                            }
                        }else{
                            $r->status->setStatus(Status::STATUS_ERROR_LIBRETAS_DUPLICADOS);
                            return Response::json($r);
                        }

                    }else{
                        // return Response::json('error', 400);
                        $r->status->setStatus(Status::STATUS_ERROR_ALUMNO);
                        return Response::json($r);
                    }
                }else{
                    $r->status->setStatus(Status::STATUS_ERROR_PARAMETROS);
                    // return Response::json($r);
                    return Response::json($r);
                }


            }

        }
    }

    public function postInicial(){
        $r = new ApiResponse();
        // $students=array();
        $page=1;
        $rows=10;
        if(Input::has('page')) $page = Input::get('page');
        if(Input::has('rows')) $rows = Input::get('rows');
        $start=intval($page-1)*$rows;
        $end=$start+$rows-1;
        $json=array();
        $gradoImicial=array(1=>"3 años",2=>"4 años",3=>"5 años",);
        $grado=array(1=>"primero",2=>"segundo",3=>"tercero",4=>"cuarto",5=>"quinto",6=>"sexto");
        if(Auth::user()->is('Administrador')){
            try
            {
                $users=DB::table('users')->join('people', function($join)
                {
                    $join->on('users.id', '=', 'people.user_id');
                })->where("users.deleted_at","=",null)
                    ->join('levels', function($join)
                    {
                        $join->on('users.id', '=', 'levels.user_id')->where("levels.name","=","INICIAL");
                    })->join('grades', 'users.id', '=', 'grades.user_id')
                    ->where("people.people_type_id","=","3")->select('levels.name as nameLevel ','grades.name as nameGrade','users.*','people.*')->get();
                $cont=0;
                foreach($users as $v){
                    $cont++;
                    if($cont>=$start && $cont<=$end){
                        $temp["ID"]=$cont;
                        $temp["id"]=$v->user_id;
                        $temp["nombre"]=$v->firstname;
                        $temp["apellido"]=$v->lastname;
                        $temp["dni"]=$v->dni ;
                        $temp["sexo"]=$v->genre;
                        $temp["grado"]=$gradoImicial[$v->nameGrade];
                        $temp["email"]=$v->email;
                        $temp["apoderado"]=$v->responsible;
                        $temp["estado"]=$v->status;
                        $json[]=$temp;

                    }

                }
                $r->rows=$json;
                $r->total=count($users);
            }catch (\Exception $e){
                $r->error=$e;
            }
        }
        elseif(Auth::user()->is('Tutor'))
        {
            $teacher=DB::table('levels')->where("levels.user_id","=",Auth::user()->id)->join('grades', "grades.user_id", '=', 'levels.user_id')->join('sections', "sections.user_id", '=', 'levels.user_id')->select('levels.name as nameLevel ','grades.name as nameGrade','sections.name as nameSection')->get();

            if(count($teacher)>0){
                $students=DB::table('users')->join('people', function($join)
                {
                    $join->on('users.id','=','people.user_id');
                })->where("users.deleted_at","=",null)->join('sections', 'users.id', '=', 'sections.user_id')
                    ->join('levels', function($join)
                    {
                        $join->on('users.id', '=', 'levels.user_id')->where("levels.name","=","INICIAL");
                    })
                    ->join('grades', 'users.id', '=', 'grades.user_id');
                $grades=array();
                $section=array();
                foreach($teacher as $t){
                    array_push($grades,$t->nameGrade);
                    array_push($section,$t->nameSection);
                    $leven=$t->nameLevel;
                }
                $students->whereIn("grades.name",$grades)->whereIn("sections.name",$section);
                $students->where("people.people_type_id","=","3")->where("levels.name","=",$leven);
                $estudiantes=$students->select('sections.name as nameSection','levels.name as nameLevel ','grades.name as nameGrade','users.*','people.*')->get();
                $cont=0;

                foreach($estudiantes as $v){
                    $cont++;
                    if($cont>=$start && $cont<=$end){
                        $temp["ID"]=$cont;
                        $temp["id"]=$v->user_id;
                        $temp["nombre"]=$v->firstname;
                        $temp["apellido"]=$v->lastname;
                        $temp["dni"]=$v->dni ;
                        $temp["sexo"]=$v->genre;
                        if($teacher[0]->nameLevel=="INICIAL") $temp["grado"]=$gradoImicial[$v->nameGrade];
                        else $temp["grado"]=$grado[$v->nameGrade];
                        $temp["email"]=$v->email;
                        $temp["apoderado"]=$v->responsible;
                        $temp["estado"]=$v->status;
                        $temp["seccion"]=$v->nameSection;
                        $json[]=$temp;
                    }

                }
                $r->rows=$json;
                $r->total=count($estudiantes);

            }
        }else{
            $r->rows=array();
            $r->total=0;
        }
        return Response::json($r);

    }

    public  function postPrimaria(){
        $r = new ApiResponse();
        // $students=array();
        $page=1;
        $rows=10;
        if(Input::has('page')) $page = Input::get('page');
        if(Input::has('rows')) $rows = Input::get('rows');
        $start=intval($page-1)*$rows;
        $end=$start+$rows-1;
        $json=array();
        $gradoImicial=array(1=>"3 años",2=>"4 años",3=>"5 años",);
        $grado=array(1=>"primero",2=>"segundo",3=>"tercero",4=>"cuarto",5=>"quinto",6=>"sexto");
        if(Auth::user()->is('Administrador')){
            try
            {
                $users=DB::table('users')->join('people', function($join)
                {
                    $join->on('users.id', '=', 'people.user_id');
                })->where("users.deleted_at","=",null)
                    ->join('levels', function($join)
                    {
                        $join->on('users.id', '=', 'levels.user_id')->where("levels.name","=","PRIMARIA");
                    })->join('grades', 'users.id', '=', 'grades.user_id')
                    ->where("people.people_type_id","=","3")->select('levels.name as nameLevel ','grades.name as nameGrade','users.*','people.*')->get();
                $cont=0;
                foreach($users as $v){
                    $cont++;
                    if($cont>=$start && $cont<=$end){
                        $temp["ID"]=$cont;
                        $temp["id"]=$v->user_id;
                        $temp["nombre"]=$v->firstname;
                        $temp["apellido"]=$v->lastname;
                        $temp["dni"]=$v->dni ;
                        $temp["sexo"]=$v->genre;
                        $temp["grado"]=$grado[$v->nameGrade];
                        $temp["email"]=$v->email;
                        $temp["apoderado"]=$v->responsible;
                        $temp["estado"]=$v->status;
                        $json[]=$temp;
                    }

                }
                $r->rows=$json;
                $r->total=count($users);
            }catch (\Exception $e){
                $r->error=$e;
            }
        }
        elseif(Auth::user()->is('Tutor'))
        {
            $teacher=DB::table('levels')->where("levels.user_id","=",Auth::user()->id)->join('grades', "grades.user_id", '=', 'levels.user_id')->join('sections', "sections.user_id", '=', 'levels.user_id')->select('levels.name as nameLevel ','grades.name as nameGrade','sections.name as nameSection')->get();
            if(count($teacher)>0){
                $students=DB::table('users')->join('people', function($join)
                {
                    $join->on('users.id','=','people.user_id');
                })->where("users.deleted_at","=",null)->join('sections', 'users.id', '=', 'sections.user_id')
                    ->join('levels', function($join)
                    {
                        $join->on('users.id', '=', 'levels.user_id')->where("levels.name","=","PRIMARIA");
                    })
                ->join('grades', 'users.id', '=', 'grades.user_id');
                $grades=array();
                $section=array();
                foreach($teacher as $t){
                    array_push($grades,$t->nameGrade);
                    array_push($section,$t->nameSection);
                    $leven=$t->nameLevel;
                }
                $students->whereIn("grades.name",$grades)->whereIn("sections.name",$section);
                $students->where("people.people_type_id","=","3")->where("levels.name","=",$leven);
                $estudiantes=$students->select('levels.name as nameLevel ','sections.name as nameSection','grades.name as nameGrade','users.*','people.*')->get();

                $cont=0;
                foreach($estudiantes as $v){
                    $cont++;
                    if($cont>=$start && $cont<=$end){
                        //if($teacher[0]->nameSection)
                        $temp["ID"]=$cont;
                        $temp["id"]=$v->user_id;
                        $temp["nombre"]=$v->firstname;
                        $temp["apellido"]=$v->lastname;
                        $temp["dni"]=$v->dni ;
                        $temp["sexo"]=$v->genre;
                        $temp["grado"]=$grado[$v->nameGrade];
                        $temp["grado"]=$v->nameGrade;
                        $temp["email"]=$v->email;
                        $temp["apoderado"]=$v->responsible;
                        $temp["seccion"]=$v->nameSection;
                        $temp["estado"]=$v->status;
                        $json[]=$temp;
                    }

                }
                $r->rows=$json;
                $r->total=count($estudiantes);
                //$r->ttt=$estudiantes;
            }else{
                $r->rows=array();
                $r->total=0;
            }
        }
        elseif(Auth::user()->is('Alumno')){

            //$rating = Rating::where("user_id","=",Auth::user()->id)->get()
         /*   $users=DB::table('users')->join('people', function($join)
            {
                $join->on('users.id', '=', 'people.user_id')->where("users.id","=",Auth::user()->id);
            })->get();
            $cont=0;
            foreach($users as $v){
                $cont++;
                if($cont>=$start && $cont<=$end){
                    $temp["ID"]=$cont;
                    $temp["id"]=$v->user_id;
                    $temp["nombre"]=$v->firstname;
                    $temp["apellido"]=$v->lastname;
                    $temp["dni"]=$v->dni ;
                    $temp["sexo"]=$v->genre;
                    $temp["grado"]=$v->grade;
                    $temp["email"]=$v->email;
                    $temp["apoderado"]=$v->responsible;
                    $temp["estado"]=$v->status;
                    $json[]=$temp;
                }
            }
            $r->rows=$json;
            $r->total=count($json);

            /**/
        }else{
            $r->rows=array();
            $r->total=0;
        }
        return Response::json($r);
    }
    public  function postSecundaria(){
        $r = new ApiResponse();
        // $students=array();
        $page=1;
        $rows=10;
        if(Input::has('page')) $page = Input::get('page');
        if(Input::has('rows')) $rows = Input::get('rows');
        $start=intval($page-1)*$rows;
        $end=$start+$rows-1;
        $json=array();
        $gradoImicial=array(1=>"3 años",2=>"4 años",3=>"5 años",);
        $grado=array(1=>"primero",2=>"segundo",3=>"tercero",4=>"cuarto",5=>"quinto",6=>"sexto");
        if(Auth::user()->is('Administrador')){
            try
            {

                    $users=DB::table('users')->join('people', function($join)
                    {
                        $join->on('users.id', '=', 'people.user_id');
                    })->where("users.deleted_at","=",null)
                        ->join('levels', function($join)
                        {
                            $join->on('users.id', '=', 'levels.user_id')->where("levels.name","=","SECUNDARIA");
                        })->join('grades', 'users.id', '=', 'grades.user_id')
                        ->where("people.people_type_id","=","3")->select('levels.name as nameLevel ','grades.name as nameGrade','users.*','people.*')->get();
                    $cont=0;
                    foreach($users as $v){
                        $cont++;
                        if($cont>=$start && $cont<=$end){
                            $temp["ID"]=$cont;
                            $temp["id"]=$v->user_id;
                            $temp["nombre"]=$v->firstname;
                            $temp["apellido"]=$v->lastname;
                            $temp["dni"]=$v->dni ;
                            $temp["sexo"]=$v->genre;
                            $temp["grado"]=$grado[$v->nameGrade];
                            $temp["email"]=$v->email;
                            $temp["apoderado"]=$v->responsible;
                            $temp["estado"]=$v->status;
                            $json[]=$temp;
                        }
                    }
                $r->rows=$json;
                $r->total=count($users);
            }catch (\Exception $e){
                $r->error=$e;
            }
        }
        elseif(Auth::user()->is('Tutor'))
        {

            $teacher=DB::table('levels')->where("levels.user_id","=",Auth::user()->id)->join('grades', "grades.user_id", '=', 'levels.user_id')->join('sections', "sections.user_id", '=', 'levels.user_id')->select('sections.name as nameSection','levels.name as nameLevel ','grades.name as nameGrade')->get();
            if(count($teacher)>0){
                $students=DB::table('users');
                $students->join('people', function($join)
                {
                    $join->on('users.id','=','people.user_id');
                })->where("users.deleted_at","=",null)->join('sections', 'users.id', '=', 'sections.user_id')
                    ->join('levels', function($join)
                    {
                        $join->on('users.id', '=', 'levels.user_id')->where("levels.name","=","SECUNDARIA");
                    })
                    ->join('grades', 'users.id', '=', 'grades.user_id');
                    $grades=array();
                    $section=array();
                    foreach($teacher as $t){
                        array_push($grades,$t->nameGrade);
                        array_push($section,$t->nameSection);
                        $leven=$t->nameLevel;
                    }
                $students->whereIn("grades.name",$grades)->whereIn("sections.name",$section);
                $students->where("people.people_type_id","=","3")->where("levels.name","=",$leven);
                $estudiantes=$students->select('levels.name as nameLevel ','sections.name as nameSection','grades.name as nameGrade','users.*','people.*')->get();

                $cont=0;
                foreach($estudiantes as $v){
                    if($v->user_id!==Auth::user()->id){
                        $cont++;
                        if($cont>=$start && $cont<=$end){
                            $temp["ID"]=$cont;
                            $temp["id"]=$v->user_id;
                            $temp["nombre"]=$v->firstname;
                            $temp["apellido"]=$v->lastname;
                            $temp["dni"]=$v->dni ;
                            $temp["sexo"]=$v->genre;
                            $temp["grado"]=$v->nameGrade;
                            $temp["email"]=$v->email;
                            $temp["apoderado"]=$v->responsible;
                            $temp["estado"]=$v->status;
                            $temp["seccion"]=$v->nameSection;
                            $temp["grado"]=$grado[$v->nameGrade];
                            $json[]=$temp;
                        }/**/
                    }
                }
                $r->rows=$json;
                $r->total=count($estudiantes);
                //$r->tee=$teacher;

            }
        }
        elseif(Auth::user()->is('Alumno')){
            /*
            //$rating = Rating::where("user_id","=",Auth::user()->id)->get()
            $users=DB::table('users')->join('people', function($join)
            {
                $join->on('users.id', '=', 'people.user_id')->where("users.id","=",Auth::user()->id);
            })->get();
            $cont=0;
            foreach($users as $v){
                $cont++;
                if($cont>=$start && $cont<=$end){
                    $temp["ID"]=$cont;
                    $temp["id"]=$v->user_id;
                    $temp["nombre"]=$v->firstname;
                    $temp["apellido"]=$v->lastname;
                    $temp["dni"]=$v->dni ;
                    $temp["sexo"]=$v->genre;
                    $temp["grado"]=$v->grade;
                    $temp["email"]=$v->email;
                    $temp["apoderado"]=$v->responsible;
                    $temp["estado"]=$v->status;
                    $json[]=$temp;
                }
            }
            $r->rows=$json;
            $r->total=count($json);
            /**/
        }else{
            $r->rows=array();
            $r->total=0;
        }
        return Response::json($r);
    }

    public function postLoad($id=null){
        $r = new ApiResponse();
        if($id!=null){
            $rating=DB::table('ratings')->where("user_id","=",$id)->get();
            $cont=0;
            $json=array();
            foreach($rating as $v){

                $temp["year"]=$v->year;
                $temp["semester"]=$v->semester;
                $temp["nombre"]=$v->file;
                if($v->status==1)$temp["status"]="Disponible";
                else$temp["status"]="No disponible";
                $temp["notas"]='<a href="javascript:void(0)"onclick="objUser.getDoc('.$id.','.$v->id.')" ><img src="'.URL::to('/').'/images/app/icon-download.png">  Descargar</a>';
                $temp["acciones"]='<a href="javascript:void(0)" onclick="objUser.delete('.$id.','.$v->semester.')" ><span class="icon16 ii-delete" ></span> Eliminar</a>';
                $json[]=$temp;
                $cont++;
            }
            $r->rows=$json;
            $r->total=count($json);
        }
        return Response::json($r);
    }

    private function findDniPeople($dni=null){
        $people=false;
        $rpta=DB::table('users')->where("dni","=",$dni)
            ->join('levels', 'users.id', '=', 'levels.user_id')
            ->join('grades', 'users.id', '=', 'grades.user_id')
            ->select('users.id as userid','levels.name as levelName','grades.name as gradeName')->get();
        if($rpta)$people=$rpta;
        return $rpta;
    }

    private function checkSemester($bimester,$dni){
    $user=DB::table('users')->where("dni","=",$dni)->get();
    if(count($user)>0){
            $rpta=DB::table('ratings')->where("semester","=",$bimester)->where("user_id","=",$user[0]->id)->where("year","=",date('Y'))->get();
        if(count($rpta)>0)return false;
        else return true;
    }else return false;
    
    }

    public function getReport($id=null,$idb=null){
        if($id!==null){
            $rpta=DB::table('ratings')->where("id","=",$idb)->get();
            if(count($rpta)>0){
                $pathRelative =$rpta[0]->path.$rpta[0]->file;
                $destinationPath = base_path(). $pathRelative;
                if(is_file($destinationPath)){
                    header('Content-Type: application/force-download');
                    header('Content-Disposition: attachment; filename='.$rpta[0]->file);
                    header('Content-Transfer-Encoding: binary');
                    header('Content-Length: '.filesize($destinationPath));
                    readfile($destinationPath);
                }else return "Ups,el archivo no esta disponible ";
                /*
                $destinationPath = base_path(). $pathRelative;
                //$enlace = $path_a_tu_doc."/".$id;
                header ("Content-Disposition: attachment; filename=".$destinationPath." ");
                header ("Content-Type: application/octet-stream");
                header ("Content-Length: ".filesize($destinationPath));
                readfile($destinationPath);
                /**/
              /*
                $content_types = [
                    'Content-Type: application/octet-stream', // txt etc
                    'Content-Type: application/msword', // doc
                    'Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document', //docx
                    'Content-Type: application/vnd.ms-excel', // xls
                    'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', // xlsx
                    'Content-Type: application/pdf', // pdf
                ];
                return file_put_contents($destinationPath, file_get_contents($url));
                return Response::download($destinationPath, $rpta[0]->file, $content_types);
                /**/
            }else{
                //$queries = DB::getQueryLog();
                //$last_query = end($queries);
                return 0;
            }
        }
    }

    public function anyExcel(){
        $excem=Excel::load('public\file.xlsx', function($excel)
        {
        })->get();
        foreach($excem as $obj){
            foreach($obj as $v){
                var_dump($v);
            }
        }
        $this->layout->curmenu="rating";
        //$this->layout->content = View::make('admin/rating', array('person' => $excem));
    }

    public function  postUpdaterating(){
        $r = new ApiResponse();
        $affectedRows=0;
        if(Auth::user()->is('Tutor')||Auth::user()->is('Administrador')){
            if(Input::has('idr')&&Input::has('bimester')){
                $user_id = Input::get('idr');
                $bimester = Input::get('bimester');
                $rating = Rating::where('user_id', '=', $user_id)->where('semester', '=', $bimester)->get();
                if(count($rating)>0){
                    $ratingid=$rating[0]->id;

                        $publiRating=DB::table('publication_rating')->where("rating_id","=",$ratingid)->get();
                        if(count($publiRating)>0){
                            $objPublication=$publiRating;
                            $rat=DB::table('publication_rating')->where("rating_id","=",$ratingid)->delete();
                            $usr=DB::table('user_publication')->where("user_id","=",$user_id)->where("publication_id","=",$objPublication[0]->publication_id)->delete();

                            $ratin = Rating::find($ratingid);//where('user_id', '=', $user_id)->where('semester', '=', $bimester)->delete();
                            $ratin->delete();
                            $publi=Publication::find($objPublication[0]->publication_id);
                            $publi->delete();
                            /**/
                            $r->rat=$rat;
                            $r->$usr=$usr;
                            $pathRelative =$rating[0]->path.$rating[0]->file;
                            $destinationPath = base_path(). $pathRelative;
                            if (file_exists($destinationPath)) {
                                unlink($destinationPath);
                                $r->success=true;
                            }else{
                                $r->file='false';
                                $r->success=false;
                            }

                        }else $r->success=false;
                }else{
                    $r->success=false;
                }

            }else $r->success=false;
        }
        return Response::json($r);
    }

    public function getReportrating($idBrat=null,$id=null){
        if(Auth::user()->is('Alumno')&&Auth::user()->id==$id){
            if($id!==null){
                $rpta=DB::table('ratings')->where("id","=",$idBrat)->get();
                if(count($rpta)>0){
                    $pathRelative =$rpta[0]->path.$rpta[0]->file;
                    $destinationPath = base_path(). $pathRelative;
                    if(is_file($destinationPath)){
                        header('Content-Type: application/force-download');
                        header('Content-Disposition: attachment; filename='.$rpta[0]->file);
                        header('Content-Transfer-Encoding: binary');
                        header('Content-Length: '.filesize($destinationPath));
                        readfile($destinationPath);
                    }else return "Ups,el archivo no esta disponible ";
                    /*
                    $destinationPath = base_path(). $pathRelative;
                    //$enlace = $path_a_tu_doc."/".$id;
                    header ("Content-Disposition: attachment; filename=".$destinationPath." ");
                    header ("Content-Type: application/octet-stream");
                    header ("Content-Length: ".filesize($destinationPath));
                    readfile($destinationPath);
                    /**/
                    /*
                      $content_types = [
                          'Content-Type: application/octet-stream', // txt etc
                          'Content-Type: application/msword', // doc
                          'Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document', //docx
                          'Content-Type: application/vnd.ms-excel', // xls
                          'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', // xlsx
                          'Content-Type: application/pdf', // pdf
                      ];
                      return file_put_contents($destinationPath, file_get_contents($url));
                      return Response::download($destinationPath, $rpta[0]->file, $content_types);
                      /**/
                }else{
                    return 0;
                }
            }
        }else return 0;

    }
}