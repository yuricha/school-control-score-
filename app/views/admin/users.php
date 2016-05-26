<div class="content">
<h1>Perfil</h1><hr/>

<div class="row-fluid">
    <div class="col-md-2">
        <h3 style="margin: 0 auto;text-align: center;"><button data-toggle="modal" data-target="#addUserModal" > <span title="Añadir usuario"  class="icon32 ii-user-add"></span> Añadir usuario</button> </h3><!-- icon32 ii-user-add-->
        <br>
        <div class="avatar-high text-center">

        </div>
    </div>
    <div class="col-md-10">
        <div class="profile-header">
            <h3 class="profile-name">Registros</h3>
        </div>
        <div role="tabpanel">

            <!-- Nav tabs -->
            <ul class="nav nav-tabs nav-justified nav-profile" role="tablist">
                <li role="presentation" class="active"><a href="#inicial" aria-controls="inicial" role="tab" data-toggle="tab">Inicial</a></li>
                <li role="presentation"><a href="#primaria" aria-controls="primaria" role="tab" data-toggle="tab">Primaria</a></li>
                <li role="presentation"><a href="#secundaria" aria-controls="secundaria" role="tab" data-toggle="tab">Secundaria</a></li>
                <li role="presentation"><a href="#profesor" aria-controls="profesor" role="tab" data-toggle="tab">Tutores</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content" style="  background: #fcfcfc;padding: 5px;">
                <br>
                <div role="tabpanel" class="tab-pane active" id="inicial">
                    <div id="tb" style="padding:3px">
                    </div>
                    <table id="i_initial" class="table table-hover">
                    </table>
                </div>
                <div role="tabpanel" class="tab-pane" id="primaria">
                    <table id="p_initial" class="table table-hover">

                    </table>
                </div>
                <div role="tabpanel" class="tab-pane" id="secundaria">
                    <table id="s_initial" class="table table-hover">

                    </table>
                </div>
                <div role="tabpanel" class="tab-pane" id="profesor">
                    <table id="t_initial" class="table table-hover">

                    </table>
                </div>
            </div>

        </div>
    </div>
    <div class="col-md-2"></div>

</div>

<!-- Modal -->

<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Añadir usuario</h4>
            </div>
            <form id="form_addPerson" action="<?php echo URL::to('admin/users'); ?>/adduser" method="post">
                <div class="modal-body">

                    <div class="col-xs-6">
                        <div class="form-group">

                            <label for="username">Usuario :</label>
                            <input type="text" class="form-control" name="username" id="username"  value="">
                            <label for="firstname">Nombre(s) :</label>
                            <input type="text" class="form-control" name="firstname" id="firstname"  value="">
                            <label for="lastname">Apellidos :</label>
                            <input type="text" class="form-control" name="lastname" id="lastname" value=""  >
                            <label for="dni">DNI :</label>
                            <input type="text" class="form-control"  name="dni" id="dni" value=""  >
                            <label for="born">Fecha Nacimiento :</label>
                            <input type="text" class="form-control" name="born" id="born" value=""  >


                            <label for="rol">Rol :</label>
                            <select id="rol" name="rol" class="form-control">
                                <option value="3">Alumno</option>
                                <option value="2">Tutor</option>
                            </select>
                            <br>
                            <div class="lvl">
                                <label for="level">Nivel :</label>
                                <select id="level" name="level" class="levelIni form-control">
                                    <option value="INICIAL">Inicial</option>
                                    <option value="PRIMARIA">Primaria</option>
                                    <option value="SECUNDARIA">Secundaria</option>
                                </select>
                            </div>
                            <div class="formTeacher" style="display: none">
                                <label for="levelTeacher">Nivel :</label><br>
                                <input type="checkbox" name="level_I" value="INICIAL"><label> &nbsp;Inicial</label>
                                <input type="checkbox" name="level_P" value="PRIMARIA"><label>&nbsp;Primaria</label>
                                <input type="checkbox" name="level_S" value="SECUNDARIA"><label>&nbsp;Secundaria</label><br/>
                            </div>
                            <br>
                            <label for="grade">Grado :</label>
                            <div class="grade">
                                <input type="radio"  name="grade" value="1"><label>3 años</label> &nbsp; &nbsp;
                                <input type="radio"  name="grade" value="2"><label>4 años</label> &nbsp; &nbsp;
                                <input type="radio"  name="grade" value="3"><label>5 años</label> &nbsp; &nbsp;
                                <br/>
                            </div>
                            <div class="gradecheck" style="display: none" >
                                <input type="checkbox"  name="grade1" value="1"><label>1</label> &nbsp; &nbsp;
                                <input type="checkbox"  name="grade2" value="2"><label>2</label> &nbsp; &nbsp;
                                <input type="checkbox"  name="grade3" value="3"><label>3</label> &nbsp; &nbsp;
                                <input type="checkbox"  name="grade4" value="4"><label>4</label> &nbsp; &nbsp;
                                <input type="checkbox"  name="grade5" value="5"><label>5</label> &nbsp; &nbsp;
                                <input type="checkbox"  name="grade6" value="6"><label>6</label><br/>
                            </div>
                            <br>


                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="password">Password :</label>
                            <input type="text" class="form-control" name="password" id="password" value="" >
                            <span id="generate">Generar password</span><br>
                            <label for="section">Seccion :</label>
                            <input type="text" class="form-control" name="section" id="section" value="" >

                            <label for="email">Email :</label>
                            <input type="text" class="form-control" name="email" id="email" value="" >
                            <label for="genre">Sexo :</label>
                            <select  name="genre" id="genre" class="form-control">
                                <option value="F"

                                    >Femenino</option>
                                <option value="M"

                                    >Masculino</option>
                            </select>
                            <label for="address">Direccion :</label>
                            <input type="text" class="form-control" id="address" name="address"  value="" >
                            <label for="phone">Telefono :</label>
                            <input type="text" class="form-control" name="phone" id="phone"  value="" >
                            <label for="cel">Celular :</label>
                            <input type="text" class="form-control" id="cel" name="cel" value="" >
                            <label for="resp">Nombre del responsable :</label>
                            <input type="text" class="form-control" id="resp" name="resp"  value="" >

                        </div>
                    </div>
                    <div style="clear: both;"></div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Agregar </button>
                </div>
            </form>
        </div>
    </div>
