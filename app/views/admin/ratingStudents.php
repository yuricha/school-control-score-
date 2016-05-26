<div class="content">
    <h1>Libretas</h1><hr/>

    <div class="row-fluid">
        <div class="col-md-2">

        </div>
        <div class="col-md-10">
            <div class="profile-header">
                <h3 class="profile-name">Libretas</h3>
            </div>
            <table id="ownerGrades" class="table table-hover">
            </table>
        </div>
        <div class="col-md-2"></div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close close-custom"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Añadir archivo</h4>
                </div>
                <div class="modal-body">
                    <div id="mulitplefileuploader">Cargar archivo</div>
                    <br>
                    <div class="form-group">
                        <label for="semester">Semestre :</label>
                        <select name="semester" id="semester">
                            <option value="-1">Escoger</option>
                            <option value="1">1er Semestre</option>
                            <option value="2">2do Semestre</option>
                        </select>
                    </div>

                    <div id="status"></div>
                    <div id="msg"></div>
                    <!--<input type="text" class="form-control" name="semester" id="email" value="" >
                    <label for="year">Año :</label>
                    <input type="text" class="form-control" name="year" id="email" value="" >-->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-cancel-custom" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

</div>
<div id="editModalLib">

</div>
<script type="text/javascript" src="<?php echo URL::to('js/jquery-validate.js') ?>"></script>
<script type="text/javascript" src="<?php echo URL::to('js/jquery.easyui.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo URL::to('js/jquery-ui.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo URL::to('js/jquery-easy-datagrid-detailview.js') ?>"></script>
<script>
    var objUser={};
    $(document).ready(function()
    {
        var cont="ownerGrades";
        var data='';
        objUser=new objLib(cont,data);
        objUser.drawTab();

    });
    var objLib = function(tab,data){
        if(typeof (tab)!="undefined"){
            this.data        = data;
            this.tabOn       = "#"+tab;
            <?php if(Auth::user()->is('Alumno')){?>
            this.URL_tab     = base_url+"/user/rating/ratingalumno";
            this.URL_down     = base_url+"/user/rating/";
            <?php } ?>
            this.tabName     = tab;
        }else{
            this.data=null;
        }
    }

    objLib.prototype.drawTab=function(){
        this.grid=$(this.tabOn).datagrid({
            url: this.URL_tab,
            pagination:true,
            title:'Mis libretas',
            iconCls:'icon-search',
            width:"100%",
            height:550,
            loadFilter: function(data){
                for (var prop in data["rows"]) {
                }
                return data;
            },
            columns:[[
                {field:'num',title:'Numero',width:70,align:"center"},
                {field:'year',title:'Año',width:100,align:"center"},
                {field:'bimester',title:'Bimestre',width:180,align:"center"},
                {field:'fecha',title:'Fecha de subida',width:150,align:"center"},
                {field:'status',title:'Estado',width:140,align:"center"},
                {field:'nombre',title:'Nombre libreta.',width:200},
                {field:'notas',title:'Descargar libreta',width:160,align:"center"},
                {field:'accion',title:'Acciones',width:170}

            ]]
        });
    }
    objLib.prototype.getDoc = function (b,i) {
        window.open(this.URL_down+'reportrating/'+b+'/'+i, '_blank');
    }
</script>