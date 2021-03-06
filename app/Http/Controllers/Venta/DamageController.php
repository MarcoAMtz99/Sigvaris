<?php

namespace App\Http\Controllers\Venta;

use App\Producto;
use App\Venta;
use App\Doctor;
use App\Empleado;
use App\Folio;
use App\HistorialCambioVenta;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProductoDamage;

use App\Services\Damage\AnadirProductoAlAmacenDamageService;

class DamageController extends Controller
{
    //

    public function index($id)
    {
        $venta = Venta::where('id', $id)->first();
        $productos = $venta->productos;
        return view('venta.damage.index', ['productos' => $productos, 'venta' => $venta]);
    }

    public function SerchProductoExit(Request $request)
    {
        $Producto = Producto::where('sku', $request->input('sku'))->get();;
        if (count($Producto) == 1) {
            $Datos = array('Ex' => 1, 'Producto' => $Producto[0]);
            return $Datos;
        } else {
            $Datos = array('Ex' => 0);
            return $Datos;
        }
    }
    public function Devolucion_Damage(Request $request)
    {
            // dd($request);
        /*
        $venta = Venta::find($request->id_venta);
        $producto = Producto::where("sku", $request->input("sku"))->first();

        //$anadirProductoAlAlmacenDamageService = new AnadirProductoAlAmacenDamageService($producto, $request->tipo);
        //$anadirProductoAlAlmacenDamageService->execute();
        $productoQueSeraEntregado = Producto::where('sku', $request->input("skuProductoEntregado"))->first();

        $HistorialCambioVenta = new HistorialCambioVenta(
            array(
                'tipo_cambio' => "Damage",
                'responsable_id' => Auth::user()->id,
                'venta_id' => $venta->id,
                'observaciones' => '',
                'producto_devuelto_id' => $producto->id,
                'producto_entregado_id' => $productoQueSeraEntregado->id
            )
        );


        $productosDamage = new ProductoDamage;
        $productosDamage->producto_id = $producto->id;
        $productosDamage->tipo_damage = $request->tipo;
        $productosDamage->user_id = Auth::user()->id;
        $productosDamage->descripcion = $request->descripcion;
        $productosDamage->save();

        if ($request->input("diferenciaPrecios")==0) {
            $saldo=$productoQueSeraEntregado->precio_publico_iva;
        }else{
            if ($request->input("diferenciaPrecios")<0) {
                $saldo=$request->input("diferenciaPrecios")-($request->input("diferenciaPrecios")*0.16);
                $saldo=round($saldo)+$productoQueSeraEntregado->precio_publico_iva;
            }else{
                $saldo=$request->input("diferenciaPrecios")+($request->input("diferenciaPrecios")*0.16);
                $saldo=round($saldo)+$productoQueSeraEntregado->precio_publico_iva;
            }
        }

        
       

        $venta->paciente->saldo_a_favor += $saldo;
        $venta->paciente->save();

        

        //$producto->update(['stock' => $producto->stock - 1]);

        $HistorialCambioVenta->save();

        $venta->productos()->detach($producto->id);

        $medicos = Doctor::get();
        $ventas = Venta::orderBy('fecha', 'desct')->paginate(5);
        return redirect()->route('ventas.index');
        */




            $Nuevo_pago = 0;
            $auxiliar =0;
        $venta = Venta::find($request->id_venta);
        $producto = Producto::where("sku", $request->input("sku"))->where("oficina_id",session('oficina'))->first();
        $productoQueSeraEntregado = Producto::where('sku', $request->input("skuProductoEntregado"))->where("oficina_id",session('oficina'))->first();
        $empleadosFitter = Empleado::fitters()->get();
        $TipoDamage =$request->tipo;
        $DesDamage =$request->descripcion;

        if ($request->diferenciaPrecios==0) {
            // $saldo=$productoQueSeraEntregado->precio_publico_iva;
           
               $saldo_paciente=$venta->paciente->saldo_a_favor;
             $saldoA = $saldo_paciente;
            $saldo = 0;
           
        }else{
                $saldo=$request->diferenciaPrecios;
                $saldo_paciente=$venta->paciente->saldo_a_favor;
                if ($saldo>0) {
                    # code...
                    $saldoA = $saldo_paciente;
                }else{

                 $saldoA = $saldo_paciente + $saldo;
                }
            // $saldo=round($saldo)+$productoQueSeraEntregado->precio_publico_iva;
    
            if ($saldo>0) {
                 $Nuevo_pago=$saldo; 
                 $auxiliar = $Nuevo_pago;
             } else{
                 $saldoA = $saldo_paciente+abs($saldo);
                 $auxiliar = 0;
                  $saldo=$request->input("diferenciaPrecios");
                     $saldo+=$saldo_paciente;
             }
             
                     
        }
        $sigpesos_paciente=$venta->paciente->sigpesos_a_favor;
        // dd($auxiliar);
        return view('venta.damage.create',['producto'=>$productoQueSeraEntregado,
                                           'productoDebuelto'=>$producto,
                                           'ventaAnterior'=>$venta,
                                           'paciente'=>$venta->paciente,
                                           'saldo'=>$saldo,
                                           'folio' => Venta::count() + 1,
                                           'empleadosFitter' => $empleadosFitter,
                                           'Folios' => Folio::get(),
                                           'TipoDamage'=>$TipoDamage,
                                           'DesDamage'=>$DesDamage,
                                           'VentaA'=>$venta->id,
                                           'Nuevo_pago' =>$Nuevo_pago,
                                           'Diferencia'=>$auxiliar,
                                           'SaldoA'=>$saldoA,
                                           'precioOri' =>$request->precioOri,
                                           'precioNew'=>$request->precioNew,
                                           'sigpesos_a_favor'=>$sigpesos_paciente
                                       ]);
    }


}
