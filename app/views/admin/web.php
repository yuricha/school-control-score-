
<div id="page_comments" class="content">

    <div class="row">
        <div class="col-xs-3" >
            <h3>Comentarios</h3>
            <p><a href="#add_comment" class="button autofit ">Agregar un comentario</a></p>
            <!-- listado -->
            <div class="scrollable">
                <ul class="list-menu list-users">
                    <?php foreach($posts as $u)
                    {
                        echo '<li><a href="#get_user" id="'.$u->id.'" >';

                        echo '<div class="stitle ">'. $u->title.'  </div> '
                            .' </a><div class="icon16 ii-delete delete" id="'.$u->id.'"  title="Eliminar publicacion"   style="float:right;margin-top: -31px;"></div></li>';
                    } ?>
                </ul>
            </div>
        </div>

        <!-- End lista de roles -->
        <style type="text/css">
            .jqte_tool.jqte_tool_1 .jqte_tool_label {
                height: 22px;
            }
            .jqte{
                margin: 0px 0px 30px;
            }
        </style>
        <div class="col-xs-9" id="client-page">

            <div class="error_info msg-help">
                <h3>Elige un comentario para poder editar</h3>
            </div>
            <div class="tab-content form-user-info" style="display: none;">
                <div id="panel-info" class="tab-pane active">
                    <div class="row">
                        <div class="col-xs-12">
                            <form id="form_post" method="post">
                                <input type="hidden" id="comment_id" name="id" value="">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <label for="title">1. Título: </label><input type="text" id="title" name="title" class="form-control"/>
                                    </div>
                                    <div class="col-xs-6">
                                        <label for="size">4. Estado: </label>
                                        <select type="text" id="status" name="status" value="0" class="form-control">
                                            <option value="0">No publicado</option>
                                            <option value="1">Publicado</option>
                                        </select>
                                    </div>
                                </div>
                                <!--
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <label for="content">Contenido: </label>
                                            <div id="textarea"><textarea name="content" id="content" class="form-control" rows="10"></textarea></div>

                                        </div>
                                    </div>
                                -->
                                <br/>
                                <h4>2.  Imagen : </h4>
                                <div class="content-gallery">
                                    <div class="gallery">
                                        <ul></ul>
                                    </div>
                                    <a id="fileupload" href="#add_image" class=""><i class="ii-uniE040"></i>Agregar</a>
                                    <div class="gallery-images"></div>
                                </div>
                                </br>
                                <div></br></div>
                                <h4>3.  Documento : </h4>
                                <div class="content-gallery-doc">
                                    <div class="gallery-doc">
                                        <ul></ul>
                                    </div>
                                    <a id="fileupload-doc" href="#add_image" class=""><i class="ii-uniE040"></i>Agregar</a>
                                    <div class="gallery-images-doc"></div>
                                </div>
                                <br/>
                                <br/>
                                <p class="text-center"><button type="submit" >Guardar información</button></p>
                            </form>
                        </div>
                    </div>
                </div>
                <div id="panel-reservas" class="tab-pane">
                    <p>Votos</p>
                </div>
            </div>

        </div>

    </div>
</div>