</div>

</div>

<div id="editModalUser"></div>
<div id="editModalPass"></div>
<script type="text/javascript" src="<?php echo URL::to('js/jquery-validate.js') ?>"></script>
<script type="text/javascript" src="<?php echo URL::to('js/jquery.easyui.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo URL::to('js/jquery-ui.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo URL::to('js/jquery.datetimepicker.js') ?>"></script>

<script>
var objUser={};
$(document).ready(initPage);

function initPage()
{
    $(window).resize(RESIZE_handler);
    RESIZE_handler();
    //gridInit()
    var cont="inicial";
    var data='';
    objUser=new objAdminUser(cont,data);
    objUser.drawTab();
    $('.levelIni').change(function(){
        var html='';
        if(this.value=="INICIAL"){
            html='<input type="radio"  name="grade" value="1"><label>3 años</label> &nbsp; &nbsp;'+
        '<input type="radio"  name="grade" value="2"><label>4 años</label> &nbsp; &nbsp;'+
        '<input type="radio"  name="grade" value="3"><label>5 años</label> &nbsp; &nbsp;';
            $('.grade').html(html);
        }else{
         html='<input type="radio"  name="grade" value="1"><label>1</label> &nbsp; &nbsp;'+
        '<input type="radio"  name="grade" value="2"><label>2</label> &nbsp; &nbsp;'+
        '<input type="radio"  name="grade" value="3"><label>3</label> &nbsp; &nbsp;'+
        '<input type="radio"  name="grade" value="4"><label>4</label> &nbsp; &nbsp;'+
        '<input type="radio"  name="grade" value="5"><label>5</label> &nbsp; &nbsp;'+
        '<input type="radio"  name="grade" value="6"><label>6</label> ';
            $('.grade').html(html);
        }
    });
    $("#rol").change(function(){
        if(this.value=="2"){
            $(".formTeacher").show();
            $("#grade").hide();
            $('.grade').hide();
            $(".gradecheck").show();
            $(".lvl").hide();
        }else{
            $(".formTeacher").hide();
            $("#grade").show();
            $('.grade').show();
            $(".gradecheck").hide();
            $(".lvl").show();
        }

    });
    $("#generate").click(function(){
        var length = 8,
            charset = "abcdefghijklnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789",
            retVal = "";
        for (var i = 0, n = charset.length; i < length; ++i) {
            retVal += charset.charAt(Math.floor(Math.random() * n));
        }
        //return retVal;
        $("#password").val(retVal);
    })
}

function RESIZE_handler()
{
    $('.scrollable').each(function(){
        $(this).css('height', (window.innerHeight - $(this).position().top - 70) + 'px');
        console.log(window.innerHeight - $(this).position().top);
    });

    if(window.innerWidth < 768)
        $('#content').css('left', '0');
    else
        $('#content').css('left', '100px');
}
var rules = {
    'username' : {required:true, minlength:2},
    'firstname': {required:true, minlength:2},
    'lastname': {required:true},
    'dni': {required:true},
    'password': {required:true},
    'grade': 'required',
    'section': {required:true, maxlength:1}
};

var mensajes = {
    'username' : 'Por favor ingresa el usuario',
    'firstname' : 'Por favor ingresa el nombre',
    'lastname' : 'Por favor ingresa apellidos',
    'dni': 'Debe ingresar el DNI',
    'grade': 'Debe ingresar el grado',
    'password': 'Debe ingresar password',
    'section': 'Debe ingresar seccion, una sola letra en mayuscula'
};

