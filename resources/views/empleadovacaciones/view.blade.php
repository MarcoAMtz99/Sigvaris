@extends('layouts.infoempleado')
@section('infoempleado')
	{{-- expr --}}
	<div>
		<ul class="nav nav-pills nav-justified">
			<li role="presentation" class="nav-item"><a href="{{ route('empleados.show',['empleado'=>$empleado]) }}"  class="nav-link">Generales:</a></li>

			<li role="presentation" class="nav-item"><a href="{{ route('empleados.datoslaborales.index',['empleado'=>$empleado]) }}" class="nav-link">Laborales:</a></li>

			

			<li role="presentation" class="nav-item"><a href="{{ route('empleados.emergencias.index',['empleado'=>$empleado]) }}" class="nav-link">Emergencias:</a></li>

			<li role="presentation" class="nav-item"><a href="{{ route('empleados.vacaciones.index',['empleado'=>$empleado]) }}" class="nav-link active">Vacaciones:</a></li>

			<li role="presentation" class="nav-item"><a href="{{ route('empleados.faltas.index',['empleado'=>$empleado]) }}" class="nav-link">Administrativo:</a></li>
		</ul>
	</div>
	<div class="card">
		<div class="card-header"><h5>Vacaciones:
		&nbsp;&nbsp;&nbsp;&nbsp; <i class="fa fa-asterisk" aria-hidden="true"></i>Campos Requeridos</h5></div>
		<div class="card-body">
			<form role="form" method="POST" action="{{ route('empleados.vacaciones.store',['empleado'=>$empleado]) }}">
				{{ csrf_field() }}
				<input type="hidden" name="empleado_id" value="{{$empleado->id }}">
				{{-- <div class="col-xs-12 offset-md-2 mt-3"> --}}
					<div class="row">
						{{-- Fecha inicio vacaciones --}}
						<div class="col-12 col-md-4">
							<div class="form-group">
								<label class="control-label" for="fechainicio" id="lbl_vacaciones"><i class="fa fa-asterisk" aria-hidden="true"></i>Fecha de Inicio:</label>
								<input type="date" class="form-control" id="id_vacaciones" name="fechainicio">
							</div>
						</div>
						{{-- Fecha de fin de vacaciones --}}
						<div class="col-12 col-md-4">
							<div class="form-group">
								<label class="control-label" for="fechafin" id="lbl_vacaciones"><i class="fa fa-asterisk" aria-hidden="true"></i>Fecha de Fin:</label>
								<input type="date" class="form-control" id="id_vacaciones_fin" name="fechafin">
							</div>
						</div>
						{{-- Numero de dias de vacaciones --}}
						<div class="col-12 col-md-4">
							<div class="form-group">
								<label class="control-label" for="diastomados">Número de días de vacaciones:</label>
								<input type="text" class="form-control" id="dias_vac" name="diastomados">
							</div>
						</div>
						{{-- Dias restantes de vacaciones --}}
						<div class="col-12 col-md-4">
							<div class="form-group">
								<label class="control-label" for="diasrestantes">Días vacaiones restantes:</label>
								<input type="text" class="form-control" id="dias_vac_rest" name="diasrestantes">
							</div>
						</div>
						{{-- Periodo de vacaciones --}}
						<div class="col-12 col-md-4">
							<div class="form-group">
								<label class="control-label" for="periodo1">Periodo de:</label>
								<input type="text" class="form-control" id="dias_vac_rest" name="periodo1">
							</div>
						</div>
						{{-- Hasta el dia de vacaciones --}}
						<div class="col-12 col-md-4">
							<div class="form-group">
								<label>al día : </label>
								<input type="text" class="form-control" id="dias_vac_rest" name="periodo2">
							</div>
						</div>
						{{-- Dias totales de vacaciones --}}
						<div class="col-12 col-md-4">
							<div class="form-group">
								<label class="" for="dias_vac_rest">Días totales: </label>
								<input type="text" class="form-control" id="dias_vac_rest" name="diastotal">
							</div>
						</div>
					</div>
					
				<button type="submit" class="btn btn-success">Guardar</button>
				
			</form>
			<div class="col-xs-12 offset-md-2 mt-6">
				<table class="table table-striped table-bordered table-hover" style="color:rgb(51,51,51); border-collapse: collapse; margin-bottom: 0px">
					<thead>
						<tr class="info">
							<th>Fecha:</th>
							<th>Fecha de inicio:</th>
							<th>Fecha Fin:</th>
							<th>Días:</th>
							<th>Días Restantes:</th>
						</tr>
					</thead>
					@foreach ($vacaciones as $vacacion)
						{{-- expr --}}
						<tr class="active">
							<td>{{$vacacion->created_at}}</td>
							<td>{{$vacacion->fechainicio}}</td>
							<td>{{$vacacion->fechafin}}</td>
							<td>{{$vacacion->diastomados}}</td>
							<td>{{$vacacion->diasrestantes}}</td>
						</tr>
					@endforeach
				</table>

			</div>

		</div>
	</div>
@endsection