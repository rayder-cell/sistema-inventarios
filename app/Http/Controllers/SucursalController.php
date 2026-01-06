<?php

namespace App\Http\Controllers;

use App\Models\Sucursal;
use Illuminate\Http\Request;

class SucursalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sucursales = Sucursal::all();
        return view('admin.sucursales.index', compact('sucursales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.sucursales.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'required',
            'telefono' => 'required',
            'activo' => 'required|boolean',
        ]);

        $sucursal = new sucursal();
        $sucursal->nombre = $request->nombre;
        $sucursal->direccion = $request->direccion;
        $sucursal->telefono = $request->telefono;
        $sucursal->activo = $request->activo;
        $sucursal->save();

        return redirect()->route('sucursales.index')
        ->with('mensaje', 'sucursal creada exitosamente.')
        ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $sucursal = Sucursal::findOrFail($id);
        return view('admin.sucursales.show', compact('sucursal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $sucursal = Sucursal::findOrFail($id);
        return view('admin.sucursales.edit', compact('sucursal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'required',
            'telefono' => 'required',
            'activo' => 'required|boolean',
        ]);
        $sucursal = Sucursal::findOrFail($id);
        $sucursal->nombre = $request->nombre;
        $sucursal->direccion = $request->direccion;
        $sucursal->telefono = $request->telefono;
        $sucursal->activo = $request->activo;
        $sucursal->save();

        return redirect()->route('sucursales.index')
        ->with('mensaje', 'sucursal actualizada exitosamente')
        ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $sucursal = Sucursal::findOrFail($id);
        $sucursal -> delete();
        
        return redirect()->route('sucursales.index')
        ->with('mensaje', 'Sucursal eliminado exitosamente')
        ->with('icono', 'success');
    }
}
