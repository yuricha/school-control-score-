<script type="text/javascript" src="<?php echo URL::to('js/jquery.form.js') ?>"></script>
<script type="text/javascript" src="<?php echo URL::to('js/jquery.uploadfile.js') ?>"></script>
<div class="content">
    <h1>Libretas</h1><hr/>

    <div class="row-fluid">
        <div class="col-md-2">
            <?php if(Auth::user()->is('Administrador')||Auth::user()->is('Tutor')){?>
                <h3 style="margin: 0 auto;text-align: center;"><button data-toggle="modal" data-target="#addUserModal" > <span class="icon-32 ii-upload"></span> Subir libreta</button> </h3>
            <?php } ?>

        </div>
        <div class="col-md-10">
            <div class="profile-header">
                <h3 class="profile-name">Libretas</h3>
            </div>
            <div role="tabpanel">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs nav-justified nav-profile" role="tablist">
                    <li role="presentation" class="active"><a href="#inicial" aria-controls="inicial" role="tab" data-toggle="tab">Inicial</a></li>
                    <li role="presentation"><a href="#primaria" aria-controls="primaria" role="tab" data-toggle="tab">Primaria</a></li>
                    <li role="presentation"><a href="#secundaria" aria-controls="secundaria" role="tab" data-toggle="tab">Secundaria</a></li>

                </ul>

                <!-- Tab panes -->
                <div class="tab-content" style="  background: #fcfcfc;padding: 5px;">
                    <br>
                    <div role="tabpanel" class="tab-pane active" id="inicial">
                        <!--<div id="tb" style="padding:3px">
                                        <span>
                                            Dato:
                                        </span>
                            <select name="opcion" style="line-height:20px;border:1px solid #ccc" id="busqueda_tipo">
                                <option value="id">
                                    Id
                                </option>
                                <option value="usuario">
                                    Usuario
                                </option>
                            </select>
                            <input id="busqueda_data"  name="data"
                                   style="line-height:20px;border:1px solid #ccc">
                            <a href="javascript:void(0)"
                               class="easyui-linkbutton"
                               plain="true" onclick="doSearch()">
                                Buscar
                            </a>

                        </div>
                        -->
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
                </div>

            </div>
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
                    <div   id="mulitplefileuploader">Cargar archivo</div>
                    <br>
                    <div class="form-group ">
                        <label class="control-label" style="font-size: 15px;"  for="semester">Bimestre :</label>
                        <select class="input-sm" name="semester" id="semester">
                            <option value="-1">Escoger</option>
                            <option value="1">1er  Bimestre</option>
                            <option value="2">2do  Bimestre</option>
                            <option value="3">3er  Bimestre</option>
                            <option value="4">4to  Bimestre</option>
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
<style media="screen" type="text/css">
    .datagrid-btable .datagrid-row-detail{
        height: 120px;
    }
