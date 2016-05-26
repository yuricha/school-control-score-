<script type="text/javascript">
    $(function() {
        $('.bxslider').bxSlider({auto: true});
    });
</script>

<div class="content_home"><!-- slider_bg start slider -->
    <div class="container bg_home">
        <div class="row">
            <div class="col-sm-8">
                <ul class="bxslider">
                    <li><img src="<?php echo URL::to('/'); ?>/images/slide/1.jpg" /></li>
                    <li><img src="<?php echo URL::to('/'); ?>/images/slide/3.png"  /></li>
                    <li><img src="<?php echo URL::to('/'); ?>/images/slide/2.jpg" /></li>
                    <li><img src="<?php echo URL::to('/'); ?>/images/slide/4.jpg" /></li>
                </ul>
            </div>
            <div class="col-sm-4 " style="padding-left:0px;">
                <div class="sliderway">
                    <h3 style="margin-top: 0px;font-size: 15px; background-color: #4A698B;padding: 6px;border-radius: 15px;text-align: center;color: white;">Infraestructura moderna</h3>
                    <div id="cbol">
                        <img src="<?php echo asset('images/slide/1s.png'); ?>" width="100%" height="90" onclick="" style="cursor:pointer">
                    </div>
                    <div></br></div>
                    <h3 style="margin-top: -10px;font-size: 15px; background-color: #4A698B;padding: 6px;border-radius: 15px;text-align: center;color: white;">Noticias</h3>
                    <div id="cbol">
                        <div class="row row_news">
                            <a href="#" class=" headernoticia ">
                                <div class="col-xs-3 no-paddin-right"><img src="<?php echo asset('images/noticia/1.gif'); ?>" width="100%"/> </div>
                                <div class="col-xs-9 text_news">Alumnos ingresantes a la universidad</div>
                            </a>
                        </div>
                        
                    </div>
                <!--    <p style="font-size: 12px;">Contamos con una infraestructura moderna y funcional. <a href=""><span style="color: red" size="2"> <br>ver m&aacute;s</span></a> </p>
					<br>
					<div><a href="#" class=" headernoticia " style=" color:red;font-size: initial;">&Uacute;ltimas noticias</a></div>
                -->
                </div>
				

            </div>
        </div>
        <?php
        //var_dump($news);

        ?>
 
        <div class="main row">


                <?php
                //var_dump($news);
                foreach($news as $clave => $valor){?>
            <div class="col-sm-6 col-md-3 images_1_of_4 text-center homecontainer">
                    <h4 class="titlehome"><?php echo $clave; ?></h4>
                    <a><span class="bg " style=" height: auto; width: 100%; padding: 20px 10px 20px 16px;border: 1px solid #CDCACA;color: #848582;border-radius: 15px"><img width="200px" height="280px" u="image" src="<?php echo asset($valor[0]); ?>" /></span>
                    </a>
                    <a  target="_blank" href="<?php 
                    if(isset($valor[1])) echo URL::to( $valor[1]);
                    

                    
                     ?>" class="fa-btn btn-1 btn-1e">leer mas</a>
            </div>
                <?php } ?>
                <!--<p class="para">Somos tu mejor opci&oacute;n en educaci&oacute;n, conoce nuestra oferta educativa.
                    Educamos y fomentamos valores desde un principio para ....</p>
                <a href="<?php echo URL::to('admision/opcion'); ?>" class="fa-btn btn-1 btn-1e">leer mas</a>-->

           <!--
            <div class="col-sm-6 col-md-3 images_1_of_4 bg1 text-center homecontainer">
                <span class="bg level" style="height: 160px;">
                </span>
                <h4 class="titlehome">Niveles</h4>
                <p class="para">Te ofrecemos nivel Inicial, Primaria y Secundaria; con una plana docente con experiencia y eficiente.</p>
                <a href="<?php echo URL::to('niveles/inicial/bienvenida'); ?>" class="fa-btn btn-1 btn-1e">leer mas</a>
            </div>
            <div class="col-sm-6 col-md-3 images_1_of_4 bg1 text-center homecontainer">
                <span class="bg admision">

                </span>
                <h4 class="titlehome">Proceso de admision</h4>
                <p class="para">En el Colegio Gran Maestro Juan Enrique Pestalozzi queremos brindarte la mejor experiencia, que disfrutes desde ...</p>
                <a href="<?php echo URL::to('admision/admisiondetail'); ?>" class="fa-btn btn-1 btn-1e">leer mas</a>
            </div>
            <div class="col-sm-6 col-md-3 images_1_of_4 bg1 text-center homecontainer">
                <span class="bg infra">

                </span>
                <h4 class="titlehome">Nueva Infraestructura </h4>
                <p class="para">El Colegio Juan Enrique Pestalozzi cuenta con una nueva infraestructura amplia  para nuestros estudiantes de nivel Inicial.</p>
                <a href="<?php echo URL::to('nosotros/infraestructura'); ?>" class="fa-btn btn-1 btn-1e">leer mas</a>
            </div>
            -->
        </div>

        <?php
        $comment=DB::table('comments')->where('status', '=', 1)->where('type', '=', "FOOTER")->join('images', function($join)
            {
                $join->on('comments.gallery_id', '=', 'images.gallery_id');
            })->orderBy('publicated_at','desc')->get();

         ?>
        <div class="main row">
			<div class="col-xs-12 col-xs-offset-0 col-sm-8 col-sm-offset-2  picturenice2">
                <h5 class="title_blue">Noticias Importantes</h5>
                <div id="slider1_container" style="position: relative; top: 0px; left: 0px; width: 600px; height: 400px;">
                    <!-- Slides Container -->
                    <div u="slides"  class="noticiafooter" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 600px; height: 400px;
                        overflow: hidden;">
                        <?php foreach($comment as $v){?>
                            <div><img u="image" src="<?php echo asset($v->path); ?>" /></div>
                        <?php } ?>
                        <!--
                        <div><img u="image" src="<?php echo asset('images/noticia/1.gif'); ?>" /></div>
                        <div><img u="image" src="<?php echo asset('images/noticia/2.gif'); ?>" /></div>
                        <div><img u="image" src="<?php echo asset('images/noticia/3.gif'); ?>" /></div>
                        -->
                    </div>
                    <a style="display: none" href="#"></a>
                </div>
            </div>

        </div>

    </div>
