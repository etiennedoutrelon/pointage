<?php

namespace App\Http\Controllers;

use App\Models\Chantier;
use Illuminate\Http\Request;

class ChantierController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chantiers = Chantier::all();
        return view('chantiers.index', ['chantiers' => $chantiers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('chantiers.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'nom' => ['required','max:255'],
            ]
        );
        $chantier = new Chantier();
        $chantier->nom = $request->nom;
        $chantier->save();
        return redirect(route('chantiers.index'))->with('success','Vous avez ajouté le chantier '.$request->nom.' !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Chantier  $chantier
     * @return \Illuminate\Http\Response
     */
    public function show(Chantier $chantier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Chantier  $chantier
     * @return \Illuminate\Http\Response
     */
    public function edit(Chantier $chantier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Chantier  $chantier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chantier $chantier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $personne
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->delete == 'valide') {
            $chantier = Chantier::findOrFail($id);
            $chantier->delete();
        }
        return redirect(route('chantiers.index'))->with('deleted', 'Chantier supprimé !');
    }
}
