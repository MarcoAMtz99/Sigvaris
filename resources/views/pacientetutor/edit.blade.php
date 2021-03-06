@extends('paciente.show')
@section('submodulos')

    <div class="row my-5">
        <div class="col-4 px-5"><h4>Tutor</h4></div>
        <input id="submenu" type="hidden" name="submenu" value="nav-tutor"> 
    </div>
    <div class="row">
        <div class="col-12">
            <form role="form" name="domicilio" id="form-cliente" method="POST" action="{{ route('pacientes.tutores.update', ['paciente'=>$paciente, 'tutor'=>$tutor]) }}" name="form">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    
                    
                <div class="row">
                    <div class="form-group col-3">
                        <label class="control-label" for="nombre"><i class="fa fa-asterisk"></i> Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{$tutor->nombre}}" required autofocus>
                    </div>
                    <div class="form-group col-3">
                        <label class="control-label" for="paterno"><i class="fa fa-asterisk"></i> Apellido Paterno:</label>
                        <input type="text" class="form-control" id="paterno" name="paterno" value="{{$tutor->paterno}}" required>
                    </div>	
                    <div class="form-group col-3">
                        <label class="control-label" for="materno"><i class="fa fa-asterisk"></i> Apellido Materno:</label>
                        <input type="text" class="form-control" id="materno" name="materno" value="{{$tutor->materno}}" required>
                    </div>
                    <div class="form-group col-3">
                        <label class="control-label" for="relacion"><i class="fa fa-asterisk"></i> Relación:</label>
                        <input type="text" class="form-control" id="relacion" name="relacion" value="{{$tutor->relacion}}" required>
                    </div>	
                </div>
                <div class="row-">
                    <div class="col-12">
                        <button type="submit" class="btn btn-success">
                            <strong>Guardar</strong>
                        </button>
                    </div>
                </div>
                    
            </form>
        </div>
    
    </div>

@endsection