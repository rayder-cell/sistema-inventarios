<?php

namespace App\Livewire\Admin\Compras;

use App\Models\Compra;
use App\Models\Lote;
use App\Models\Producto;
use App\Models\DetalleCompra;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ItemsCompra extends Component
{

    public Compra $compra;

    public $productoId;
    public $cantidad = 1;

    public $precioUnitario;
    public $precioCompra;
    public $precioVenta;

    public $fechaVencimiento;
    public $codigoLote;

    public $productos;
    public $totalCompra;

    // este metodo se ejecuta al iniciar el componente
    public function mount(Compra $compra)
    {
        $this->compra = $compra;
        $this->productos = Producto::all();
        $this->cargarDatos();
    }

    public function cargarDatos()
    {
        $this->compra->load('detalles.producto', 'detalles.lote');
        $this->totalCompra = $this->compra->detalles->sum('subtotal');

        // reiniciar los campos del formulario
        $this->reset(['productoId', 'cantidad', 'precioCompra', 'precioVenta', 'precioUnitario', 'fechaVencimiento', 'codigoLote']);
        $this->cantidad = 1;
    }

    protected $rules = [
        'productoId' => 'required',
        'cantidad' => 'required',
        'precioCompra' => 'required',
        'precioVenta' => 'required',
        'codigoLote' => 'required',
        'fechaVencimiento' => 'required',
    ];

    public function updatedproductoId($value){
        $producto = Producto::find($value);
        if($producto){
            $this->precioCompra = $producto->precio_compra;
            $this->precioVenta = $producto->precio_venta;
        }
        else{
            $this->validate(['precioCompra','precioVenta']);
        }
    }

    public function agregarItems()
    {
        //dd('Entrando a la funcion');
        $this->validate();

        DB::beginTransaction();

        try {

            $producto = Producto::find($this->productoId);
            $lote = null;
            // creacion del lote
            $lote = Lote::create([
                'producto_id' => $producto->id,
                'proveedor_id' => $this->compra->proveedor->id,
                'codigo_lote' => $this->codigoLote,
                'fecha_entrada' => now()->toDateString(),
                'fecha_vencimiento' => $this->fechaVencimiento,
                'cantidad_inicial' => 0, // se actualiza luego
                'cantidad_actual' => 0, // se actualiza luego
                'precio_compra' => $this->precioCompra,
                'precio_venta' => $this->precioVenta,
                'estado' => true,
            ]);
            $loteId = $lote->id;

            // creacion del detalle de compra
            $this->compra->detalles()->create([
                'producto_id' => $producto->id,
                'lote_id' => $loteId,
                'cantidad' => $this->cantidad,
                'precio_unitario' => $this->precioCompra,
                'subtotal' => $this->cantidad * $this->precioUnitario,
            ]);
            // recalcular el total de la compra y lo guardamos
            $this->compra->total = $this->compra->detalles->sum('subtotal');
            $this->compra->save();

            DB::commit();

            $this->cargarDatos();

            $this->dispatch(
                'mostrar-alerta',
                icono: 'success',
                mensaje: 'Producto agregado exitosamente'
            );
        } catch (\Exception $e) {
            DB::rollBack();
            dd('Error al añadir el producto, ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.compras.items-compra');
    }
    
    public function borrarItem($detalleId)
    {
        DB::beginTransaction();

        try {
            //busca item del producto
            $detalle =  DetalleCompra::find($detalleId);

            // borrar el lote del detalle del producto
            $lote_id = $detalle->lote_id;
            $lote = Lote::find($lote_id);
            $lote->delete();

            $detalle->delete();

            // recalcular el total de la compra y lo guardamos
            $this->compra->total = $this->compra->detalles->sum('subtotal');
            $this->compra->save();

            DB::commit();

            $this->cargarDatos();

            $this->dispatch(
                'mostrar-alerta',
                icono: 'success',
                mensaje: 'Producto eliminado exitosamente'
            );
            
        } catch (Exception $e) {
            DB::rollBack();
            dd('Error al eliminar el producto, ' . $e->getMessage());
        }

    }
}
