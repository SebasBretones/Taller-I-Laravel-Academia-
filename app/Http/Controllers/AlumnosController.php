<?php

namespace App\Http\Controllers;

use App\Models\Alumnos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlumnosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $alumnos = Alumnos::orderBy('id')->paginate(5);
        return view('alumnos.index', compact('alumnos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('alumnos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => ['required'],
            'apellidos' => ['required'],
            'email' => ['required', 'unique:alumnos,email'],
            'telefono' => ['nullable'],
        ]);

        $alumno = new Alumnos();
        $alumno->nombre = ucwords($request->nombre);
        $alumno->apellidos = ucwords($request->apellidos);
        $alumno->email = $request->email;
        $alumno->telefono = $request->telefono;

        if ($request->has('foto')) {
            $request->validate([
                'foto' => ['image'],
            ]);
            $file = $request->file('foto');
            $nom = 'foto/'.time().'_'.$file->getClientOriginalName();
            Storage::disk('public')->put($nom, \File::get($file));
            $alumno->foto = "img/$nom";
        }
        $alumno->save();

        return redirect()->route('alumnos.index')->with('mensaje', 'Alumno creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Alumnos  $alumnos
     * @return \Illuminate\Http\Response
     */
    public function show(Alumnos $alumnos)
    {
        return view('alumnos.detalles', compact('alumnos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Alumnos  $alumnos
     * @return \Illuminate\Http\Response
     */
    public function edit(Alumnos $alumnos)
    {
        return view('alumnos.edit', compact('alumnos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Alumnos  $alumnos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alumnos $alumnos)
    {
        $request->validate([
            'nombre' => ['required'],
            'apellidos' => ['required'],
            'email' => ['required', 'unique:alumnos,email'],
            'telefono' => ['nullable'],
        ]);

        if ($request->has('foto')) {
            $request->validate([
                'foto' => ['image'],
            ]);
            $file = $request->file('foto');
            $nombre = 'alumnos/'.time().'_'.$file->getClientOriginalName();
            Storage::disk('public')->put($nombre, \File::get($file));
            if (basename($nombre->foto) != 'default.png') {
                unlink($nombre->foto);
            }
            //ahora actualizo el alumno
            $alumnos->update($request->all());
            $alumnos->update(['foto' => "img/$nombre"]);
        } else {
            $alumnos->update($request->all());
        }

        return redirect()->route('alumnos.index')->with('mensaje', 'Alumno modificado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Alumnos  $alumnos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alumnos $alumnos)
        {
            $foto = $alumnos->foto;
            if (basename($foto) != 'default.png') {
                unlink($foto);
            }

            $alumnos->delete();

            return redirect()->route('alumnos.index')->with('mensaje', 'Alumno eliminado correctamente');
        }
}
