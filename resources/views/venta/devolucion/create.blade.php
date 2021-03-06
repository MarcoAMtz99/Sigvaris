@extends('principal')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-4">
                    <h4>Venta</h4>
                </div>
                <div class="col-4 text-center">
                    <a href="{{ route('ventas.index') }}" class="btn btn-primary">
                        <i class="fa fa-bars"></i><strong> Lista de Ventas</strong>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="card-body">
                <div class="row">
                    <div class="col-3 form-group">
                        <label class="control-label">Fecha:</label>
                        <input type="text" class="form-control" value="{{$venta->fecha}}" readonly="">
                    </div>
                    <div class="col-3 form-group">
                        <label class="control-label">Cliente:</label>
                        <input type="text" class="form-control" value="{{$venta->paciente->fullname}}" readonly="">
                    </div>
                    <div class="col-3 form-group">
                        <label class="control-label">Folio:</label>
                        <input type="number" class="form-control" value="{{$venta->id}}" readonly="">
                    </div>
                    @if ($venta->oficina_id)
                    <div class="col-3 form-group">
                        <label class="control-label">Tienda:</label>
                        <input type="text" class="form-control" value="{{$venta->oficina->nombre}}" readonly="">
                    </div>
                    @endif
                    {{-- <div class="col-4 form-group">
                        <label class="control-label">Oficina:</label>
                        <input type="text" class="form-control" value="{{$venta->oficina->nombre}}" readonly="">
                </div> --}}
            </div>
            <div class="row">
                <div class="col-12">
                    <h5>Productos</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>sku</th>
                                <th>Nombre</th>
                                <th>Precio Individual</th>
                                <th>Cantidad</th>
                                <th>Precio total</th>
                                <th>Devolver</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($venta->productos as $producto)
                            <tr>
                                <td>{{$producto->sku}}</td>
                                <td>{{$producto->descripcion}}</td>
                                <td>{{$producto->precio_publico_iva}}</td>
                                <td>{{$producto->pivot->cantidad}}</td>
                                <td>{{$producto->precio_publico_iva * $producto->pivot->cantidad}}</td>
                                <td>

                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#modal-{{$producto->id}}" onclick="updateDiferenciaDePrecios({{$producto->id}},{{$venta->id}},{{$producto->pivot->precio }})">
                                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="modal-{{$producto->id}}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Cambio de producto:
                                                        {{$producto->sku}}</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{route('ventas.devoluciones.store', ['venta'=>$venta->id])}}" method="POST" onsubmit="return checkAcceptation()">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <label for="" class="text-uppercase text-muted mt-2">SKU
                                                                    PRODUCTO DEVUELTO</label>
                                                                <input type="text" name="skuProductoDevuelto"
                                                                    class="form-control" value="{{$producto->sku}}"
                                                                    readonly>
                                                            </div>
                                                            <div class="col-12">
                                                                <label for=""
                                                                    class="text-uppercase text-muted mt-2">DESCRIPCIÓN</label>
                                                                <select name="opcion" id="" class="form-control">
                                                                    <option value="Servicio">Servicio</option>
                                                                    <option value="Cliente enojado">Cliente enojado</option>
                                                                    <option value="Amenaza">Amenaza</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-12">
                                                                <label for=""
                                                                    class="text-uppercase text-muted mt-2">Tipo de cambio</label>
                                                                <select name="tipo_cambio" id="tipo_cambio" class="form-control">
                                                                    <option value="1">Saldo a favor</option>
                                                                    <option value="2">Devolución de dinero</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-12">
                                                                <label for=""
                                                                    class="text-uppercase text-muted mt-2">MONTO DEVUELTO</label>
                                                                <input type="text" id="MONTO" name="MONTO"
                                                                    class="form-control inputPrecioDiferencia" productoId="{{$producto->id}}"
                                                                    readonly>
                                                            </div>
                                                             <div class="col-4 mt-2">
                                                            <label for="" class="text-uppercase text-muted">DESCUENTO</label>
                                                            <input id="prec_des" type="text" value="0" name="prec_des"
                                                                class="form-control prec_des"readonly>
                                                        </div>
                                                        <div class="col-4 mt-2">
                                                             <hr size="10" />
                                                            
                                                            <input id="preciodos" type="text" value="0" name="preciodos"
                                                                class="form-control preciodos"readonly>
                                                            <input type="hidden" name="tipoPago" id="tipoPago" value="">
                                                        </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">DEVOLVER</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-4 form-group">
                    <label class="control-label">Subtotal:</label>
                    <input type="number" class="form-control" value="{{$venta->subtotal}}" readonly="">
                </div>
                <div class="col-4 form-group">
                    <label class="control-label">Descuento:</label>
                    <input type="text" class="form-control"
                        value="{{round($venta->subtotal-$venta->total+($venta->subtotal*0.16))}}" readonly="">
                    {{-- @if ($venta->descuento)
                            @if ($venta->promocion->tipo=='E')
                                <input type="text" class="form-control" value="0" readonly="">
                            @else
                                <input type="text" class="form-control" value="{{ $venta->subtotal-$venta->total+($venta->subtotal*0.16) }}"
                    readonly="">
                    @endif

                    @else
                    <input type="text" class="form-control" value="0" readonly="">
                    @endif --}}

                </div>
                <div class="col-4 form-group">
                    <label class="control-label">Total:</label>
                    <input type="number" class="form-control" value="{{$venta->total}}" readonly="">
                </div>
            </div>

        </div>
        </form>

    </div>

</div>
</div>


<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#tablaHistorialCambios').DataTable();
    } );

    async function updateDiferenciaDePrecios( idProducto,ventaId, precioProductoDevuelto){

        

        await $.ajax( {
            url: `{{url('calcular-diferencia-devolucion')}}`,
            data: {
                ventaId,
                precioProductoDevuelto
            },
            success: function( response ){
                console.log('RESPONSE')
                console.log( response )
                $(`.prec_des`).val( response.promo);
                $(`.inputPrecioDiferencia[productoId=${idProducto}]`).val( parseFloat(response.diferencia).toFixed(2) );
                 $(`.preciodos`).val( response.dos );
                 $('#tipoPago').val( parseInt(response.tipoPago) );
                 // console.log("tipo de pago",response.tipoPago);
            },
            error: function( e ){
                console.table(e)
                $(`.inputPrecioDiferencia[productoId=${idProducto}]`).val( 0 )
            }
        } )
    }
</script>
 <script>
                
            function checkAcceptation() {

                 var monto = $('#MONTO').val();
                 // alert("se devolvera el monto al cliente: ",monto);

                if ($('#tipo_cambio').val()==1) {
                    alert("Estas por asignar saldo a favor");
                    if (confirm("Presione aceptar para confirmar que se asignara saldo a favor al paciente ")){
                                      return true;
                                     }else{
                                     return false;
                                     }


                    } else if($('#tipo_cambio').val()==2){
                    alert("Estas por hacer una devolucion");
                         if (confirm("Presione aceptar para confirmar que se devolvera el dinero al paciente ")){
                                            return true;
                                      }else{
                                             return false;
                                    }



                }

               
             
          
        }
               
          </script> 
          
@endsection