$('#form_addPerson').validate({
    rules: rules,
    messages: mensajes,
    errorElement: 'div',
    submitHandler: function()
    {
        var param = $('#form_addPerson').serializeArray();
        $.ajax({
            type: 'POST',
            url: $('#form_addPerson').attr('action'),
            data: param,
            success: function(data){
                console.log(data);
                if(data.status.code=="200"){
                    alert('Registro completo');
                    window.location.href=window.location.href;
                }
                else{
                    alert('Por favor ingrese valores correctos');
                }
            }
        });/**/
    }
});
$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    var target = $(e.target).attr("href") // activated tab
    console.log(target.slice(1));
    objUser.tabOn=objUser.translateTab[target.slice(1)];
    objUser.tabName=target.slice(1);
    objUser.drawTab();
});
var born=$('#born');
$(born).unbind();
$(born).datetimepicker({
    lang:'es',
    timepicker:false,
    format:'Y-m-d',
    onChangeDateTime:function(dp,$input){
        $(born).html($input.val()).val($input.val());
    }
});
/*..start obj...*/
var objAdminUser = function(tab,data){
    if(typeof (tab)!="undefined"){
        this.data        = data;
        this.translateTab= {inicial:"#i_initial",primaria:"#p_initial",secundaria:"#s_initial",profesor:"#t_initial"};
        this.tabOn       = this.translateTab[tab];
        this.URL_tab     = base_url+"/admin/users/";
        this.tabName     = tab;
    }else{
        this.data=null;
    }
}
objAdminUser.prototype.drawTab=function(){

    this.grid=$(this.tabOn).datagrid({
        url:   this.URL_tab+this.tabName,
        title:'detalle :'+this.tabName,
        iconCls:'icon-search',
        width:'100%',
        height:550,
        pagination:true,
        pageSize:10,
        remoteSort:true,
        sortName:"",
        loadFilter: function(data){
            for (var prop in data["rows"]) {
            }
            return data;
        },
        columns:[[
            {field:'ID',title:'Nº',width:40},
            {field:'usuario',title:'Usuario',width:70},
            {field:'nombre',title:'Nombre(s)',width:110,align:"center"},
            {field:'apellido',title:'Apellidos',width:160,align:"center", sortable:true},
            {field:'dni',title:'DNI',width:90,align:"center"},
            {field:'sexo',title:'Sexo',width:60,align:"center"},
            {field:'grado',title:'Grado',width:80 , sortable:true,align:"center"},
            {field:'email',title:'Email',width:135,align:"center"},
            {field:'telefono',title:'Telefono',width:90,align:"center"},
            {field:'direccion',title:'Direccion',width:140,align:"center"},
            {field:'estado',title:'Cuenta',width:90,align:"center", sortable:true},
            {field:'acciones',title:'Acciones',width:85,align:"center",
                formatter:function(val,row,index){
                    var id=-1;
                    try{
                        id=parseInt(row['id']);
                    }catch(ex){
                        id=-1;
                    }
                    var html="";
                    if(row['status']==0){
                        html+='<a class="" href="javascript:void(0)" class="easyui-linkbutton easyui-tooltip" plain="true" iconCls="icon-pencil"  style="width:40px;height:40px;" onclick="objUser.editRaw('+index+')"  '+
                        '  title="Editar" '+
                        '><img src="'+
                        base_url+'/css/icons/pencil.png"  alt="Editar"/>Editar</a>  &nbsp; &nbsp;';
                    }else{
                        html+='----';
                    }

                    return html;
                }
            },
            {field:'eliminar',title:'Eliminar',width:70,align:"center",
                formatter:function(val,row,index){
                    var html="";
                    html+='<a class="icon16 ii-user-delete"  href="javascript:void(0)" class="easyui-linkbutton easyui-tooltip" plain="true"  style="width:40px;height:40px;" onclick="objUser.deleteRow('+index+')"  '+
                    '  title="Eliminar" '+
                    '></a>  &nbsp; &nbsp;';

                    return html;
                }
            },
            {field:'password',title:'Password',width:70,align:"center",
                formatter:function(val,row,index){
                    var html="";
                    html+='<a class="icon16 ii-key2"  href="javascript:void(0)" class="easyui-linkbutton easyui-tooltip" plain="true"  style="width:40px;height:40px;" onclick="objUser.setPassword('+index+')"  '+
                    '  title="Editar password" '+
                    '></a>  &nbsp; &nbsp;';

                    return html;
                }
            }
        ]]
    });
    if(this.tabName=="profesor"){
        this.grid=$(this.tabOn).datagrid({
            columns:[[
                {field:'ID',title:'Nº',width:20},
                {field:'nombre',title:'Nombre(s)',width:110,align:"center"},
                {field:'apellido',title:'Apellidos',width:130,align:"center"},
                {field:'dni',title:'DNI',width:70,align:"center"},
                {field:'sexo',title:'Sexo',width:35,align:"center"},
                {field:'nivel',title:'Nivel',width:160 , sortable:true,align:"center"},
                {field:'grado',title:'Grado',width:60 , sortable:true,align:"center",
                    formatter:function(val,row,index){
                        var html="";
                        if(typeof row['nivel']!=="undefined"){
                            var comp=row['nivel'].trim();
                            if(comp=="INICIAL"){
                                var Name={1:"3 Años",2:"4 Años",3:"5 Años"};
                                var sect=row['grado'].trim();
                                html+=Name[sect];
                            }else html+=row['grado'];
                        }
                        return html;
                    }
                },
                {field:'seccion',title:'Seccion',width:90 , sortable:true,align:"center"},
                {field:'email',title:'Email',width:150,align:"center"},
                {field:'telefono',title:'Telefono',width:90,align:"center"},
                {field:'direccion',title:'Direccion',width:130,align:"center"},
                {field:'estado',title:'Cuenta',width:90,align:"center"},
                {field:'acciones',title:'Acciones',width:60,align:"center",
                    formatter:function(val,row,index){
                        var id=-1;
                        try{
                            id=parseInt(row['id']);
                        }catch(ex){
                            id=-1;
                        }
                        var html="";
                        //if(row['status']==0){
                        if(1){
                            html+='<a class="" href="javascript:void(0)" class="easyui-linkbutton easyui-tooltip" plain="true" iconCls="icon-pencil"  style="width:40px;height:40px;" onclick="objUser.editRawTutor('+index+')"  '+
                            '  title="Editar" '+
                            '><img src="'+
                            base_url+'/css/icons/pencil.png"  alt="Editar"/>Editar</a>  &nbsp; &nbsp;';
                        }else{
                            html+='----';
                        }

                        return html;
                    }
                },
                {field:'eliminar',title:'Eliminar',width:50,align:"center",
                    formatter:function(val,row,index){
                        var html="";
                        html+='<a class="icon16 ii-user-delete"  href="javascript:void(0)" class="easyui-linkbutton easyui-tooltip" plain="true"  style="width:40px;height:40px;" onclick="objUser.deleteRow('+index+')"  '+
                        '  title="Eliminar" '+
                        '></a>  &nbsp; &nbsp;';

                        return html;
                    }
                },
                {field:'password',title:'Password',width:70,align:"center",
                    formatter:function(val,row,index){
                        var html="";
                        html+='<a class="icon16 ii-key2"  href="javascript:void(0)" class="easyui-linkbutton easyui-tooltip" plain="true"  style="width:40px;height:40px;" onclick="objUser.setPassword('+index+')"  '+
                        '  title="Editar password" '+
                        '></a>  &nbsp; &nbsp;';

                        return html;
                    }
                }
            ]]
        });
    }

}