<script type="text/javascript">
    $(document).ready(initSection);

    var user_selected;
    var searchTimeout;
    var newLocal = false;

    function initSection()
    {
        $('textarea').jqte();
        $('.content-gallery').hide();
        //var dom_clientSearch = $('#client_search');
        $('#page_comments').on('click', 'a', BTN_CLICK_handler);
        $('.delete').on('click',delete_handler);
        $('#form_auto').submit(FORM_SUBMIT_handler);
        $('#form_post').submit(FORM_SUBMIT_handler);
        //dom_clientSearch.focus();
        //dom_clientSearch.keydown(KEY_SEARCH_handler);


        $("#fileupload").uploadFile({
            url:"<?php echo URL::to('admin/files/upload'); ?>",
            allowedTypes:"png,gif,jpg",
            fileName:"uploadFile",
            onSuccess:function(files,data,xhr)
            {
                $('.gallery-images').append('<input type="hidden" name="images[]" value="' + data.data.id + '">');
                $(".gallery ul").append('<li><img src="<?php echo URL::to('/'); ?>/' + data.data.path + '" /></li>');
            }
        });
        $("#fileupload-doc").uploadFile({
            url:"<?php echo URL::to('admin/files/upload'); ?>",
            fileName:"uploadFile",
            allowedTypes:"pdf",
            onSuccess:function(files,data,xhr)
            {
                $('.gallery-images-doc').append('<input type="hidden" name="images[]" value="' + data.data.id + '">');
                $(".gallery-doc ul").append('<li><img src="<?php echo URL::to('/'); ?>/' + data.data.path + '" /></li>');
            }
        });
    }

    function BTN_CLICK_handler()
    {
        switch ($(this).attr('href'))
        {
            case '#add_comment':
                //openAddUser();
                $('.content-gallery').show();

                $('.ajax-upload-dragdrop').show();
                $('.msg-help').hide();
                //$('.title_add').show();
                //$('#')
                $('.form-user-info').fadeIn();
                $(".gallery-images").text('');
                $(".gallery ul").html('');
                $(".gallery-doc ul").html('');
                $("#status").prop('value',0);
                $('input[ type=text ]').val('');
                $('input[ type=checkbox ]').prop('checked', false);
                $(this).parent().parent().find('.active').removeClass('active');
                $('#name').focus();
                newLocal = true;
                user_selected = '';
                $('#comment_id').val(user_selected);
                break;
            case '#get_user':
                $(this).parent().parent().find('.active').removeClass('active');
                $(this).addClass('active');
                $('.msg-help').hide();
                $('.form-user-info').fadeIn();
                user_selected = $(this).attr('id');
                $('#comment_id').val(user_selected);
                loadUser(user_selected);
                $('.ajax-upload-dragdrop').hide();
                break;
        }

        return false;
    }

    function FORM_SUBMIT_handler()
    {
        AlertBox.show('Guardando información');
        var form = $(this);
        var params = form.serializeArray();
        form.css('opacity', '0.5');
        $.post("<?php echo URL::to('admin/web/save'); ?>", params, function(_data){
            if($('#comment_id').val() == '')
            {
                $('.list-menu').prepend('<li><a href="#get_user" id="' + _data.data.id + '" class="active"><div class="stitle">' + _data.data.title + '</div></a></li>')
            }
            //console.log(_data);
            user_selected = $('#comment_id').val(_data.data.id);
            form.css('opacity', '1');
            loadUser(_data.data.id);   //actualizar
            window.location.href = window.location.href;
        });

        return false;
    }

    function searchUsers(_term)
    {
        if(!_term)
            _term = $('#client_search').val();

        $.post('<?php echo URL::to('admin/users'); ?>', {'search':_term}, function(_res)
        {
            console.log(_res.data);
            $('.list-users').html('');
            for(var i in _res.data)
            {
                var html = '<li><a href="#get_user" id="' + _res.data[i].id + '">' + _res.data[i].person.name + ' ' + _res.data[i].person.last_name;
                html += '<span>' + _res.data[i].email + '</span>';
                html +=	'</a></li>';
                $('.list-users').append(html);

            }
        }, 'json');
    }

    function loadUser(_iduser)
    {
        AlertBox.show('Cargando información de usuario');
        $('#video_approved').removeAttr('checked');
        $('.content-gallery').show();
        $.post('<?php echo URL::to('admin/comments'); ?>', {'id':_iduser}, function(_res)
        {
            $('#title').val(_res.data.title);
            $('#status').prop('value',_res.data.status);
            $("#textarea .jqte_editor").html(_res.data.content);
            $(".ajax-file-upload-statusbar").hide();
            $('.gallery-images').html('');
            $(".gallery ul").html('');

            if(_res.data.gallery)
            {
                $(".gallery-doc ul").html('');
                $(".gallery ul").html('');
                for(var i in _res.data.gallery.images){
                    var ext=_res.data.gallery.images[i].name;
                    var str=ext.split(".");
                    if(str[1]=="png"||str[1]=="jpg"||str[1]=="jpg"){
                        $(".gallery ul").append('<li><img src="<?php echo URL::to('/'); ?>/' + _res.data.gallery.images[i].path + '" /></li>');
                    }else{
                        $(".gallery-doc ul").append('<li>' + _res.data.gallery.images[i].name +' </li>');
                    }
                }
            }
            var id = $('#comment_id').val();
            $('#'+id+' .stitle').html(_res.data.title);
            AlertBox.hide();
        }, 'json');
    }

    function openAddUser(_iduser)
    {
        $('.msg-help').hide();
        //$('.title_add').show();
        $('.form-local-info').fadeIn();
        $('input[ type=text ]').val('');
        $('input[ type=checkbox ]').prop('checked', false);
        $(this).parent().parent().find('.active').removeClass('active');
        $('#name').focus();
        newLocal = true;
        return false;
    }

    function delete_handler(){
        $.get("<?php echo URL::to('admin/web/delete'); ?>"+'/'+this.id, '', function(_data){
            window.location.href = window.location.href;
        });
    }

</script>