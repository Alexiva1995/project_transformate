@extends('layouts.landing')

@section('fb-events')
    fbq('track', 'AddToCart');
@endsection

@section('content')
	@if (Session::has('msj-informativo'))
      	<div class="row">
         	<div class="col-md-12 alert alert-info uk-text-center" style="margin-bottom: 0 !important;">
            	<strong>{{ Session::get('msj-informativo') }}</strong>
         	</div>
      	</div>
    @endif

    <div class="courses-banner">
    	<img src="{{ asset('images/courses_banner.jpg') }}" alt="" class="uk-visible@s">
    	<img src="{{ asset('images/courses_banner_movil.jpg') }}" alt="" class="uk-hidden@s">
    	<div class="courses-banner-text">
         	<h1 class="uk-text-bold title">Más que cursos, son una guía de transformación</h1>
         	<span class="description">Son más de <strong>{{ $totalCursos }}</strong> cursos, en los que te ayudamos a crecer como profesional y persona</span>
        </div>
    </div>

    <div class="content-courses">
    	<div uk-grid>
    		<div class="uk-width-1-3@xl uk-width-1-3@l uk-width-1-3@m uk-width-1-1@s" style="padding-left: 6%; padding-right: 6%;">
    			<div class="courses-category-title">Nuestros Cursos</div>

    			<div class="uk-visible@m">
    				<ul class="uk-list categories-list">
    					<li>
    						<a class="category-link" href="{{ route('landing.courses', ['destacados', 'destacados']) }}">
    							<i class="far fa-star"></i> Destacados
    						</a>
    					</li>
    					<li>
    						<a class="category-link" href="{{ route('landing.courses', ['mas-vendidos', 'vendidos']) }}">
    							<i class="fas fa-fire"></i> Más Vendidos
    						</a>
    					</li>
    					<li>
    						<a class="category-link" href="{{ route('landing.courses', ['recomendados', 'recomendados']) }}">
    							<i class="far fa-heart"></i> Recomendados
    						</a>
    					</li>
    					@foreach ($categorias as $categoriaLista)
    						<li>
    							<a class="category-link" href="{{ route('landing.courses', [$categoriaLista->slug, $categoriaLista->id]) }}">
    								<i class="{{ $categoriaLista->icon }}"></i> {{ $categoriaLista->title }}
    							</a>
    						</li>
    					@endforeach
    					<li>
    						<a class="category-link" href="{{ route('landing.courses', ['t-books', 'tbooks']) }}">
    							<i class="fas fa-book"></i> T-Books
    						</a>
    					</li>
    					<li>
    						<a class="category-link" href="{{ route('landing.courses', ['t-master-class', 100]) }}">
    							<i class="fab fa-tumblr"></i> T-Master Class
    						</a>
    					</li>
    					<li>
    						<a class="category-link" href="{{ route('landing.courses', ['todos', 'todos']) }}">
    							<i class="fa fa-list"></i> Todos los cursos
    						</a>
    					</li>
    				</ul>
    			</div>

    			<div class="uk-child-width-1-2 uk-hidden@m" uk-grid>
    				<div>
    					<ul class="uk-list categories-list">
	    					<li>
	    						<a class="category-link" href="{{ route('landing.courses', ['destacados', 'destacados']) }}">
	    							<i class="far fa-star"></i> Destacados
	    						</a>
	    					</li>
	    					<li>
	    						<a class="category-link" href="{{ route('landing.courses', ['mas-vendidos', 'vendidos']) }}">
	    							<i class="fas fa-fire"></i> Más Vendidos
	    						</a>
	    					</li>
	    					<li>
	    						<a class="category-link" href="{{ route('landing.courses', ['recomendados', 'recomendados']) }}">
	    							<i class="far fa-heart"></i> Recomendados
	    						</a>
	    					</li>
	    					@for ($i = 1; $i <= 5; $i++)
	    						<li>
	    							<a class="category-link" href="{{ route('landing.courses', [$categorias[$i]->slug, $categorias[$i]->id]) }}">
	    								<i class="{{ $categorias[$i]->icon }}"></i> {{ $categorias[$i]->title }}
	    							</a>
	    						</li>
	    					@endfor
	    				</ul>
    				</div>
    				<div>
    					<ul class="uk-list categories-list">
	    					@for ($j = 6; $j < 10; $j++)
	    						<li>
	    							<a class="category-link" href="{{ route('landing.courses', [$categorias[$j]->slug, $categorias[$j]->id]) }}">
	    								<i class="{{ $categorias[$j]->icon }}"></i> {{ $categorias[$j]->title }}
	    							</a>
	    						</li>
	    					@endfor
	    					<li>
	    						<a class="category-link" href="{{ route('landing.courses', ['t-books', 'tbooks']) }}">
	    							<i class="fas fa-book"></i> T-Books
	    						</a>
	    					</li>
	    					<li>
	    						<a class="category-link" href="{{ route('landing.courses', ['t-master-class', 100]) }}">
	    							<i class="fab fa-tumblr"></i> T-Master Class
	    						</a>
	    					</li>
	    					<li>
	    						<a class="category-link" href="{{ route('landing.courses', ['todos', 'todos']) }}">
	    							<i class="fa fa-list"></i> Todos los cursos
	    						</a>
	    					</li>
	    				</ul>
    				</div>
    			</div>
    		</div>
    		<div class="uk-width-2-3@xl uk-width-2-3@l uk-width-2-3@m uk-width-1-1@s cards-section">
    			<div class="courses-category-selected">Resultados de la búsqueda <span style="color: red;">{{ app('request')->input('busqueda') }}</span></div>

    			@if ( ($cursosRelacionados->count() > 0) || ($librosRelacionados->count() > 0) || ($certificacionesRelacionadas->count() > 0) )
    				@if ($cursosRelacionados->count() > 0)
		    			<div>
		    				<div class="courses-category-title">T-Cursos</div>
		    				<ul class="uk-child-width-1-1 uk-child-width-1-1@s uk-child-width-1-2@m uk-child-width-1-3@l uk-child-width-1-3@xl" uk-grid>
				                @foreach ($cursosRelacionados as $curso)
					                <li class="course uk-transition-toggle" tabindex="0">
				                        <div class="uk-card uk-card-small course-card">
				                            <div class="uk-card-media-top image-div">
				                                @if (!is_null($curso->preview))
					                                <a class="view-preview" uk-toggle="target: #modal-preview" data-viewPreview="{{ route('ajax.load-preview', [$curso->id, 'curso']) }}">
					                                    <img src="{{ asset('uploads/images/courses/'.$curso->cover) }}" class="content-image">
				                                    </a>
				                                @else
				                                   	<a href="{{ route('landing.courses.show', [$curso->slug, $curso->id]) }}">
					                                    <img src="{{ asset('uploads/images/courses/'.$curso->cover) }}" class="content-image">
					                                </a>
				                                @endif
				                            </div>
				                            <div class="uk-card-body card-body">
				                                <a href="{{ route('landing.courses.show', [$curso->slug, $curso->id]) }}">
				                                    <div>
				                                        <div class="course-title">{{ $curso->title }}</div>
					                                    <div class="course-instructor">Por: {{ $curso->user->names.' '.$curso->user->last_names }}</div>
					                                    <div class="course-category"><strong>{{ $curso->category->title }}</strong></div>
				                                        <div class="course-subtitle">{{ ucfirst($curso->subtitle) }}</div>

				                                        <br>
				                                            
				                                        <a class="show-more-link" href="{{ route('landing.courses.show', [$curso->slug, $curso->id]) }}">Ver más</a>
				                                    </div>
				                                </a>
					                            <div class="card-buttons">
					                                @if (Auth::guest())
					                                    <a class="uk-button btn-style" href="#modal-login" uk-toggle>Agregar al carrito</a>
					                                @elseif (Auth::user()->role_id == 1)
					                                    @if (!in_array($curso->id, $misCursos))
							                                @if (!is_null(Auth::user()->membership_id))
							                                    @if (Auth::user()->membership_courses < 3)
							                                        <a class="uk-button btn-style" href="{{ route('students.courses.add', [$curso->id, 'membresia']) }}">Agregar a Mis Cursos</a>
							                                    @else
							                                       	<a class="uk-button btn-style" href="{{ route('landing.shopping-cart.store', [$curso->id, 'curso']) }}">Agregar al Carrito</a>
							                                    @endif
							                                @else
							                                    <a class="uk-button btn-style" href="{{ route('landing.shopping-cart.store', [$curso->id, 'curso']) }}">Agregar al Carrito</a>
							                                @endif
							                            @else
							                                <a class="uk-button btn-style2" href="{{ route('students.courses.resume', [$curso->slug, $curso->id]) }}">Continuar T-Course</a>
					                                    @endif
					                                @endif
					                            </div>
				                            </div>
				                            <div class="uk-text-center course-price">COP {{ number_format($curso->price, 0, ',', '.') }}</div>
				                        </div>
				                    </li>
				                @endforeach
			               	</ul>
		    			</div>
		    		@endif

	    			@if ($librosRelacionados->count() > 0)
		    			<div style="padding-top: 20px;">
		    				<div class="courses-category-title">T-Libros</div>
			    			<ul class="uk-child-width-1-1 uk-child-width-1-1@s uk-child-width-1-2@m uk-child-width-1-3@l uk-child-width-1-3@xl" uk-grid>
				                @foreach ($librosRelacionados as $libro)
					                <li class="course uk-transition-toggle" tabindex="0">
				                        <div class="uk-card uk-card-small course-card">
				                            <div class="uk-card-media-top image-div">
				                                @if (!is_null($libro->preview))
				                                    <a class="view-preview" uk-toggle="target: #modal-preview" data-viewPreview="{{ route('ajax.load-preview', [$libro->id, 'podcast']) }}">
					                                    <img src="{{ asset('uploads/images/podcasts/'.$libro->cover) }}" class="content-image">
					                                </a>
				                                @else
				                                    <a href="{{ route('landing.podcasts.show', [$libro->slug, $libro->id]) }}">
					                                    <img src="{{ asset('uploads/images/podcasts/'.$libro->cover) }}" class="content-image">
					                                </a>
				                                @endif
				                            </div>
				                            <div class="uk-card-body card-body">
				                               	<a href="{{ route('landing.podcasts.show', [$libro->slug, $libro->id]) }}">
				                                    <div>
				                                        <div class="course-title">{{ $libro->title }}</div>
					                                    <div class="course-instructor">Por: {{ $libro->user->names.' '.$libro->user->last_names }}</div>
					                                    <div class="course-category"><strong>{{ $libro->category->title }}</strong></div>
				                                        <div class="course-subtitle">{{ ucfirst($libro->subtitle) }}</div>

				                                        <br>
				                                        <a class="show-more-link" href="{{ route('landing.podcasts.show', [$libro->slug, $libro->id]) }}">Ver más</a>
				                                    </div>
				                                </a>
					                            <div class="card-buttons">
					                                @if (Auth::guest())
					                                    <a class="uk-button btn-style" href="#modal-login" uk-toggle> Agregar al carrito</a>
					                                @elseif (Auth::user()->role_id == 1)
					                                   	@if (!in_array($libro->id, $misLibros))
						                                    <a class="uk-button btn-style" href="{{ route('landing.shopping-cart.store', [$libro->id, 'podcast']) }}"> Agregar al Carrito</a>
						                                @else
						                                    <a class="uk-button btn-style2" href="{{ route('students.podcasts.resume', [$libro->slug, $libro->id]) }}">Continuar T-Book</a>
					                                    @endif
					                                @endif
					                            </div>
				                            </div>
				                            <div class="uk-text-center course-price">COP {{ number_format($libro->price, 0, ',', '.') }}</div>
				                        </div>
				                    </li>
				                @endforeach
			               	</ul>
		    			</div>
		    		@endif

	    			@if ($certificacionesRelacionadas->count() > 0)
		    			<div style="padding-top: 20px;">
		    				<div class="courses-category-title">T-Mentorings</div>
		    				<ul class="uk-child-width-1-1 uk-child-width-1-1@s uk-child-width-1-2@m uk-child-width-1-3@l uk-child-width-1-3@xl" uk-grid>
				                @foreach ($certificacionesRelacionadas as $certificacion)
					                <li class="course uk-transition-toggle" tabindex="0">
				                        <div class="uk-card uk-card-small course-card">
				                            <div class="uk-card-media-top image-div">
				                                @if (!is_null($certificacion->preview))
					                                <a class="view-preview" uk-toggle="target: #modal-preview" data-viewPreview="{{ route('ajax.load-preview', [$certificacion->id, 'certificacion']) }}">
					                                    <img src="{{ asset('uploads/images/certifications/'.$certificacion->cover) }}" class="content-image">
				                                    </a>
				                                @else
				                                   	<a href="{{ route('landing.certifications.show', [$certificacion->slug, $certificacion->id]) }}">
					                                    <img src="{{ asset('uploads/images/certifications/'.$certificacion->cover) }}" class="content-image">
					                                </a>
				                                @endif
				                            </div>
				                            <div class="uk-card-body card-body">
				                                <a href="{{ route('landing.certifications.show', [$certificacion->slug, $certificacion->id]) }}">
				                                    <div>
				                                        <div class="course-title">{{ $certificacion->title }}</div>
					                                    <div class="course-instructor">Por: {{ $certificacion->user->names.' '.$certificacion->user->last_names }}</div>
					                                    <div class="course-category"><strong>{{ $certificacion->category->title }}</strong></div>
				                                        <div class="course-subtitle">{{ ucfirst($certificacion->subtitle) }}</div>

				                                        <br>
				                                            
				                                        <a class="show-more-link" href="{{ route('landing.certifications.show', [$certificacion->slug, $certificacion->id]) }}">Ver más</a>
				                                    </div>
				                                </a>
					                            <div class="card-buttons">
					                                @if (Auth::guest())
					                                    <a class="uk-button btn-style" href="#modal-login" uk-toggle>Agregar al carrito</a>
					                                @elseif (Auth::user()->role_id == 1)
					                                    @if (!in_array($certificacion->id, $misCertificaciones))
							                                <a class="uk-button btn-style" href="{{ route('landing.shopping-cart.store', [$certificacion->id, 'certificacion']) }}">Agregar al Carrito</a>
							                            @else
							                                <a class="uk-button btn-style2" href="{{ route('students.certifications.resume', [$certificacion->slug, $certificacion->id]) }}">Continuar T-Mentoring</a>
					                                    @endif
					                                @endif
					                            </div>
				                            </div>
				                            <div class="uk-text-center course-price">COP {{ number_format($certificacion->price, 0, ',', '.') }}</div>
				                        </div>
				                    </li>
				                @endforeach
			               	</ul>
		    			</div>
		    		@endif
	    		@else
	    			<div style="padding-top: 10px; font-size: 21px;">
		                No existen cursos, ni libros ni mentorías relacionados con esta búsqueda...
		            </div>
	    		@endif
    		</div>
    	</div>
    </div>
@endsection