objAdminUser.prototype.editRaw=function(index){
    // console.log(index);
    var row = $(this.grid).datagrid('getRows');
    var form='';
    if(typeof (row)=="object"){
        this.id=row[index].id;
        form+='</br><form id="edit_user"><div> ' +
        '<div class="left" style="float: left;width: 50%">' +
        '<div class="form-group"><label for="firstname" style="font-weight: bold;">Nombre :</label><input for="firstname_" name="firstname_" style="width: 80%;height: 24px;" type="text" id="firstname_" value="'+row[index].nombre+'" ></div>' +
        '<div class="form-group"><label for="lastname" style="font-weight: bold;">Apellidos :</label><input for="lastname_" name="lastname_" style="width: 80%;height: 24px;" type="text" id="lastname_" value="'+row[index].apellido+'" ></div>' +
        '<div class="form-group"><label for="dni_" style="font-weight: bold;">DNI :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label><input for="dni_" name="dni_" style="width: 80%;height: 24px;" type="text" id="dni_" value="'+row[index].dni+'" ></div>' +
        '<div class="form-group"><label for="born_" style="font-weight: bold;">Fecha nacimiento :</label><input for="born_" name="born_" style="width: 80%;height: 24px;" type="text" id="born_" value="'+row[index].nacimiento+'" ></div>' +
        '<div class="form-group"><label for="email_" style="font-weight: bold;">Email :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><input name="email_" value="'+row[index].email+'"  style="width: 80%;height: 24px;" type="text"  id="email" ></div>' +

        '<div class="form-group"><label for="rol_" style="font-weight: bold;">Rol :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><select style="width: 80%;height: 30px;" id="rol_" name="rol_" class="form-control"><option value="2">Tutor</option><option value="3">Alumno</option></select></div>' +
        '<div class="form-group"><label for="status" style="font-weight: bold;">Estado de cuenta:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/></label> <div style="font-size: 12px"><input type="radio"  name="status"class="status" value="1">Verificado <input type="radio"  name="status"class="status" value="0">&nbsp;No verificado</div></div>' +

        '</div>' +
        '<div class="right" style="float: left;  width: 50%;">' +
        '<div class="levelStudent"><div class="form-group"><label for="level_"  style="font-weight: bold;">Nivel :</label><select style="width: 80%;height: 30px;" id="level_" name="level_" class="form-control valid"><option value="INICIAL" >Inicial</option><option value="PRIMARIA" >Primaria</option><option value="SECUNDARIA">Secundaria</option></select></div></div>' +
        '<div class="formTeacher_" style="display: none">'+
        '<label for="levelTeacher">Nivel :</label><br>'+
        '<input type="checkbox" id="level_I" name="level_I" value="INICIAL"><label> &nbsp;Inicial</label>'+
        '<input type="checkbox" id="level_P" name="level_P" value="PRIMARIA"><label>&nbsp;Primaria</label>'+
        '<input type="checkbox" id="level_S" name="level_S" value="SECUNDARIA"><label>&nbsp;Secundaria</label><br/>'+
        '</div>'+/**/
        '<div class="form-group grade_edit_t"><label for="grade_" style="font-weight: bold;">Grado :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>' +
            '<select style="width: 80%;height: 30px;" name="grade_" id="grade_" class=" viewgrade form-control">'+
            '</select>'+
       '</div>' +
        '<div class="gradecheck_t" style="display: none" ><label for="grade_" style="font-weight: bold;">Grado:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><br>'+
        ' <span class="gradold"><input type="checkbox"  name="grade1" value="1"><label>1</label> &nbsp; &nbsp;'+
        '<input type="checkbox"  name="grade2" value="2"><label>2</label> &nbsp; &nbsp;'+
        '<input type="checkbox"  name="grade3" value="3"><label>3</label> &nbsp; &nbsp;'+
        '<input type="checkbox"  name="grade4" value="4"><label>4</label> &nbsp; &nbsp;'+
        '<input type="checkbox"  name="grade5" value="5"><label>5</label> &nbsp; &nbsp;'+
        '<input type="checkbox"  name="grade6" value="6"><label>6</label></span> <br/>'+
        '</div>'+
        '<span class="ini" style="display: none"><input type="checkbox" id="grade1I" name="grade1I" value="1"><label>3 años</label> &nbsp; &nbsp;'+
        '<input type="checkbox" id="grade2I"  name="grade2I" value="2"><label>4 años</label> &nbsp; &nbsp;'+
        '<input type="checkbox" id="grade3I"  name="grade3I" value="3"><label>5 años</label> &nbsp; &nbsp;</br> </span>'+
        '<div class="form-group"><label for="section_" style="font-weight: bold;">Seccion :</label><input name="section_" value="'+row[index].seccion+'"  style="width: 80%;height: 24px;" type="text"  id="section_" ></div>' +
        '<div class="form-group"><label for="genre_" style="font-weight: bold;">Sexo :</label><select style="width: 80%;height: 30px;"  name="genre_" id="genre_" class="form-control"><option value="F">Femenino</option><option value="M">Masculino</option></select></div>' +
        '<div class="form-group"><label for="address_" style="font-weight: bold;">Direccion :</label><input name="address_" value="'+row[index].direccion+'"  style="width: 80%;height: 24px;" type="text"  id="address_" ></div>' +
        '<div class="form-group"><label for="phone_" style="font-weight: bold;">Telefono :</label><input name="phone_" value="'+row[index].telefono+'"  style="width: 80%;height: 24px;" type="text"  id="phone" ></div>' +
        '<div class="form-group"><label for="cel_" style="font-weight: bold;">Celular :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><input name="cel_" value="'+row[index].celu+'"  style="width: 80%;height: 24px;" type="text"  id="cel_" ></div>' +
        '<div class="form-group"><label for="resp_" style="font-weight: bold;">Responsable :</label><input name="resp_" value="'+row[index].responsable+'"  style="width: 80%;height: 24px;" type="text"  id="resp" ></div>' +
        '</div>';
        form+=' </div> </form>';
    }

    $("#editModalUser").html(form);

    $('#level_I').change(function() {
        if($(this).is(":checked")) {
            $('.ini').show();
            $('.gradold').hide();

        }else{
            $('.ini').hide();
            $('.gradold').show();
        }
        $('#level_S').prop( "checked", false );
        $('#level_P').prop( "checked", false );
    });
    $('#level_P').change(function() {
        $('#level_I').prop( "checked", false );
        $('.ini').hide();
        $('.gradold').show();
    });
    $('#level_S').change(function() {
        $('#level_I').prop( "checked", false );
        $('.ini').hide();
        $('.gradold').show();
    });
    $("#rol_").unbind();
    $("#level_").change(function(){
        var gradehtml='';
        if(this.value=="INICIAL"){
            gradehtml+='<option value="1">3 años</option>';
            gradehtml+='<option value="2">4 años</option>';
            gradehtml+='<option value="3">5 años</option>';
            $("#grade_").html(gradehtml);
        }else{
            gradehtml+='<option value="1">primero</option>';
            gradehtml+='<option value="2">segundo</option>';
            gradehtml+='<option value="3">tercero</option>';
            gradehtml+='<option value="4">cuarto</option>';
            gradehtml+='<option value="5">quinto</option>';
            gradehtml+='<option value="6">sexto</option>';
            $("#grade_").html(gradehtml);
        }
    });
    $("#rol_").change(function(){
        if(this.value=="2"){
            $(".formTeacher_").show();
            $(".levelStudent").hide();
            $(".grade_edit_t").hide();
            $(".gradecheck_t").show();
            $(".viewgrade").hide();
        }else{
            $(".viewgrade").show();
            $(".formTeacher_").hide();
            $(".levelStudent").show();
            $(".grade_edit_t").show();
            $(".gradecheck_t").hide();
        }
    });/**/
    var born=$('#born_');
    $(born).unbind();
    $(born).datetimepicker({
        lang:'es',
        timepicker:false,
        format:'Y-m-d',
        onChangeDateTime:function(dp,$input){
            $(born).html($input.val()).val($input.val());
        }
    });

    $("#editModalUser").dialog({
        resizable: false,
        modal: true,
        title: "Editar",
        height: 600,
        width: 650,
        buttons: {
            "Guardar": function () {
                var target = $('#edit_user');
                var params = target.serializeArray();
                params.push({name:"id",value:objUser.id});
                console.log(params);
                $.post(objUser.URL_tab+'updateuser', params, function(_result){
                    if(_result.data.success){
                        $(objUser.grid).datagrid('reload');
                    }
                });
                $(this).dialog('close');
                /**/
            },
            "Cancelar": function () {
                $(this).dialog('close');
                //callback(false);
            }
        }
    });
    var lev={inicial:"INICIAL",primaria:"PRIMARIA",secundaria:"SECUNDARIA"};

    if(typeof (lev[this.tabName])=="undefined")$("#level_").val(row[index].nivel);
    else $("#level_").val(lev[this.tabName]);

    $("#genre_").val(row[index].sexo);
    this.status=row[index].status;
    this.verificado=row[index].verificado;
    $('.status').each(function(){
        if(objUser.verificado==parseInt($(this).val())){
            $(this).attr('checked','checked');
            $(this).prop( "checked", true );
        }
    });
    $(".status").click(function(){
        $('.status').each(function(){
            $(this).removeAttr('checked');
        });
        $(this).attr('checked', true);
        $(this).prop( "checked", true );
    });

    var gradehtml='';
    if(this.tabName=="inicial"){
        gradehtml+='<option value="1">3 años</option>';
        gradehtml+='<option value="2">4 años</option>';
        gradehtml+='<option value="3">5 años</option>';
    }else{
        gradehtml+='<option value="1">primero</option>';
        gradehtml+='<option value="2">segundo</option>';
        gradehtml+='<option value="3">tercero</option>';
        gradehtml+='<option value="4">cuarto</option>';
        gradehtml+='<option value="5">quinto</option>';
        gradehtml+='<option value="6">sexto</option>';
    }
    $('#grade_').append(gradehtml).val(row[index].gradonum);
    console.log(row[index].status);

    $("#rol_").val(row[index].type)
}

