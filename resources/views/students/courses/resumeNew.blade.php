@extends('layouts.landing')

@push('styles')
   <style>
      input[type="radio"] {
         display: none;
      }

      label {
         color: gray;
      }

      .clasificacion {
         direction: rtl;
         unicode-bidi: bidi-override;
      }

      label:hover,
      label:hover ~ label {
         color: #034A91;
      }

      input[type="radio"]:checked ~ label {
         color: #034A91;
      }

      .icon-star-rating{
         color: #034A91;
      }
      .icon-star-big{
         font-size: 22px;
      }
      .icon-star-small{
         font-size: 16px;
      }
   </style>
@endpush

@push('scripts')
   <script>
      $(function(){    
         $('.video-responsive').bind('contextmenu',function() { return false; });
      });
   </script>
@endpush

@section('content')
   @if (Session::has('msj'))
      <div id="note">
         ¡¡Felicidades!! Has comprado el curso de forma exitosa. ¡Disfrútalo! 
         <a class="uk-margin-medium-right uk-margin-remove-bottom uk-position-relative uk-icon-button uk-align-right  uk-margin-small-top" uk-toggle="target: #note; cls:uk-hidden"> <i class="fas fa-times  uk-position-center"></i> </a>
      </div>
   @endif

   @if (Session::has('msj-exitoso'))
      <div id="note">
         El código de regalo ha sido aplicado con exito. ¡¡Disfrute su nuevo T-Curso!!
         <a class="uk-margin-medium-right uk-margin-remove-bottom uk-position-relative uk-icon-button uk-align-right  uk-margin-small-top" uk-toggle="target: #note; cls:uk-hidden"> <i class="fas fa-times  uk-position-center"></i> </a>
      </div>
   @endif

   @if (Session::has('msj-exitoso-rating'))
      <div id="note">
         {{ Session::get('msj-exitoso-rating') }}
         <a class="uk-margin-medium-right uk-margin-remove-bottom uk-position-relative uk-icon-button uk-align-right  uk-margin-small-top" uk-toggle="target: #note; cls:uk-hidden"> <i class="fas fa-times  uk-position-center"></i> </a>
      </div>
   @endif

   @if (is_null($miValoracion))
      <script>
         $(function(){
            document.getElementById("course_id").value = "{{ $curso->id }}";
            UIkit.modal("#modalValorar").show();
         });
      </script>
   @endif

   @include('students.ratings.createModal')

   <div class="uk-child-width-1-2@xl uk-child-width-1-2@l uk-child-width-1-2@m uk-child-width-1-1@s" uk-grid>
      <div class="course-details-div">
         <a href="{{ route('students.my-content') }}" class="link-back-to-courses">Volver a Mis Cursos</a>
         <div class="course-details-title">{{ $curso->title }}</div>
         <div class="course-details-category"><i class="{{ $curso->category->icon }}"></i> {{ $curso->category->title }}</div>
         <div class="course-details-lessons">{{ $curso->lessons_count }} Lecciones en Español</div>
         <div class="course-details-instructor">Por: {{ $curso->user->names }} {{ $curso->user->last_names }}</div>
         
         <div class="link-back-to-courses uk-text-center">Mi Progreso ({{ $progreso->progress }}%)</div>
         <progress id="js-progressbar" class="uk-progress progress-green uk-margin-small-bottom uk-margin-small-top" value="{{ $progreso->progress }}" max="100" style="height: 15px;"></progress>
         <!--<div class="uk-hidden@m"><h4>Mi Progreso ({{ $progreso->progress }}%)</h4></div>-->

         <div class="course-details-buttons">
            @if ($progreso->progress != 100)
               <a type="button" href="{{ route('students.courses.lessons', [$curso->slug, $curso->id, $primeraLeccion->id ]) }}" class="uk-button courses-button-blue"><i class="far fa-play-circle"></i> Ir a Lecciones</a>
            @else
               <a type="button" href="{{ asset('certificates/courses/'.Auth::user()->id.'-'.$curso->id.'.pdf') }}" class="uk-button courses-button-blue" target="_blank"><i class="fas fa-medal"></i> Ver Certificado</a>
            @endif

            <a type="button" href="{{ route('students.discussions.group', ['course', $curso->slug, $curso->id]) }}" class="uk-button courses-button-blue"><i class="far fa-comments"></i> Ir al Foro</a>
         </div>
         
      </div>

      <div class="course-preview-div">
         @if (!is_null($curso->preview))
            <div class="video-responsive">
               <video src="{{ $curso->preview }}" type="video/mp4" @if (!is_null($curso->preview_cover)) poster="{{ asset('uploads/images/courses/preview_covers/'.$curso->preview_cover) }}" @endif controls controlslist="nodownload" class="course-preview-video"></video>
            </div>
         @else
            Este curso no posee un video resumen...
         @endif
      </div>
   </div>

   <div class="uk-child-width-1-2@xl uk-child-width-1-2@l uk-child-width-1-2@m uk-child-width-1-1@s" uk-grid style="background-color: #E5E5E5;">
      <div class="course-content-div">
         <div class="course-content-subtitle">{{ $curso->subtitle }}</div>

         <div class="course-accordion">
            <ul uk-accordion>
               <li>
                  <a class="uk-accordion-title course-accordion-title" href="#"><b>Objetivos</b></a>
                  <div class="uk-accordion-content course-accordion-content">
                     <p>{!! $curso->objectives !!}</p>
                  </div>
               </li>
               <li>
                  <a class="uk-accordion-title course-accordion-title" href="#"><b>¿A quién está dirigido?</b></a>
                  <div class="uk-accordion-content course-accordion-content">
                     <p>{!! $curso->destination !!}</p>
                  </div>
               </li> 
               <li>
                  <a class="uk-accordion-title course-accordion-title" href="#"><b>Temario</b></a>
                  <div class="uk-accordion-content course-accordion-content" >
                     <ul uk-accordion>
                        @foreach ($curso->modules as $modulo)
                           <li>
                              <a class="uk-accordion-title uk-accordion-title2 module-accordion-title" href="#">Unidad {{ $modulo->priority_order }}: {{ $modulo->title }}</a>
                              <div class="uk-accordion-content">
                                 <ul class="uk-list uk-list-divider">
                                    @foreach ($modulo->lessons as $leccion)
                                       <li style="font-size: 18px; font-weight: 400; color: #0B132B !important; padding: 0 0 !important; margin: 0 0 !important">
                                          <a> Lección {{$leccion->priority_order}}: {{ $leccion->title }} </a>
                                          @if (!is_null($leccion->video))
                                             <a href="{{ route('students.courses.lessons', [$curso->slug, $curso->id, $leccion->id]) }}"><span class="uk-icon-button icon-play"> <i class="fas fa-play icon-small"></i> </span></a>
                                          @endif
                                       </li>
                                    @endforeach
                                 </ul>
                              </div>
                           </li>
                        @endforeach
                     </ul>
                  </div>
               </li>     
               <li>
                  <a class="uk-accordion-title course-accordion-title" href="#"><b>Requisitos</b></a>
                  <div class="uk-accordion-content course-accordion-content" >
                     <p>{!! $curso->requirements !!}</p>
                  </div>
               </li>
               <li>
                  <a class="uk-accordion-title course-accordion-title" href="#"><b>Sobre el instructor</b></a>
                  <div class="uk-accordion-content course-accordion-content" >
                     <p>{{ $curso->user->review }}</p>
                  </div>
               </li>
            </ul>

            <div style="padding-top: 30px;">
               <a href="{{ route('landing.courses') }}" class="link-back-to-courses"><b>Volver a T-Cursos</b></a>
            </div>
         </div>
      </div>
      
      <div class="course-content-ratings">
         <div class="uk-card uk-card-default uk-card-body ratings-card">
            <div class="ratings-card-title">Valoraciones</div>
            <div class="ratings-card-content">
               <div>
                  @if ($promedio[0] >= 1) <i class="fas fa-star icon-star-rating icon-star-big"></i> @else <i class="far fa-star icon-star-rating icon-star-big"></i> @endif
                  @if ($promedio[0] >= 2) <i class="fas fa-star icon-star-rating icon-star-big"></i> @else <i class="far fa-star icon-star-rating icon-star-big"></i> @endif
                  @if ($promedio[0] >= 3) <i class="fas fa-star icon-star-rating icon-star-big"></i> @else <i class="far fa-star icon-star-rating icon-star-big"></i> @endif
                  @if ($promedio[0] >= 4) <i class="fas fa-star icon-star-rating icon-star-big"></i> @else <i class="far fa-star icon-star-rating icon-star-big"></i> @endif
                  @if ($promedio[0] >= 5) <i class="fas fa-star icon-star-rating icon-star-big"></i> @else <i class="far fa-star icon-star-rating icon-star-big"></i> @endif

                  <hr style="border: none; height: 1px; color: black; background-color: black;">
               </div>

               <div>
                  @foreach ($curso->ratings as $valoracion)
                     <div style="color: #1B4965; font-weight: 700; font-size: 18px;">
                        @if ($valoracion->user_id != 0)
                           {{ $valoracion->user->names }} {{ $valoracion->user->last_names }}
                        @else
                           {{ $valoracion->name }}
                        @endif
                     </div>
                     <div style="color: #5FA8D3; font-weight: 700; font-size: 16px;">{{ date('d-m-Y H:i A', strtotime("$valoracion->created_at -5 Hours")) }}</div>
                     <div>
                        @if ($valoracion->points >= 1) <i class="fas fa-star icon-star-rating icon-star-small"></i> @else <i class="far fa-star icon-star-rating icon-star-small"></i> @endif
                        @if ($valoracion->points >= 1) <i class="fas fa-star icon-star-rating icon-star-small"></i> @else <i class="far fa-star icon-star-rating icon-star-small"></i> @endif
                        @if ($valoracion->points >= 1) <i class="fas fa-star icon-star-rating icon-star-small"></i> @else <i class="far fa-star icon-star-rating icon-star-small"></i> @endif
                        @if ($valoracion->points >= 1) <i class="fas fa-star icon-star-rating icon-star-small"></i> @else <i class="far fa-star icon-star-rating icon-star-small"></i> @endif
                        @if ($valoracion->points >= 1) <i class="fas fa-star icon-star-rating icon-star-small"></i> @else <i class="far fa-star icon-star-rating icon-star-small"></i> @endif
                     </div>
                     <div style="color: #8A8A8A; font-weight: 400; font-size: 14px; padding-bottom: 10px;">{{ $valoracion->comment }}</div>
                  @endforeach
              </div>

            </div>
         </div>
      </div>
   </div>
@endsection