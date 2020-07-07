@extends('principal')
@section('content')

<div class="container">
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered mt-3">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre de paciente</th>
                        <th scope="col">Folio de venta</th>
                        <th scope="col">Monto</th>
                        <th scope="col">Numero de cuenta</th>
                        <th scope="col">Beneficiario </th>
                        <th scope="col">Referencia </th>
                        <th scope="col">Clave</th>
                        <th scope="col">Banco </th>
                        <th scope="col">Fecha </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($Devoluciones as $Devolucion)
                    <tr>
                        <td>{{$Devolucion->id}}</td>
                        <td>{{$Devolucion->venta->paciente->nombre." ".$Devolucion->venta->paciente->materno." ".$Devolucion->venta->paciente->paterno}}</td>
                        <td>{{$Devolucion->venta->id}}</td>
                        <td>{{$Devolucion->monto}}</td>
                        <td>{{$Devolucion->cuenta}}</td>
                        <td>{{$Devolucion->beneficiario}}</td>
                        <td>{{$Devolucion->referencia}}</td>
                        <td>{{$Devolucion->clave}}</td>
                        <td>{{$Devolucion->banco}}</td>
                        <td>{{$Devolucion->created_at}}</td>                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>
    </div>
</div>

@endsection