 <div class="content">
    <?php
    if(count($person) == 0)
    {
        echo '<div class="error_empty"><h1>No existen usuarios para mostrar</h1><p>Aún no se agregaron usuarios en el sistema</p></div>';
    }else{
        if(Auth::user()->is('Alumno'))echo '<h1>Perfil - Alumno </h1><hr/>';
        elseif(Auth::user()->is('Tutor'))echo '<h1>Perfil - Tutor</h1><hr/>';
        else echo '<h1>Perfil admin</h1><hr/>';
        ?>
        <div class="row-fluid">
            <div class="col-md-3">
                <h3 style="margin: 0 auto;text-align: center;"> <?php echo $person->firstname; ?></h3>
                <br>
                <div class="avatar-high text-center">
                    <img src="<?php echo URL::to('images/app/avatar.png'); ?>" class="thumbnail img-responsive" alt="">
                </div>
            </div>
            <div class="col-md-8">
                <div id="profile" class="block_info">
                    <h3 class="titleinfo">Datos Personales :</h3>
                    <table class="table table-hover" style="background: #fcfcfc;">
                        <tbody>
                        <tr>
                            <th>Nombres y Apellidos</th>
                            <th>Usuario</th>
                            <th>DNI</th>
                            <th>Nivel</th>

                        </tr>
                        <tr>
                            <td><?php echo $person->firstname." ".$person->lastname; ?></td>
                            <td><?php echo Auth::user()->username; ?></td>
                            <td><?php echo $person->dni; ?></td>
                            <td><?php echo $person->nameLevel; ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <th>Fecha de nacimiento</th>
                            <th>Sexo</th>
                            <th>Grado</th>

                        </tr>
                        <tr>
                            <td><a href="mailto: <?php echo Auth::user()->email;?>" target="_blank"><?php echo Auth::user()->email;?></a></td>
                            <td><?php echo $person->birthdate;?></td>
                            <td><?php echo $person->genre;?></td>
                            <td><?php echo $person->nameGrade; ?></td>

                        </tr>
                        <tr>
                            <th>Dirección</th>
                            <th>Teléfono</th>
                            <?php if(Auth::user()->is('Alumno'))echo '<th>Apoderado</th>'; ?>
                            <!--<th>Fecha de registro</th>-->
                            <th>Sección</th>

                        </tr>
                        <tr>
                            <td><?php echo $person->address; ?></td>
                            <td><?php echo $person->phone1;?></td>
                            <?php if(Auth::user()->is('Alumno'))echo '<th>'.$person->responsible.'</th>';?>

                            <td><?php echo $person->nameSection; ?></td>
                        </tr>
                        </tbody>
                    </table>
                    <a href="#edit_profile" ><p class="text-center">
                            <button  data-toggle="modal" data-target="#profileModal" id=""  type="button"><span class="icon32 ii-edit"></span> Editar
                            </button></p>
                    </a>
                    <!--<a href="#edit_profile" class="btn btn-small btn-add pull-right"><span class="icon-add"></span> Agregar dispositivo</a>-->
                </div>

            </div>
            <div class="col-md-2"></div>

        </div>
    <?php
    }
    ?>
<!-- Modalito -->
<div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Editar perfil</h4>

            </div>
            <div class="modal-body">
                <form id="form_editprofile" action="<?php
                 if(Auth::user()->is('Administrador'))echo URL::to('admin/profile');
                 elseif(Auth::user()->is('Alumno'))echo URL::to('user/profile');
                 elseif(Auth::user()->is('Tutor'))echo URL::to('publisher/profile');
                ?>/update" method="post">
                    <div class="col-xs-6">
                        <div class="form-group">

                            <label for="firstname">Nombre :</label>
                            <input type="text" class="form-control"  name="firstname" id="firstname"  value="<?php echo $person->firstname ?>">
                            <label for="lastname">Apellidos :</label>
                            <input type="text" class="form-control" name="lastname" id="lastname" value="<?php echo $person->lastname ?>"  >
                            <label for="birthdate">Fecha Nacimiento :</label>
                            <input type="text" class="form-control" id="birthdate" name="birthdate" value="<?php echo $person->birthdate?>"  >
                            <!--<label for="grade">Grado</label>
                            <input type="text" class="form-control" id="grade" name="grade" value="<?php echo $person->grade ?>" >-->
                            <label for="grade">email :</label>
                            <input type="text" class="form-control" id="email" name="email" value="<?php echo Auth::user()->email; ?>" >



                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="username">Usuario :</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?php echo Auth::user()->username; ?>" >
                            <label for="genre">Sexo :</label>
                            <select id="genre" name="genre" class="form-control">
                                <option value="F"
                                    <?php if($person->genre=="F") echo "selected='selected'"?>
                                    >Femenino</option>
                                <option value="M"
                                    <?php if($person->genre=="M") echo "selected='selected'"?>
                                    >Masculino</option>
                            </select>
                            <label for="address">Dirección :</label>
                            <input type="text" class="form-control" id="address" name="address" value="<?php echo $person->address ?>" >
                            <label for="phone1">Teléfono :</label>
                            <input type="text" class="form-control" id="phone1" name="phone1"  value="<?php echo $person->phone1?>" >
                            <label for="phone2">Celular :</label>
                            <input type="text" class="form-control" id="phone2" name="phone2"  value="<?php echo $person->phone2?>" >
                            <?php if(Auth::user()->is('user')){?>
                                <label for="responsible">Responsable :</label>
                                <input type="text" class="form-control" id="responsible" name="responsible" value="<?php echo $person->responsible?>" >
                            <?php } ?>

                        </div>
                    </div>
                    <div style="clear: both;"></div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Guadar cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>
    <script type="text/javascript" src="<?php echo URL::to('js/jquery-validate.js') ?>"></script>
    <script type="text/javascript" src="<?php echo URL::to('js/jquery.datetimepicker.js') ?>"></script>
<script>
    var uriNow=window.location.href;
    var rules = {
        'username' : {required:true, minlength:2},
        'firstname': {required:true, minlength:2},
        'lastname': {required:true},
        'dni': {required:true},
        'grade':{
            required:true,
            number:true
        },
        'email':{
            required:true,
            email:true
        }
    };

    var mensajes = {
        'username' : 'Por favor ingresar  usuario',
        'firstname' : 'Por favor ingresar  nombre',
        'lastname' : 'Por favor ingresar apellidos',
        'dni': 'Debe ingresar el DNI',
        'grade': 'Debe ingresar el grado en números',
        'email':'Por favor ingrese un email'
    };
    $(document).ready(initPage);
function initPage(){
    var birthdate=$('#birthdate');
    $(birthdate).unbind();
    $(birthdate).datetimepicker({
        lang:'es',
        timepicker:false,
        format:'Y-m-d',
        onChangeDateTime:function(dp,$input){
            $(birthdate).html($input.val());
            $(birthdate).val($input.val());
        }
    });

    $('#form_editprofile').validate({
        rules: rules,
        messages: mensajes,
        errorElement: 'div',
        submitHandler: function()
        {
            var param = $('#form_editprofile').serializeArray();
             $.ajax({
             type: 'POST',
             url: $('#form_editprofile').attr('action'),
             data: param,
             success: function(data){
                 if(data.status.code=="200"){
                     location.replace(uriNow);
                 }
                 else{
                 alert('Por favor ingrese valores correctos');
                 }
             }
             });/**/
        }
    });
}

</script>