</div>

<script>

        jQuery(document).ready(function ($) {
            var _SlideshowTransitions = [
                //Fade in R
                {$Duration: 1200, x: -0.3, $During: { $Left: [0.3, 0.7] }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
                //Fade out L
                , { $Duration: 1200, x: 0.3, $SlideOut: true, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
            ];
            var options = {

                $AutoPlay: true,                                   //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
                $DragOrientation: 1   ,                             //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)
                $AutoPlayInterval: 4000,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
                $PauseOnHover: 1,                               //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, 4 freeze for desktop, 8 freeze for touch device, 12 freeze for desktop and touch device, default value is 1

                $ArrowKeyNavigation: true,   			            //[Optional] Allows keyboard (arrow key) navigation or not, default value is false
                $SlideDuration: 500,
                $SlideshowOptions: {                                //[Optional] Options to specify and enable slideshow or not
                    $Class: $JssorSlideshowRunner$,                 //[Required] Class to create instance of slideshow
                    $Transitions: _SlideshowTransitions,            //[Required] An array of slideshow transitions to play slideshow
                    $TransitionsOrder: 1,                           //[Optional] The way to choose transition to play slide, 1 Sequence, 0 Random
                    $ShowLink: true                                    //[Optional] Whether to bring slide link on top of the slider when slideshow is running, default value is false
                }
            };

            var jssor_slider1 = new $JssorSlider$("slider1_container", options);
			function ScaleSlider() {
                var parentWidth = $('#slider1_container').parent().width();
                if (parentWidth) {
                    jssor_slider1.$ScaleWidth(parentWidth);
                }
                else
                    window.setTimeout(ScaleSlider, 30);
            }
            //Scale slider after document ready
            ScaleSlider();
                                            
            //Scale slider while window load/resize/orientationchange.
            $(window).bind("load", ScaleSlider);
            $(window).bind("resize", ScaleSlider);
            $(window).bind("orientationchange", ScaleSlider);

            $('a.headernoticia').click(function(e){
					e.preventDefault();
					enlace  = $(this).attr('href');
					$('html, body').animate({
						scrollTop: $(".noticiafooter").offset().top
					}, 1000);
            });
			
			
        });
</script>
