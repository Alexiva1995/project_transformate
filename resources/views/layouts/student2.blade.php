<html lang="en"> 
    <head> 
        <meta charset="utf-8"> 
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="{{ asset('template/images/favicon_transformate_01.png') }}">
        <meta name="description" content="">
        <title>Transf贸rmate | Cursos de Transformaci贸n </title>          
        <!-- Favicon -->
        <link href="{{ asset('template/images/favicon_transformate_01.png') }}" rel="icon" type="image/png">
        <!-- Your stylesheet-->
        <link rel="stylesheet" href="{{  asset('template/css/uikit.css') }}"> 
        <link rel="stylesheet" href="{{  asset('template/css/main.css') }}"> 
        <!-- font awesome -->
        <link rel="stylesheet" href="{{  asset('template/css/fontawesome.css') }}">
        <link rel="stylesheet" href="{{ asset('css/footer_uikit.css') }}">
        <link rel="stylesheet" href="{{ asset('css/header.css') }}">
        <link rel="stylesheet" href="{{ asset('css/modales_auth.css') }}">
        <link rel="stylesheet" href="{{ asset('css/landing.css') }}"> 
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="{{ asset('vendors/datatables/datatables.min.css') }}"/>
        
        
        @stack('styles')
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-NBKTXRC');</script>
        <!-- End Google Tag Manager -->
        
        <!--  javascript -->
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{  asset('template/js/simplebar.js') }}"></script>         
        <script src="{{  asset('template/js/uikit.js') }}"></script>
        <script src="{{ asset('template/icon/js/uikit-icons.min.js') }}"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script type="text/javascript" src="{{ asset('vendors/datatables/datatables.min.js') }}"></script>

       <!-- Facebook Pixel Code -->
        <script>
            !function(f,b,e,v,n,t,s)
            
            {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            
            n.queue=[];t=b.createElement(e);t.async=!0;
            
            t.src=v;s=b.getElementsByTagName(e)[0];
            
            s.parentNode.insertBefore(t,s)}(window,document,'script',
            
            'https://connect.facebook.net/en_US/fbevents.js');
            
            
            fbq('init', '465006734543855'); 
            
            fbq('track', 'PageView');
        </script>

        <noscript>
            <img height="1" width="1" src="https://www.facebook.com/tr?id=465006734543855&ev=PageView&noscript=1"/>
        </noscript>
        <!-- End Facebook Pixel Code -->

        @stack('scripts')  
    </head>     
    <body>  
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NBKTXRC"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->

        <!-- PreLoader -->         
        <div id="spinneroverlay"> 
            <div class="spinner"></div>             
        </div>   

        {{-- header y menu --}}
        @include('layouts.includes.header', ['showlaucher' => false])
       
           
        <div class="app"> 
            <div class="uk-container" id="browse-corses">
                @yield('content')             
            </div>      

            @include('layouts.includes.footer')
        
            <!-- button scrollTop --> 
            <button   id="scrollTop" class="uk-animation-slide-bottom-medium"> <a href="#" class="uk-text-white" uk-totop uk-scroll></a> </button>   
        
            {{-- Modal Vista Previa --}}
            <div id="modal-preview" uk-modal>
                <div class="uk-modal-dialog" id="preview-video"> 
                
                </div>
            </div>
        </div>
       
        <!-- Modo Nocturno-->         
        <script>
            function cambiarTema(){
               if( $('#theme_check').prop('checked') ) {
               //if (document.getElementById("tema").value == 'ligth'){
                   /*document.getElementById('icon-night').style.display = 'none';
                   document.getElementById('icon-day').style.display = 'block';*/
                   document.getElementById("tema").value = 'dark';
                   $(".header-background-ligth").each(function(index) {
                       $("#"+$(this).attr('id')).removeClass("header-background-ligth");
                       $("#"+$(this).attr('id')).addClass("header-background-dark");
                   });
                   $(".background-ligth").each(function(index) {
                       $("#"+$(this).attr('id')).removeClass("background-ligth");
                       $("#"+$(this).attr('id')).addClass("background-dark");
                   });
                   $(".color-ligth").each(function(index) {
                       console.log($(this).attr('id'));
                       $("#"+$(this).attr('id')).removeClass("color-ligth");
                       $("#"+$(this).attr('id')).addClass("color-dark");
                   });
                   $(".color-ligth2").each(function(index) {
                       console.log($(this).attr('id'));
                       $("#"+$(this).attr('id')).removeClass("color-ligth2");
                       $("#"+$(this).attr('id')).addClass("color-dark2");
                   });
                   $(".background-ligth2").each(function(index) {
                       $("#"+$(this).attr('id')).removeClass("background-ligth2");
                       $("#"+$(this).attr('id')).addClass("background-dark2");
                   });
               }else{
                   /*document.getElementById('icon-day').style.display = 'none';
                   document.getElementById('icon-night').style.display = 'block';*/
                   document.getElementById("tema").value = 'ligth';
                   $(".header-background-dark").each(function(index) {
                       $("#"+$(this).attr('id')).removeClass("header-background-dark");
                       $("#"+$(this).attr('id')).addClass("header-background-ligth");
                   });
                   $(".background-dark").each(function(index) {
                       $("#"+$(this).attr('id')).removeClass("background-dark");
                       $("#"+$(this).attr('id')).addClass("background-ligth");
                   });
                   $(".color-dark").each(function(index) {
                       $("#"+$(this).attr('id')).removeClass("color-dark");
                       $("#"+$(this).attr('id')).addClass("color-ligth");
                   });
                    $(".color-dark2").each(function(index) {
                       $("#"+$(this).attr('id')).removeClass("color-dark2");
                       $("#"+$(this).attr('id')).addClass("color-ligth2");
                   });
                   $(".background-dark2").each(function(index) {
                       $("#"+$(this).attr('id')).removeClass("background-dark2");
                       $("#"+$(this).attr('id')).addClass("background-ligth2");
                   });
               }
            }
            
            (function (window, document, undefined) {
              'use strict';
              if (!('localStorage' in window)) return;
              var nightMode = localStorage.getItem('gmtNightMode');
              if (nightMode) {
                  document.documentElement.className += ' night-mode';
              }
            })(window, document);


            (function (window, document, undefined) {

              'use strict';

              // Feature test
              if (!('localStorage' in window)) return;

              // Get our newly insert toggle
              var nightMode = document.querySelector('#night-mode');
              if (!nightMode) return;

              // When clicked, toggle night mode on or off
              nightMode.addEventListener('click', function (event) {
                  event.preventDefault();
                  document.documentElement.classList.toggle('night-mode');
                  if ( document.documentElement.classList.contains('night-mode') ) {
                      localStorage.setItem('gmtNightMode', true);
                      return;
                  }
                  localStorage.removeItem('gmtNightMode');
              }, false);

            })(window, document);

            // Preloader
            var spinneroverlay = document.getElementById("spinneroverlay");
            window.addEventListener('load', function(){
                spinneroverlay.style.display = 'none';
            });

            //scrollTop
            // When the user scrolls down 20px from the top of the document, show the button
            window.onscroll = function() {scrollFunction()};        
            function scrollFunction() {
                if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                    document.getElementById("scrollTop").style.display = "block";
                } else {
                    document.getElementById("scrollTop").style.display = "none";
                }
            }        
            // When the user clicks on the button, scroll to the top of the document
            function topFunction() {
                document.body.scrollTop = 0;
                document.documentElement.scrollTop = 0;
            }      

            $(function(){           
                $('body').on('click','.view-preview',function(){
                   let path = $(this).data('viewpreview')
                   $.ajax({
                      type:"GET",
                      url:path,
                      success:function(ans){
                        $("#preview-video").html(ans);  
                        if (document.getElementById("tema").value == 'dark'){
                           $(".header-ligth-trailer").each(function(index) {
                               $("#"+$(this).attr('id')).removeClass("header-ligth-trailer");
                               $("#"+$(this).attr('id')).addClass("header-dark-trailer");
                           });
                           $(".color-ligth-trailer").each(function(index) {
                               $("#"+$(this).attr('id')).removeClass("color-ligth-trailer");
                               $("#"+$(this).attr('id')).addClass("color-dark-trailer");
                           });
                           $(".background-ligth-trailer").each(function(index) {
                               $("#"+$(this).attr('id')).removeClass("background-ligth-trailer");
                               $("#"+$(this).attr('id')).addClass("background-dark-trailer");
                           });    
                       }                      
                      }
                   });
                }); 
            });

            $(function() {
              $('#search-icon').click(function(event) {
                  $("#navbar").hide();
                  $("#navbar-search").show();
              });
              $('#close-search-icon').click(function(event) {
                  $("#navbar-search").hide();
                  $("#navbar").show();
              });
          });
        </script>         
    </body>     
</html>
