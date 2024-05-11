<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // dd(auth()->user());
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest('id')->get();
        return view('admin.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Agregar nuevo usuario";
        return view('admin.user_form', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'cargo' => 'required',
            'salario' => 'required|numeric',
            'email' => 'required|email|unique:user',
            'foto' => 'mimes:png,jpeg,jpg|max:2048',
            'password' => 'required',
        ]);

        $filePath = public_path('uploads');
        $insert = new User();
        $insert->nombre = $request->nombre;
        $insert->apellido = $request->apellido;
        $insert->cargo = $request->cargo;
        $insert->salario = $request->salario;
        $insert->email = $request->email;
        $insert->password = bcrypt($request->password);
        
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move($filePath, $fileName);
            $insert->foto = $fileName;
        }

        $result = $insert->save();
        Session::flash('success', 'Usuario agregado correctamente');
        return redirect()->route('admin.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = "Editar usuario";
        $edit = User::findOrFail($id);
        return view('admin.user_form', compact('title', 'edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'cargo' => 'required',
            'salario' => 'required|numeric',
            'email' => 'required|email|unique:user,email,' . $id,
            'foto' => 'mimes:png,jpeg,jpg|max:2048',
        ]);

        $update = User::findOrFail($id);
        $update->nombre = $request->nombre;
        $update->apellido = $request->apellido;
        $update->cargo = $request->cargo;
        $update->salario = $request->salario;
        $update->email = $request->email;

        if($request->hasFile('foto')) {
            $filePath = public_path('uploads');
            $file = $request->file('foto');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move($filePath, $fileName);
            // delete old photo
            if (!is_null($update->foto)) {
                $oldPhoto = public_path('uploads/' . $update->foto);
                if (File::exists($oldPhoto)) {
                    unlink($oldPhoto);
                }
            }
            $update->foto = $fileName;
        }

        $result = $update->save();
        Session::flash('success', 'Usuario actualizado correctamente');
        return redirect()->route('admin.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $userData = User::findOrFail($request->user_id);
        $userData->delete();
        // delete photo if exists
        if (!is_null($userData->foto)) {
            $foto = public_path('uploads/' . $userData->foto);
            if (File::exists($foto)) {
                unlink($foto);
            }
        }

        Session::flash('success', 'Usuario eliminado correctamente');
        return redirect()->route('admin.index');
    }
}
