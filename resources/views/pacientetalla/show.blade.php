@extends('paciente.show')
@section('submodulos')

    <div class="row my-5">
        <div class="col-4 px-5"><h4>Medidas</h4></div>
        <input id="submenu" type="hidden" name="submenu" value="nav-tallas"> 
    </div>
    <div class="row">
        <div class="col-12">
            <form role="form" name="domicilio" id="form-cliente" method="POST" action="{{ route('pacientes.tallas.update', ['paciente'=>$paciente, 'talla'=>$talla]) }}" name="form">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="row mb-3">
                <div class="form-group col-6">
                    <div class="form-group col-12">
                        <label for="nivel">Sexo:</label>
                        <select disabled class="form-control" name="sexo" id="sexo" required>
                            <option value="{{$talla->sexo}}">{{$talla->sexo}}</option>
                            <option value="dama">Dama</option>
                            <option value="caballero">Caballero</option>
                        </select>
                    </div>
                    <h5>Compresión</h5>
                    <div class="form-group col-12">
                        <label for="nivel">Pierna:</label>
                        <select disabled class="form-control compresion" name="pierna" id="pierna" required>
                            <option value="{{$talla->pierna}}">{{$talla->pierna}}</option>
                            <option value="">Ninguna</option>
                            <option value="15-20 mmHG">15-20 mmHG</option>
                            <option value="18-25 mmHG">18-25 mmHG</option>
                            <option value="20-30 mmHG">20-30 mmHG</option>
                            <option value="30-40 mmHG">30-40 mmHG</option>
                        </select>
                    </div>
                    <div class="form-group col-12">
                        <label for="nivel">Brazo:</label>
                        <select disabled class="form-control compresion" name="brazo" id="brazo" required>/
                            <option value="{{$talla->brazo}}">{{$talla->brazo}}</option>
                            <option value="">Ninguna</option>
                            <option value="15-20 mmHG">15-20 mmHG</option>
                            <option value="20-30 mmHG">20-30 mmHG</option>
                        </select>
                    </div>

                </div>
                <div class="form-group col-3 estilos-pierna">
                    <h5>Estilos Pierna</h5>
                    <div class="form-check">
                        <input readonly name="tobimedia" class="form-check-input cb-pierna-estilo" type="checkbox" value="{{$talla->tobimedia}}" id="tobimedia" {{$talla->tobimedia == 1 ? 'checked' : ''}}>
                        <label class="form-check-label" for="tobimedia">
                            tobimedia
                        </label>
                    </div>
                    <div class="form-check">
                        <input readonly name="media" class="form-check-input cb-pierna-estilo" type="checkbox" value="{{$talla->media}}" id="media" {{$talla->media == 1 ? 'checked' : ''}}>
                        <label class="form-check-label" for="media">
                            media
                        </label>
                    </div>
                    <div class="form-check">
                        <input readonly name="pantimedia" class="form-check-input cb-pierna-estilo" type="checkbox" value="{{$talla->pantimedia}}" id="pantimedia" {{$talla->pantimedia == 1 ? 'checked' : ''}}>
                        <label class="form-check-label" for="pantimedia">
                            pantimedia
                        </label>
                    </div>
                    <div class="form-check">
                        <input readonly name="calcetin" class="form-check-input cb-pierna-estilo" type="checkbox" value="{{$talla->calcetin}}" id="calcetin" {{$talla->calcetin == 1 ? 'checked' : ''}}>
                        <label class="form-check-label" for="calcetin">
                            calcetin
                        </label>
                    </div>
                    <div class="form-check">
                        <input readonly name="pantorrillera" class="form-check-input cb-pierna-estilo" type="checkbox" value="{{$talla->pantorrillera}}" id="pantorrillera" {{$talla->pantorrillera == 1 ? 'checked' : ''}}>
                        <label class="form-check-label" for="pantorrillera">
                            pantorrillera
                        </label>
                    </div>
                    <div class="form-check">
                        <input readonly name="pantorrillera" class="form-check-input cb-pierna-estilo" type="checkbox" value="{{$talla->leggins}}" id="pantorrillera" {{$talla->leggins == 1 ? 'checked' : ''}}>
                        <label class="form-check-label" for="pantorrillera">
                            leggins
                        </label>
                    </div>
                </div>
                <div class="form-group col-3 estilos-brazo">
                    <h5>Estilos Brazo</h5>
                    <div class="form-check">
                        <input readonly name="guante" class="form-check-input cb-brazo-estilo" type="checkbox" value="{{$talla->guante}}" id="guante" {{$talla->guante == 1 ? 'checked' : ''}}>
                        <label class="form-check-label" for="guante">
                            guante
                        </label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-6 estilos-pierna">
                    <h5>Medidas Pierna</h5>
                    <div class="row">
                        <div class="col-3 offset-6">
                            <h6>Izq</h6>
                        </div>
                        <div class="col-3">
                            <h6>Dcha</h6>
                        </div>
                    </div>
                    <div class="input-group mb-2">
                        <div class="col-sm-4">
                            <span class="input-group-text">Circunferencia Tobillo</span>
                        </div>
                        <input readonly value="{{$talla->circunferencia_tobillo_izq}}" name="circunferencia_tobillo_izq" id="circunferencia_tobillo_izq" type="text" class="col-sm-4">
                        <input readonly value="{{$talla->circunferencia_tobillo_dcha}}" name="circunferencia_tobillo_dcha" id="circunferencia_tobillo_dcha" type="text" class="col-sm-4">
                    </div>

                    <div class="input-group mb-2">
                        <div class="col-sm-4">
                            <span class="input-group-text">Circunferencia Pantorrilla</span>
                        </div>
                        <input readonly value="{{$talla->circunferencia_pantorrilla_izq}}" name="circunferencia_pantorrilla_izq" id="circunferencia_pantorrilla_izq" type="text" class="col-sm-4">
                        <input readonly value="{{$talla->circunferencia_pantorrilla_dcha}}" name="circunferencia_pantorrilla_dcha" id="circunferencia_pantorrilla_dcha" type="text" class="col-sm-4">
                    </div>
                    <div class="input-group mb-2">
                        <div class="col-sm-4">
                            <span class="input-group-text">Altura Pantorrilla</span>
                        </div>
                        <input readonly value="{{$talla->altura_pantorrilla_izq}}" name="altura_pantorrilla_izq" id="altura_pantorrilla_izq" type="text" class="col-sm-4">
                        <input readonly value="{{$talla->altura_pantorrilla_dcha}}" name="altura_pantorrilla_dcha" id="altura_pantorrilla_dcha" type="text" class="col-sm-4">
                    </div>
                    <div class="input-group mb-2">
                        <div class="col-sm-4">
                            <span class="input-group-text">Circunferencia Muslo</span>
                        </div>
                        <input readonly value="{{$talla->circunferencia_muslo_izq}}" name="circunferencia_muslo_izq" id="circunferencia_muslo_izq" type="text" class="col-sm-4">
                        <input readonly value="{{$talla->circunferencia_muslo_dcha}}" name="circunferencia_muslo_dcha" id="circunferencia_muslo_dcha" type="text" class="col-sm-4">
                    </div>
                    <div class="input-group mb-2">
                        <div class="col-sm-4">
                            <span class="input-group-text">Altura Pierna</span>
                        </div>
                        <input readonly value="{{$talla->altura_pierna_izq}}" name="altura_pierna_izq" id="altura_pierna_izq" type="text" class="col-sm-4">
                        <input readonly value="{{$talla->altura_pierna_dcha}}" name="altura_pierna_dcha" id="altura_pierna_dcha" type="text" class="col-sm-4">
                    </div>
                    <div class="input-group mb-2 circunferencia_cadera">
                        <div class="col-sm-4">
                            <span class="input-group-text">Circunferencia cadera</span>
                        </div>
                        <input readonly value="{{$talla->circunferencia_cadera}}" {{-- name="circunferencia_cadera" id="circunferencia_cadera" --}} type="text" class="col-sm-8">
                    </div>
                    <div class="input-group mb-2">
                        <div class="col-sm-4">
                            <span class="input-group-text">Calzado</span>
                        </div>
                        <input readonly value="{{$talla->calzado_izq}}" name="calzado_izq" id="calzado_izq" type="text" class="col-sm-4">
                        <input readonly value="{{$talla->calzado_dcha}}" name="calzado_dcha" id="calzado_dcha" type="text" class="col-sm-4">
                    </div>
                    <div class="input-group mb-2 peso">
                        <div class="col-sm-4">
                            <span class="input-group-text">Peso</span>
                        </div>
                        <input readonly value="{{$talla->peso}}" {{-- name="peso" id="peso" --}} type="text" class="col-sm-8">
                    </div>
                    <div class="input-group mb-2 estatura">
                        <div class="col-sm-4">
                            <span class="input-group-text">Estatura</span>
                        </div>
                        <input readonly value="{{$talla->estatura}}" {{-- name="estatura" id="estatura" --}} type="text" class="col-sm-8">
                    </div>
                </div>
                <div class="form-group col-6 estilos-brazo">
                        <h5>Medidas Brazo</h5>
                        <div class="row">
                            <div class="col-3 offset-6">
                                <h6>Izq</h6>
                            </div>
                            <div class="col-3">
                                <h6>Dcha</h6>
                            </div>
                        </div>
                        
                        <div class="input-group mb-2">
                            <div class="col-sm-4">
                                <span class="input-group-text">Circunferencia Palma</span>
                            </div>
                            <input readonly value="{{$talla->circunferencia_plama_izq}}" name="circunferencia_plama_izq" id="circunferencia_plama_izq" type="text" class="col-sm-4">
                            <input readonly value="{{$talla->circunferencia_plama_dcha}}" name="circunferencia_plama_dcha" id="circunferencia_plama_dcha" type="text" class="col-sm-4">
                        </div>
                        <div class="input-group mb-2">
                            <div class="col-sm-4">
                                <span class="input-group-text">Circunferencia Muñeca</span>
                            </div>
                            <input readonly value="{{$talla->circunferencia_munieca_izq}}" name="circunferencia_munieca_izq" id="circunferencia_munieca_izq" type="text" class="col-sm-4">
                            <input readonly value="{{$talla->circunferencia_munieca_dcha}}" name="circunferencia_munieca_dcha" id="circunferencia_munieca_dcha" type="text" class="col-sm-4">
                        </div>
                        <div class="input-group mb-2">
                            <div class="col-sm-4">
                                <span class="input-group-text">Circunferencia parte media</span>
                            </div>
                            <input readonly value="{{$talla->circunferencia_media_izq}}" name="circunferencia_media_izq" id="circunferencia_media_izq" type="text" class="col-sm-4">
                            <input readonly value="{{$talla->circunferencia_media_dcha}}" name="circunferencia_media_dcha" id="circunferencia_media_dcha" type="text" class="col-sm-4">
                        </div>
                        <div class="input-group mb-2">
                            <div class="col-sm-4">
                                <span class="input-group-text">Talla</span>
                            </div>
                            <input readonly value="{{$talla->talla_izq}}" name="talla_izq" id="talla_izq" type="text" class="col-sm-4">
                            <input readonly value="{{$talla->talla_dcha}}" name="talla_dcha" id="talla_dcha" type="text" class="col-sm-4">
                        </div>
                    </div>

            </div>
                    {{-- <div class="col-12">
                        <button type="submit" class="btn btn-success">
                            <strong>Guardar</strong>
                        </button>
                    </div> --}}
                </div>
                    
            </form>
        </div>
    
    </div>
    <script>
    $(document).ready(function(){   
        
        $('.estilos-brazo').hide();
        $('.estilos-pierna').hide();
        verificarcheck();
        verificarcheck2();
        $('input[type="checkbox"]').change(function(){
            verificarcheck();
            if($(this).prop('checked')){
                $(this).val('1');
            }else{
                $(this).val('0');
            }
        });
        
        $('.compresion').change(function(){
            verificarcheck();
        });



        $('#sexo').change(function(){
            verificarcheck();
        });
    });

    function verificarcheck(){
        if($('#pierna').val() != ''){
            $('.estilos-pierna').show();
            if($('#sexo').val() == 'dama'){

                //circunferencia cadera 
                $('.circunferencia_cadera').show();
                $('#circunferencia_cadera').show();
                $('#circunferencia_cadera').val('');

                //peso
                $('.peso').show();
                $('#peso').show();
                $('#peso').val('');

                //estarura
                $('.estatura').show();
                $('#estatura').show();
                $('#estatura').val('');

            }else{
                //circunferencia cadera 
                $('.circunferencia_cadera').hide();
                $('#circunferencia_cadera').hide();
                $('#circunferencia_cadera').val('');

                //peso
                $('.peso').hide();
                $('#peso').hide();
                $('#peso').val('');

                //estarura
                $('.estatura').hide();
                $('#estatura').hide();
                $('#estatura').val('');
            }
        }else{
            $('.estilos-pierna').hide();
            $('input.cb-pierna-estilo').prop('checked', false);
            $('input.cb-pierna-estilo').val('false');
            $('input.medidas-pierna').val("");
        }

        if($('#brazo').val() != ''){
            $('.estilos-brazo').show();
        }else{
            $('.estilos-brazo').hide();
            $('input.cb-brazo-estilo').prop('checked', false);
            $('input.cb-brazo-estilo').val('false');
            $('input.medidas-brazo').val("");
        }

        
    }

    function verificarcheck2(){
        
    }
</script>
@endsection