objAdminUser.prototype.deleteRow =function(index){
    if(confirm("'Estas seguro de eliminar este registro ?")){
        var $thiss=this;
        var row = $(objUser.grid).datagrid('getRows');
        this.id=row[index].id;
        if(typeof this.id !=="undefined"){
            var params={id:this.id}
            $.post($thiss.URL_tab+'deleteusuer', params, function(_result){
                console.log(_result);
            });
        }
        //console.log(row[index]);
    }
}
objAdminUser.prototype.setPassword = function(index){
    if(confirm("'Estas seguro de editar el password de este registro ?")){
        var row = $(objUser.grid).datagrid('getRows');
        this.id=row[index].id;
        this.user=row[index].usuario;
        var form='';
        form+='</br><div id="edit_pass"><div>';
        form+='<div class="form-group"><label for="passEdit" style="font-weight: bold;">Nuevo Password :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><input name="passEdit" value=""  style="width: 80%;height: 24px;" type="text"  id="passEdit" ><br>';
        form+='<span id="generate2" style="font-size: 11px;cursor: pointer">Generar password</span></div>';
        form+='</div></div>';
        $("#editModalPass").html(form);
        $("#generate2").unbind();
        $("#generate2").click(function(){
            var length = 8,
                charset = "abcdefghijklnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789",
                retVal = "";
            for (var i = 0, n = charset.length; i < length; ++i) {
                retVal += charset.charAt(Math.floor(Math.random() * n));
            }
            $("#passEdit").val(retVal);

        })
        var $thiss=this;
        $("#editModalPass").dialog({
            resizable: false,
            modal: true,
            title: "Editar password: "+this.user,
            height: 250,
            width: 350,
            buttons: {
                "Guardar": function () {
                    if(typeof (this.id)!=="undefined" && $("#passEdit").val()!==""){
                        var params={id:$thiss.id,password:$("#passEdit").val()};
                        console.log(params);
                        $.post($thiss.URL_tab+'setpassword', params, function(_result){
                            console.log(_result);
                        });
                        /**/
                    }
                    $(this).dialog('close');
                },
                "Cancelar": function () {
                    $(this).dialog('close');
                    //callback(false);
                }
            }
        });
    }
}
objAdminUser.prototype.editRawTutor = function(index){
    var row = $(this.grid).datagrid('getRows');
    var form='';
    if(typeof (row)=="object"){
        this.id=row[index].id;
        form+='</br><form id="edit_user"><div> ' +
        '<div class="left" style="float: left;width: 50%">' +
        '<div class="form-group"><label for="firstname" style="font-weight: bold;">Nombre :</label><input for="firstname_" name="firstname_" style="width: 80%;height: 24px;" type="text" id="firstname_" value="'+row[index].nombre+'" ></div>' +
        '<div class="form-group"><label for="lastname" style="font-weight: bold;">Apellidos :</label><input for="lastname_" name="lastname_" style="width: 80%;height: 24px;" type="text" id="lastname_" value="'+row[index].apellido+'" ></div>' +
        '<div class="form-group"><label for="dni_" style="font-weight: bold;">DNI :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label><input for="dni_" name="dni_" style="width: 80%;height: 24px;" type="text" id="dni_" value="'+row[index].dni+'" ></div>' +
        '<div class="form-group"><label for="born_" style="font-weight: bold;">Fecha nacimiento :</label><input for="born_" name="born_" style="width: 80%;height: 24px;" type="text" id="born_" value="'+row[index].nacimiento+'" ></div>' +
        '<div class="form-group"><label for="email_" style="font-weight: bold;">Email :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><input name="email_" value="'+row[index].email+'"  style="width: 80%;height: 24px;" type="text"  id="email" ></div>' +

        '<div class="form-group"><label for="rol_t" style="font-weight: bold;">Rol :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><select style="width: 80%;height: 30px;" id="rol_t" name="rol_t" class="form-control"><option value="2">Tutor</option><option value="3">Alumno</option></select></div>' +
        '<div class="form-group"><label for="status" style="font-weight: bold;">Estado de cuenta:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/></label> <div style="font-size: 12px"><input type="radio"  name="status"class="status" value="1">Verificado <input type="radio"  name="status"class="status" value="0">&nbsp;No verificado</div></div>' +

        '</div>' +
        '<div class="right" style="float: left;  width: 50%;">' +
        '<div class="levelStudent" style="display: none"><div class="form-group"><label for="level_"  style="font-weight: bold;">Nivel :</label><select style="width: 80%;height: 30px;" id="level_" name="level_" class="form-control valid"><option value="INICIAL" >Inicial</option><option value="PRIMARIA" >Primaria</option><option value="SECUNDARIA">Secundaria</option></select></div></div>' +
        '<div class="formTeacher_" >'+
        '<label for="levelTeacher">Nivel :</label><br>'+
        '<input type="checkbox" id="level_I" name="level_I" value="INICIAL"><label> &nbsp;Inicial&nbsp;&nbsp;</label>'+
        '<input type="checkbox" id="level_P" name="level_P" value="PRIMARIA"><label>&nbsp;Primaria&nbsp;&nbsp;</label>'+
        '<input type="checkbox" id="level_S" name="level_S" value="SECUNDARIA"><label>&nbsp;Secundaria&nbsp;&nbsp;</label><br/>'+
        '</div>'+/**/
        '<div class="form-group grade_edit_t"  style="display: none" ><label for="grade_" style="font-weight: bold;">Grado :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><select  style="width: 80%;height: 30px;" name="grade_ai" id="grade_ai"> <option value="1">3 años</option><option value="2">4 años</option><option value="3">5 años</option></select></div>' +
        '<div class="gradecheck_t"><label for="grade_" style="font-weight: bold;">Grado:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><br>' +
        '<span class="ini"><input type="checkbox" id="grade1I" name="grade1I" value="1"><label>3 años</label> &nbsp; &nbsp;'+
        '<input type="checkbox" id="grade2I"  name="grade2I" value="2"><label>4 años</label> &nbsp; &nbsp;'+
        '<input type="checkbox" id="grade3I"  name="grade3I" value="3"><label>5 años</label> &nbsp; &nbsp;</br> </span>'+

        '<span class="other"><input type="checkbox" id="grade1" name="grade1" value="1"><label>1</label> &nbsp; &nbsp;'+
        '<input type="checkbox" id="grade2"  name="grade2" value="2"><label>2</label> &nbsp; &nbsp;'+
        '<input type="checkbox" id="grade3"  name="grade3" value="3"><label>3</label> &nbsp; &nbsp;'+
        '<input type="checkbox" id="grade4"  name="grade4" value="4"><label>4</label> &nbsp; &nbsp;'+
        '<input type="checkbox" id="grade5"   name="grade5" value="5"><label>5</label> &nbsp; &nbsp;'+
        '<input type="checkbox" id="grade6"  name="grade6" value="6"><label>6</label> </span><br/>'+
        '</div>'+
        '<div class="form-group"><label for="section_" style="font-weight: bold;">Seccion :</label><br><input name="section_" value="'+row[index].seccion+'"  style="width: 80%;height: 24px;" type="text"  id="section_" ></div>' +
        '<div class="form-group"><label for="genre_" style="font-weight: bold;">Sexo :</label><select style="width: 80%;height: 30px;"  name="genre_" id="genre_" class="form-control"><option value="F">Femenino</option><option value="M">Masculino</option></select></div>' +
        '<div class="form-group"><label for="address_" style="font-weight: bold;">Direccion :</label><input name="address_" value="'+row[index].direccion+'"  style="width: 80%;height: 24px;" type="text"  id="address_" ></div>' +
        '<div class="form-group"><label for="phone_" style="font-weight: bold;">Telefono :</label><input name="phone_" value="'+row[index].telefono+'"  style="width: 80%;height: 24px;" type="text"  id="phone" ></div>' +
        '<div class="form-group"><label for="cel_" style="font-weight: bold;">Celular :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><input name="cel_" value="'+row[index].celu+'"  style="width: 80%;height: 24px;" type="text"  id="cel_" ></div>' +
        '<div class="form-group"><label for="resp_" style="font-weight: bold;">Responsable :</label><input name="resp_" value="'+row[index].responsable+'"  style="width: 80%;height: 24px;" type="text"  id="resp" ></div>' +
        '</div>';
        form+=' </div> </form>';
    }
    $("#editModalUser").html(form);
    $("#rol_t").unbind();
    $("#rol_t").change(function(){
        if(this.value=="2"){

            $(".formTeacher_").show();
            $(".levelStudent").hide();
            $(".grade_edit_t").hide();
            $(".gradecheck_t").show();

        }else{

            $(".formTeacher_").hide();
            $(".levelStudent").show();
            $(".grade_edit_t").show();
            $(".gradecheck_t").hide();

        }
    });/**/

    $('#level_').change(function(){
        var gradehtml='';
        if(this.value=="INICIAL"){
            gradehtml+='<option value="1">3 años</option>';
            gradehtml+='<option value="2">4 años</option>';
            gradehtml+='<option value="3">5 años</option>';
            $("#grade_ai").html(gradehtml);
        }else{
            gradehtml+='<option value="1">primero</option>';
            gradehtml+='<option value="2">segundo</option>';
            gradehtml+='<option value="3">tercero</option>';
            gradehtml+='<option value="4">cuarto</option>';
            gradehtml+='<option value="5">quinto</option>';
            gradehtml+='<option value="6">sexto</option>';
            $("#grade_ai").html(gradehtml);
        }
    });
    $('#level_I').change(function() {
        if($(this).is(":checked")) {
            $('.ini').show();
            $('.other').hide();
            $('#level_S').prop( "checked", false );
            $('#level_P').prop( "checked", false );

        }else{
            $('.ini').hide();
            $('.other').show();
        }
    });    $('#level_P').change(function() {
        if($(this).is(":checked")) {
            $('.ini').hide();
            $('.other').show();
            $('#level_I').prop( "checked", false );
        }
    });    $('#level_S').change(function() {
        if($(this).is(":checked")) {
            $('.ini').hide();
            $('.other').show();
            $('#level_I').prop( "checked", false );
        }
    });
    var born=$('#born_');
    $(born).unbind();
    $(born).datetimepicker({
        lang:'es',
        timepicker:false,
        format:'Y-m-d',
        onChangeDateTime:function(dp,$input){
            $(born).html($input.val()).val($input.val());
        }
    });
    this.status=row[index].status;
    this.verificado=row[index].verificado;
    $('.status').each(function(){
        if(objUser.verificado==parseInt($(this).val())){
            $(this).attr('checked','checked');
            $(this).prop( "checked", true );
        }
    });
    $(".status").click(function(){
        $('.status').each(function(){
            $(this).removeAttr('checked');
        });
        $(this).attr('checked', true);
        $(this).prop( "checked", true );
    });
    var level=row[index].nivel.split(" ");
    var levelName='';
    for(var lv in level){
        if(level[lv]=="INICIAL"){
            levelName="INICIAL";
            $('#level_I').prop( "checked", true );
        }
        else if(level[lv]=="PRIMARIA")$('#level_P').prop( "checked", true );
        else if(level[lv]=="SECUNDARIA")$('#level_S').prop( "checked", true );
    }
    var grade=row[index].grado.split(" ");
    for(var gr in grade){
        if(levelName=="INICIAL"){
            $('.ini').show();
            $('.other').hide();
            if(grade[gr]!=="")$('#grade'+grade[gr]+'I').prop( "checked", true );
        }else {
            $('.ini').hide();
            $('.other').show();
            if(grade[gr]!=="")$('#grade'+grade[gr]).prop( "checked", true );
        }
    }
    //console.log(level);
    $("#editModalUser").dialog({
        resizable: false,
        modal: true,
        title: "Editar",
        height: 600,
        width: 650,
        buttons: {
            "Guardar": function () {
                var target = $('#edit_user');
                var params = target.serializeArray();
                params.push({name:"id",value:objUser.id});
                $.post(objUser.URL_tab+'updatetutor', params, function(_result){
                    if(_result.data.success){
                        $(objUser.grid).datagrid('reload');
                    }
                });
                $(this).dialog('close');
                /**/
            },
            "Cancelar": function () {
                $(this).dialog('close');
                //callback(false);
            }
        }
    });
}
</script>
