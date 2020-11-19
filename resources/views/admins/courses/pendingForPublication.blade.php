@extends('layouts.admin')

@push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>

    <script>
         $(document).ready( function () {
            $('#datatable').DataTable( {
                dom: '<Bf<t>ip>',
                responsive: true,
                order: [[ 1, "asc" ]],
                pageLength: 20,
                buttons: [
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    'colvis', 
                ]
            });
        });

        function cargarModal($curso){
            document.getElementById("course_id").value = $curso;
            var modal = UIkit.modal("#modalCorrecciones");
            modal.show(); 
        }
    </script>
@endpush

@section('content')
    <div class="admin-content-inner"> 
        <div class="uk-flex-inline uk-flex-middle uk-margin-small-bottom"> 
            <i class="fas fa-video icon-large uk-margin-right"></i> 
            <h4 class="uk-margin-remove"> T-Courses Pendientes Para Publicación</h4>                          
        </div>  

        @if (Session::has('msj-exitoso'))
            <div class="uk-alert-success" uk-alert>
                <a class="uk-alert-close" uk-close></a>
                <strong>{{ Session::get('msj-exitoso') }}</strong>
            </div>
        @endif               
        
        <div class="uk-background-default uk-margin-top uk-padding"> 
            <div class="uk-overflow-auto uk-margin-small-top"> 
                <table id="datatable"> 
                    <thead> 
                        <tr class="uk-text-small uk-text-bold"> 
                            <th class="uk-text-center">Cover</th> 
                            <th class="uk-text-center">Título</th> 
                            <th class="uk-text-center">Instructor</th> 
                            <th class="uk-text-center">Categoría</th>
                            <th class="uk-text-center">Fecha de Envío</th> 
                            <th class="uk-text-center">Acción</th> 
                        </tr>                             
                    </thead>                         
                    <tbody> 
                        @foreach ($cursos as $curso)
                            <tr>                                 
                                <td class="uk-text-center">
                                    <img class="uk-preserve-width uk-border-circle user-profile-small" src="{{ asset('uploads/images/courses/'.$curso->cover) }}" width="50">
                                </td>                                 
                                <td class="uk-text-center">{{ $curso->title }}</td> 
                                <td class="uk-text-center">{{ $curso->user->names }} {{ $curso->user->last_names }}</td> 
                                <td class="uk-text-center"><i class="{{ $curso->category->icon }}"></i> {{ $curso->category->title }} ({{ $curso->subcategory->title }})</td> 
                                <td class="uk-text-center">{{ date('d-m-Y', strtotime("$curso->sent_for_review -5 Hours")) }}</td> 
                                <td class="uk-flex-inline uk-text-center"> 
                                    <a href="{{ route('admins.courses.resume', [$curso->slug, $curso->id]) }}" class="uk-icon-button uk-button-success btn-icon" uk-icon="icon: search;" uk-tooltip="Ver Detalles"></a>
                                    <a href="{{ route('admins.courses.show', [$curso->slug, $curso->id]) }}" class="uk-icon-button uk-button-primary btn-icon" uk-icon="icon: pencil;" uk-tooltip="Editar"></a> 
                                    <a href="{{ route('admins.courses.lessons', [$curso->slug, $curso->id]) }}" class="uk-icon-button uk-button-success btn-icon" uk-icon="icon: settings;" uk-tooltip="Administrar Lecciones"></a>
                                    @if (Auth::user()->profile->courses == 2)
                                        <form action="{{ route('admins.courses.change-status') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="course_id" value="{{ $curso->id }}">
                                            <input type="hidden" name="action" value="Aprobar">
                                            <button class="uk-icon-button uk-button-success btn-icon" uk-icon="icon: check;" uk-tooltip="Aprobar"></button>
                                        </form> 
                                        <a href="#" class="uk-icon-button uk-button-primary btn-icon" uk-icon="icon: file-edit;" uk-tooltip="Enviar Correcciones" onclick="cargarModal({{ $curso->id }});"></a> 
                                        <form action="{{ route('admins.courses.change-status') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="course_id" value="{{ $curso->id }}">
                                            <input type="hidden" name="action" value="Eliminar">
                                            <button class="uk-icon-button uk-button-danger btn-icon" uk-icon="icon: trash;" uk-tooltip="Eliminar"></button>
                                        </form>  
                                    @endif                            
                                </td>                                 
                            </tr>   
                        @endforeach  
                    </tbody>                         
                </table>          
            </div>    
        </div>                 
    </div>

    <div id="modalCorrecciones" class="uk-modal-container" uk-modal>
        <div class="uk-modal-dialog">
            <button class="uk-modal-close-default" type="button" uk-close></button>
            <div class="uk-modal-header">
                <h4>Correcciones</h4>
            </div>
            <form action="{{ route('admins.courses.send-corrections') }}" method="POST">
                @csrf
                <input type="hidden" name="course_id" id="course_id">
                <input type="hidden" name="content_type" value="curso">
                
                <div class="uk-modal-body">
                    <textarea class="ckeditor" name="corrections"></textarea>
                    <script>
                        ClassicEditor
                            .create( document.querySelector( '.ckeditor' ) )
                            .catch( error => {
                                 console.error( error );
                            } );
                   </script>
                </div>
                <div class="uk-modal-footer uk-text-right">
                    <button class="uk-button uk-button-default uk-modal-close" type="button">Cancelar</button>
                    <button class="uk-button uk-button-primary" type="submit">Enviar</button>
                </div> 
            </form>
        </div>
    </div>
@endsection