</style>
<script>
    var objUser={};
    $(document).ready(function()
    {
        var cont="inicial";
        var data='';
        objUser=new objLib(cont,data);
        objUser.drawTab();
        objUser.upload();
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            var target = $(e.target).attr("href"); // activated tab
            console.log(target.slice(1));
            objUser.tabOn=objUser.translateTab[target.slice(1)];
            objUser.tabName=target.slice(1);
            objUser.drawTab();
        });

    });
    var objLib = function(tab,data){
        if(typeof (tab)!="undefined"){
            this.data        = data;
            this.translateTab= {inicial:"#i_initial",primaria:"#p_initial",secundaria:"#s_initial",profesor:"#t_initial"};
            this.tabOn       = this.translateTab[tab];
            <?php if(Auth::user()->is('Administrador')){?>
            this.URL_tab     = base_url+"/admin/rating/";
            this.URL_upload     = base_url+"/admin/rating/upload";
            <?php } ?>
            <?php if(Auth::user()->is('Alumno')){?>
            this.URL_tab     = base_url+"/user/rating/";
            <?php } ?>
            <?php if(Auth::user()->is('Tutor')){?>
            this.URL_tab     = base_url+"/publisher/rating/";
            this.URL_upload     = base_url+"/publisher/rating/upload";
            <?php } ?>

            this.tabName     = tab;
            this.rowExpenad = [];
        }else{
            this.data=null;
        }
    }

    objLib.prototype.drawTab=function(){
        this.grid=$(this.tabOn).datagrid({
            url: this.URL_tab+this.tabName,
            pagination:true,
            title:'Alumnos',
            iconCls:'icon-search',
            width:"100%",
            height:550,
            remoteSort:false,
            view: detailview,
            detailFormatter:function(index,row){
                //return '<div class="ddv" style="padding:5px 0"></div>';
                return '<div style="padding:2px"><table class="ddv"></table></div>';
            },
            onExpandRow: function(index,row){
                var ddv = $(this).datagrid('getRowDetail',index).find('table.ddv');
                //this.rowExpenad[row.id]=row;
                ddv.datagrid({
                    <?php if(Auth::user()->is('Administrador')){?>
                    url:"<?php echo URL::to('/admin/rating/load'); ?>"+"/"+row.id,
                    <?php } ?>
                    <?php if(Auth::user()->is('Tutor')){?>
                    url:"<?php echo URL::to('/publisher/rating/load'); ?>"+"/"+row.id,
                    <?php } ?>
                    fitColumns:true,
                    singleSelect:true,
                    rownumbers:false,
                    border:true,
                    loadMsg:'',
                    height:'100px',
                    columns:[[
                        {field:'year',title:'Año',width:70,align:"center"},
                        {field:'semester',title:'Bimestre',width:80,align:"center"},
                        {field:'fecha',title:'Fecha de subida',width:80,align:"center"},
                        {field:'status',title:'Estado',width:100,align:"center"},
                        {field:'nombre',title:'Nombre libreta.',width:140},
                        {field:'notas',title:'Descargar libreta',width:100,align:"center"},
                        {field:'acciones',title:'Acciones',width:100
                        }

                    ]],
                    onResize:function(){
                        $('#dg').datagrid('fixDetailRowHeight',index);
                    },
                    onLoadSuccess:function(){
                        setTimeout(function(){
                            $('#dg').datagrid('fixDetailRowHeight',index);
                        },0);
                    }
                });
                $('#dg').datagrid('fixDetailRowHeight',index);
            },
            loadFilter: function(data){
                for (var prop in data["rows"]) {
                }
                return data;
            },
            columns:[[
                {field:'ID',title:'Nº',width:40},
                {field:'nombre',title:'Nombre(s)',width:140,align:"center",sortable:true},
                {field:'apellido',title:'Apellidos',width:160,align:"center"},
                {field:'dni',title:'DNI',width:100,align:"center"},
                {field:'sexo',title:'Sexo',width:80,align:"center"},
                {field:'grado',title:'Grado',width:90 , sortable:true,align:"center"},
                {field:'seccion',title:'Seccion',width:90 , sortable:true,align:"center"},
                {field:'email',title:'email',width:150,align:"center"},///images/app/icon-download.png
                {field:'apoderado',title:'apoderado',width:160,align:"center"},
                {field:'estado',title:'Estado',width:100,align:"center"},
                /*{field:'acciones',title:'Acciones',width:140,align:"center",
                    formatter:function(val,row,index){
                        var id=-1;
                        try{
                            id=parseInt(row['id']);
                        }catch(ex){
                            id=-1;
                        }
                        var html="";
                        if(row['estado']=="0"){
                            //    html+='<a class="" href="javascript:void(0)" class="easyui-linkbutton easyui-tooltip" plain="true" iconCls="icon-pencil"  style="width:40px;height:40px;" onclick="objUser.upload('+index+')"  '+
                            // '  title="Cargar" '+
                            // '><img src="'+
                            // base_url+'/css/icons/file-upload.png"  alt="Cargar"/>Subir libreta</a>  &nbsp; &nbsp;';
                            html+='----';
                        }else{
                            html+='----';
                        }

                        return html;
                    }
                }/**/
            ]]
        });
    }

    objLib.prototype.upload =function(){
        var params={semester:$("#semester").val()};
        var settings = {
            url: this.URL_upload ,
            dragDrop:true,
            fileName: "myfile",
            formData:params,
            allowedTypes:"doc,pdf,docx",
            returnType:"json",
            onSuccess:function(files,data,xhr)
            {
                if(data.status.code=="200"){
                    $(objUser.grid).datagrid('reload');
                }
            },
            showDelete:true,
            deleteCallback: function(data,pd)
            {
                for(var i=0;i<data.length;i++)
                {
                    $.post("delete.php",{op:"delete",name:data[i]},
                        function(resp, textStatus, jqXHR)
                        {
                            //Show Message
                            $("#status").append("<div>File Deleted</div>");
                        });
                }
                pd.statusbar.hide(); //You choice to hide/not.

            }
        }
        var uploadObj = $("#mulitplefileuploader").uploadFile(settings);
    }

    objLib.prototype.getDoc = function (id_,idb) {
        window.open(this.URL_tab+'report/'+id_+'/'+idb, '_blank');
    }
    objLib.prototype.delete=function(indx,bimester){
        var params={idr:indx,bimester:bimester};
        $.post(this.URL_tab+'updaterating', params, function(_result){
            if(_result.success){
                $(objUser.grid).datagrid('reload');
            }
        });
        //console.log(indx);
    }
</script>