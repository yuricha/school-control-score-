/**
 * AlertBox Gestiona los mensajes y alertas dentro de la aplicación
 *
 * @type {{}}
 */
var AlertBox = {};
AlertBox.WARNING = 'alert-warning';
AlertBox.INFO = 'alert-info';
AlertBox.ERROR = 'alert-error';
/**
 * Mostrar alerta con un mensaje personalizado, se puede setear el tipo
 * @param _msg String con el mensaje a mostrar
 * @param _type String con el tipo de alerta a mostrar, ejemplo AlertBox.WARNING
 */
AlertBox.show = function(_msg, _type)
{
	var target = $('.block-alert');
	target.text(_msg);
	if(_type) target.addClass(_type);
	target.fadeIn('fast');
};
/**
 * Oculta la alerta
 */
AlertBox.hide = function()
{
	$('.block-alert').fadeOut('fast');
};
/**
 * Muestra una la alerta y la oculta luego de un tiempo determinado
 * @param _msg Mensaje a mostrar en la alerta
 * @param _type Tipo de alerta
 * @param _time Tiempo que se mostrará la alerta, por defecto son 3 seg
 */
AlertBox.flash = function(_msg, _type, _time)
{
	//TODO: Mostrar alerta por un tiempo determinado y ocultar
};


var MainNav = {};
MainNav.DOMObject = null;
MainNav.isBusy = false;
MainNav.init = function(_object)
{
	MainNav.DOMObject = _object;
	MainNav.DOMObject.find('a').click(function(){
		MainNav.goto($(this).attr('href'), $(this));
		return false;
	});
	MainNav.reload();
};

MainNav.goto = function(_url, _domElement)
{
	if(!MainNav.isBusy)
	{
		var current = $('#mainNav a.active');
		var next = _domElement;
		var targetContent = $('#content');

		MainNav.isBusy = true;
		next.addClass('active');
		AlertBox.show('Cargando sección...');

		$.get(_url, function(_data){
			try
			{
				targetContent.html(_data);
			}catch (e)
			{
				console.error(e);
				alert('Error en la información proveida, no se puede continuar');
			}
			if(current.attr('href') != next.attr('href')) current.removeClass('active');
			//targetContent.perfectScrollbar('update');
		}).always(function(){
				MainNav.isBusy = false;
				AlertBox.hide();
			}).fail(function(){
				next.removeClass('active');
				alert('Ocurrio un error');
			});
	}else{
		alert('Por favor espera a que se termine el carga actual');
	}
}
MainNav.reload = function() { MainNav.DOMObject.find('a.active').click(); };


/**
 * Modal Box Gestiona los mensajes y alertas dentro de la aplicación
 *
 * @type {{}}
 */

var ModalBox = {};
ModalBox.DOMObject  = null;
ModalBox.options = null;
ModalBox.idle = false;
ModalBox.init = function()
{
	ModalBox.DOMObject = $('#modalBox');
	$('#overlay').click(function(){ ModalBox.close(); return false; });
	ModalBox.DOMObject.find('.modal-close').click(function(){ ModalBox.close(); return false; });
};

ModalBox.open = function(_content, _options)
{
	ModalBox.options = _options;
	if(_options)
	{
		if(_options.height){	ModalBox.DOMObject.height(_options.height); ModalBox.DOMObject.css('margin-top', -(_options.height/2)); }
		if(_options.width){		ModalBox.DOMObject.width(_options.width); ModalBox.DOMObject.css('margin-left', -(_options.width/2)); }
		if(_options.title)		ModalBox.DOMObject.find('.title').html(_options.title);
	}
	ModalBox.DOMObject.find('.modal-content').html(_content);
	ModalBox.DOMObject.find('.modal-content form').submit(function(){
		var form = $(this);
		var action = form.attr('action');
		var params = form.serializeArray();
		if(!ModalBox.idle)
		{
			ModalBox.idle = true;
			form.css('opacity', '0.5');
			$.post(action, params, function(){
				ModalBox.idle = false;
				form.css('opacity', '1');
				if(ModalBox.options.onSendComplete) ModalBox.options.onSendComplete();
			});
		}

		return false;
	});
	if(_options.onCreate) _options.onCreate(ModalBox.DOMObject);

	$('.modal-container-3d').show();
	$('#overlay').fadeIn();
	ModalBox.DOMObject.addClass('open');
};

ModalBox.load = function()
{

};

ModalBox.close = function()
{
	if(ModalBox.options.onClose) ModalBox.options.onClose();

	ModalBox.DOMObject.removeClass('open');
	ModalBox.options = null;
	$('#overlay').fadeOut(function(){
		$('.modal-container-3d').hide();
		ModalBox.DOMObject.find('.modal-content').html('');
	});
};