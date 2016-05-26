<?php
/**
 * Created by PhpStorm.
 * User: Yuri
 * Date: 25/03/2015
 * Time: 08:31 AM
 */

class AdminProfileController extends BaseController {
    protected $layout = 'ci.tpl_admin';
    public function index(){

        $persone=Person::where("people.user_id","=",Auth::user()->id)->get();
        if(isset($persone)&&count($persone)>0){

            $level=DB::table('levels')->where('levels.user_id',"=", Auth::user()->id)->get();
            $l='';
            foreach($level as $v){
                $l.=' '.$v->name;
                $namelevel=$v->name;
            }
            $grade=DB::table('grades')->where('grades.user_id',"=", Auth::user()->id)->get();
            $g='';
            $gradoImicial=array(1=>"3 años",2=>"4 años",3=>"5 años",);
            foreach($grade as $v){

                if($namelevel=="INICIAL"){
                    $g.=' '.$gradoImicial[$v->name];
                }else{
                    $g.=' '.$v->name;
                }
            }

            $section=DB::table('sections')->where('sections.user_id',"=", Auth::user()->id)->get();
            $s='';
            foreach($section as $v){
                $s.=' '.$v->name;
            }
                $persone[0]->nameGrade=$g;
                $persone[0]->nameLevel=$l;
                $persone[0]->nameSection=$s;
        }
        $this->layout->content = View::make('admin/profile', array('person' => $persone[0]));
        $this->layout->curmenu="home";/**/
    }

   /* public function adminuser(){
        $users=array();
        if(Auth::user()->is('admin')){
            $this->layout->content = View::make('admin/users', array('users' => $users));
            $this->layout->curmenu="adminuser";
        }
    }/**/

    public function postUpdate(){
        $r = new ApiResponse();
        if(Auth::user()->dni) {
            try {
                DB::BeginTransaction();
                $user = User::find(Auth::user()->id);
                $valid = $user->isValid(Input::all());
                if($valid){
                    $into=false;
                    if(intval(Auth::user()->dni)==intval(Input::get("dni")))$into=true;
                    else{
                        $sameuser=DB::table('users')->where('dni', Input::get("dni"))->get();
                        if(count($sameuser)>0)$into=false;
                        else $into=true;
                    }
                    if($into){
                        $user->email= Input::get("email");
                        $user->username= Input::get("username");
                        if(Input::has('dni'))$user->dni   = Input::get("dni");
                        if($user->save()){
                            $rpta = DB::table('people')->where('user_id', Auth::user()->id)->get();
                            $per  = Person::find($rpta[0]->id);
                            $valid = $per->isValid(Input::all());
                            if($valid){
                                $per->firstname = Input::get("firstname");
                                $per->lastname  = Input::get("lastname");
                                $per->dni       = Input::get("dni");
                                if(Input::has('birthdate'))$per->birthdate = Input::get("birthdate");
                                if(Input::has('grade'))$per->grade         = Input::get("grade");
                                if(Input::has('level'))$per->level         = Input::get("level");
                                if(Input::has('address'))$per->address     = Input::get("address");
                                if(Input::has('phone1'))$per->phone1      = Input::get("phone1");
                                if(Input::has('responsible'))$per->responsible = Input::get("responsible");
                                if(Input::has('phone2'))$per->phone2       = Input::get("phone2");
                                if(Input::has('genre'))$per->genre         = Input::get("genre");
                                $per->save();
                                $r->setData(array("success"=>$per));
                            }
                        }
                    }else{
                        $r->status->description = "El DNI ingresado ya esta registrado";
                    }
                }else $r->status->description = "Datos no validos";

                DB::commit();
            }catch (\Exception $e) {
                DB::rollback ();
                $r->status->code = "220";
                $r->status->description = $e->getMessage ();
            }
    }
        return Response::json($r);
    }

} 