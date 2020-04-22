<?php

namespace App\Http\Controllers;

use App\Models\Chantier;
use App\Models\Pointage;
use App\User;
use Cassandra\Time;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function foo\func;

class PointageController extends Controller
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
        $pointages = Pointage::where('user_id',Auth::user()->getAuthIdentifier())->get();
        return view('pointages.index',['pointages' => $pointages]);
    }

    public function indexAdmin(Request $request){
        $cat = $request->query('cat', 'All');
        if ($cat != 'All') {
            $pointages = DB::table('pointages')
                ->select('*')
                ->join('users','users.id','=','pointages.user_id')
                ->where('users.name','=',$cat)
                ->orderBy('pointages.id','desc')
                ->get();
        } else {
            $pointages = Pointage::orderBy('id', 'desc')->get();
        }
        $users = DB::table('users')->where('type','=','default')->pluck('name');
        return view('pointages.indexAdmin', ['pointages' => $pointages, 'cat' => $cat, 'users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $chantiers = Chantier::all();
        return view('pointages.create', ['chantiers' => $chantiers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {

        $this->validate(
            $request,
            [
                'semaine' => 'required',
                'debut' => 'required',
                'fin' => 'required',
            ]
        );

        $pointage = new Pointage;

        $pointage->user_id = Auth::user()->getAuthIdentifier();
        $pointage->user_name = Auth::user()->name;
        $pointage->semaine = $request->semaine;
        $pointage->debut = $request->debut;
        $pointage->fin = $request->fin;
        $pointage->chantier_lundi = $request->chantier_lundi;
        $pointage->chantier_mardi = $request->chantier_mardi;
        $pointage->chantier_mercredi = $request->chantier_mercredi;
        $pointage->chantier_jeudi = $request->chantier_jeudi;
        $pointage->chantier_vendredi = $request->chantier_vendredi;
        $pointage->arrivee_lundi = $request->arrivee_lundi;
        $pointage->arrivee_mardi = $request->arrivee_mardi;
        $pointage->arrivee_mercredi = $request->arrivee_mercredi;
        $pointage->arrivee_jeudi = $request->arrivee_jeudi;
        $pointage->arrivee_vendredi = $request->arrivee_vendredi;
        $pointage->totalHeure = $request->totalHeure;
        $pointage->depart_lundi = $request->depart_lundi;
        $pointage->depart_mardi = $request->depart_mardi;
        $pointage->depart_mercredi = $request->depart_mercredi;
        $pointage->depart_jeudi = $request->depart_jeudi;
        $pointage->depart_vendredi = $request->depart_vendredi;
        $pointage->repas_lundi = $request->repas_lundi;
        $pointage->repas_mardi = $request->repas_mardi;
        $pointage->repas_mercredi = $request->repas_mercredi;
        $pointage->repas_jeudi = $request->repas_jeudi;
        $pointage->repas_vendredi = $request->repas_vendredi;
        $pointage->trajet_lundi = $request->trajet_lundi;
        $pointage->trajet_mardi = $request->trajet_mardi;
        $pointage->trajet_mercredi = $request->trajet_mercredi;
        $pointage->trajet_jeudi = $request->trajet_jeudi;
        $pointage->trajet_vendredi = $request->trajet_vendredi;


        /* calcule automatique des heures de chaque jours : */
        $lundi = strtotime($pointage->depart_lundi)-strtotime($pointage->arrivee_lundi)-strtotime($pointage->repas_lundi);
        $lundi = date('H:i', $lundi);
        $mardi = strtotime($pointage->depart_mardi)-strtotime($pointage->arrivee_mardi)-strtotime($pointage->repas_mardi);
        $mardi = date('H:i', $mardi);
        $mercredi = strtotime($pointage->depart_mercredi)-strtotime($pointage->arrivee_mercredi)-strtotime($pointage->repas_mercredi);
        $mercredi = date('H:i', $mercredi);
        $jeudi = strtotime($pointage->depart_jeudi)-strtotime($pointage->arrivee_jeudi)-strtotime($pointage->repas_jeudi);
        $jeudi = date('H:i', $jeudi);
        $vendredi = strtotime($pointage->depart_vendredi)-strtotime($pointage->arrivee_vendredi)-strtotime($pointage->repas_vendredi);
        $vendredi = date('H:i', $vendredi);

        /* Enregistrement dans la BD : */
        $pointage->totalTravail_lundi = $lundi;
        $pointage->totalTravail_mardi = $mardi;
        $pointage->totalTravail_mercredi = $mercredi;
        $pointage->totalTravail_jeudi = $jeudi;
        $pointage->totalTravail_vendredi = $vendredi;

        function heure_to_secondes($heure){
            $array_heure=explode(":",$heure);
            $secondes=3600*(int)$array_heure[0]+60*(int)$array_heure[1];
            return $secondes;
        }

        function add_heures($heure1,$heure2,$heure3,$heure4,$heure5)
        {
            $secondes1 = heure_to_secondes($heure1);
            $secondes2 = heure_to_secondes($heure2);
            $secondes3 = heure_to_secondes($heure3);
            $secondes4 = heure_to_secondes($heure4);
            $secondes5 = heure_to_secondes($heure5);
            $somme = $secondes1 + $secondes2 + $secondes3 + $secondes4 + $secondes5;
            $s = $somme % 60; //reste de la division en minutes => secondes
            $m1 = ($somme - $s) / 60; //minutes totales
            $m = $m1 % 60; //reste de la division en heures => minutes
            $h = ($m1 - $m) / 60; //heures
            $resultat = $h . "H " . $m;
            return $resultat;
        }

        $pointage->totalHeure = add_heures($pointage->totalTravail_lundi,$pointage->totalTravail_mardi,$pointage->totalTravail_mercredi,$pointage->totalTravail_jeudi,$pointage->totalTravail_vendredi);


        $pointage->observation = $request->observation;

        $pointage->save();

        return redirect('/pointages')->with('success','Votre pointage de la semaine '.$pointage->semaine.' à été ajouté !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pointage  $pointage
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $action = $request->query('action', 'show');
        $pointage = Pointage::findOrFail($id);

        $now = time();
        $date2 = strtotime($pointage->created_at);
        function dateDiff($date1, $date2){
            $diff = abs($date1 - $date2); // abs pour avoir la valeur absolute, sans avoir une différence négative

            $tmp = $diff;
            $secondes = $tmp % 60;

            $tmp = floor( ($tmp - $secondes) /60 );
            $minutes = $tmp % 60;

            $tmp = floor( ($tmp - $minutes)/60 );
            $heures = $tmp % 24;

            $tmp = floor( ($tmp - $heures)  /24 );
            $jours = $tmp+1;

            return $jours;
        }
        $nbJours = dateDiff($now, $date2);
        $joursRestants = 35-$nbJours;

        //Pour affichage plus propre des heures de la jorunée :
        if ($pointage->totalTravail_lundi != null) {
            $array1 = explode(":", $pointage->totalTravail_lundi);
            if ($array1[1] != 0) {
                $H_lundi = (int)$array1[0] . "H " . (int)$array1[1];
            } else {
                $H_lundi = (int)$array1[0] . "H";
            }
        }else{
            $H_lundi = null;
        }

        if ($pointage->totalTravail_mardi != null) {
            $array2 = explode(":", $pointage->totalTravail_mardi);
            if ($array1[1] != 0) {
                $H_mardi = (int)$array2[0] . "H " . (int)$array2[1];
            } else {
                $H_mardi = (int)$array2[0] . "H";
            }
        }else{
            $H_mardi = null;
        }

        if ($pointage->totalTravail_mercredi != null) {
            $array3 = explode(":", $pointage->totalTravail_mercredi);
            if ($array1[1] != 0) {
                $H_mercredi = (int)$array3[0] . "H " . (int)$array3[1];
            } else {
                $H_mercredi = (int)$array3[0] . "H";
            }
        }else{
            $H_mercredi = null;
        }

        if ($pointage->totalTravail_jeudi != null) {
            $array4 = explode(":", $pointage->totalTravail_jeudi);
            if ($array1[1] != 0) {
                $H_jeudi = (int)$array4[0] . "H " . (int)$array4[1];
            } else {
                $H_jeudi = (int)$array4[0] . "H";
            }
        }else{
            $H_jeudi = null;
        }

        if ($pointage->totalTravail_vendredi != null) {
            $array5 = explode(":", $pointage->totalTravail_vendredi);
            if ($array1[1] != 0) {
                $H_vendredi = (int)$array5[0] . "H " . (int)$array5[1];
            } else {
                $H_vendredi = (int)$array5[0] . "H";
            }
        }else{
            $H_vendredi = null;
        }

        //Pour affichage plus propre des heures de repas :
        if ($pointage->repas_lundi != null){
            $array6 = explode(":",$pointage->repas_lundi);
            if($array6[0]==0 && $array6[1]!=0) {
                $R_lundi = (int)$array6[1]." min";
            } elseif ($array6[0]!=0 && $array6[1]!=0){
                $R_lundi = (int)$array6[0] . "H ".(int)$array6[1]." min";
            }elseif ($array6[0]!=0 && $array6[1]==0){
                $R_lundi = (int)$array6[0] . "H ";
            }else{
                $R_lundi = "Pas mangé";
            }
        }else{
            $R_lundi = null;
        }

        if ($pointage->repas_mardi != null) {
            $array7 = explode(":", $pointage->repas_mardi);
            if ($array7[0] == 0 && $array7[1] != 0) {
                $R_mardi = (int)$array7[1] . " min";
            } elseif ($array7[0] != 0 && $array7[1] != 0) {
                $R_mardi = (int)$array7[0] . "H " . (int)$array7[1] . " min";
            } elseif ($array7[0] != 0 && $array7[1] == 0) {
                $R_mardi = (int)$array7[0] . "H ";
            } else {
                $R_mardi = "Pas mangé";
            }
        }else{
            $R_mardi = null;
        }

        if ($pointage->repas_mercredi != null) {
            $array8 = explode(":",$pointage->repas_mercredi);
            if($array8[0]==0 && $array8[1]!=0) {
                $R_mercredi = (int)$array8[1]." min";
            } elseif ($array8[0]!=0 && $array8[1]!=0){
                $R_mercredi = (int)$array8[0] . "H ".(int)$array8[1]." min";
            }elseif ($array8[0]!=0 && $array8[1]==0){
                $R_mercredi = (int)$array8[0] . "H ";
            }else{
                $R_mercredi = "Pas mangé";
            }
        }else{
            $R_mercredi = null;
        }

        if ($pointage->repas_jeudi != null) {
            $array9 = explode(":",$pointage->repas_jeudi);
            if($array9[0]==0 && $array9[1]!=0) {
                $R_jeudi = (int)$array9[1]." min";
            } elseif ($array9[0]!=0 && $array9[1]!=0){
                $R_jeudi = (int)$array9[0] . "H ".(int)$array9[1]." min";
            }elseif ($array9[0]!=0 && $array9[1]==0){
                $R_jeudi = (int)$array9[0] . "H ";
            }else{
                $R_jeudi = "Pas mangé";
            }
        }else{
            $R_jeudi = null;
        }

        if ($pointage->repas_vendredi != null) {
            $array10 = explode(":",$pointage->repas_vendredi);
            if($array10[0]==0 && $array10[1]!=0) {
                $R_vendredi = (int)$array10[1]." min";
            } elseif ($array10[0]!=0 && $array10[1]!=0){
                $R_vendredi = (int)$array10[0] . "H ".(int)$array10[1]." min";
            }elseif ($array10[0]!=0 && $array10[1]==0){
                $R_vendredi = (int)$array10[0] . "H ";
            }else{
                $R_vendredi = "Pas mangé";
            }
        }else{
            $R_vendredi = null;
        }


        return view('pointages.show', ['pointage' => $pointage, 'action' => $action, 'nbJours' => $nbJours, 'joursRestants' => $joursRestants,
            'H_lundi' => $H_lundi, 'H_mardi' => $H_mardi, 'H_mercredi' => $H_mercredi, 'H_jeudi' => $H_jeudi, 'H_vendredi' => $H_vendredi,
            'R_lundi' => $R_lundi, 'R_mardi' => $R_mardi, 'R_mercredi' => $R_mercredi, 'R_jeudi' => $R_jeudi, 'R_vendredi' => $R_vendredi]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pointage  $pointage
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pointage = Pointage::findOrFail($id);
        $chantiers = Chantier::all();
        $lesChantiers = DB::table('chantiers')->pluck('nom')->toArray();

        //traitement lundi pour le selecteur du formulaire
        if(in_array($pointage->chantier_lundi,$lesChantiers)){
            $lundi='oui';
        }
        else{
            $lundi='non';
        }

        //traitement mardi pour le selecteur du formulaire
        if(in_array($pointage->chantier_mardi,$lesChantiers)){
            $mardi='oui';
        }
        else{
            $mardi='non';
        }

        //traitement mercredi pour le selecteur du formulaire
        if(in_array($pointage->chantier_mercredi,$lesChantiers)){
            $mercredi='oui';
        }
        else{
            $mercredi='non';
        }

        //traitement jeudi pour le selecteur du formulaire
        if(in_array($pointage->chantier_jeudi,$lesChantiers)){
            $jeudi='oui';
        }
        else{
            $jeudi='non';
        }

        //traitement vendredi pour le selecteur du formulaire
        if(in_array($pointage->chantier_vendredi,$lesChantiers)){
            $vendredi='oui';
        }
        else{
            $vendredi='non';
        }

        return view('pointages.edit', ['pointage' => $pointage, 'chantiers' => $chantiers, 'lundi' => $lundi, 'mardi' => $mardi, 'mercredi' => $mercredi, 'jeudi' => $jeudi, 'vendredi' => $vendredi]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Pointage $pointage
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $pointage = Pointage::find($id);


        $this->validate(
            $request,
            [
                'semaine' => 'required',
                'debut' => 'required',
                'fin' => 'required',
            ]
        );

        $pointage->semaine = $request->semaine;
        $pointage->debut = $request->debut;
        $pointage->fin = $request->fin;
        $pointage->chantier_lundi = $request->chantier_lundi;
        $pointage->chantier_mardi = $request->chantier_mardi;
        $pointage->chantier_mercredi = $request->chantier_mercredi;
        $pointage->chantier_jeudi = $request->chantier_jeudi;
        $pointage->chantier_vendredi = $request->chantier_vendredi;
        $pointage->arrivee_lundi = $request->arrivee_lundi;
        $pointage->arrivee_mardi = $request->arrivee_mardi;
        $pointage->arrivee_mercredi = $request->arrivee_mercredi;
        $pointage->arrivee_jeudi = $request->arrivee_jeudi;
        $pointage->arrivee_vendredi = $request->arrivee_vendredi;
        $pointage->totalHeure = $request->totalHeure;
        $pointage->depart_lundi = $request->depart_lundi;
        $pointage->depart_mardi = $request->depart_mardi;
        $pointage->depart_mercredi = $request->depart_mercredi;
        $pointage->depart_jeudi = $request->depart_jeudi;
        $pointage->depart_vendredi = $request->depart_vendredi;
        $pointage->repas_lundi = $request->repas_lundi;
        $pointage->repas_mardi = $request->repas_mardi;
        $pointage->repas_mercredi = $request->repas_mercredi;
        $pointage->repas_jeudi = $request->repas_jeudi;
        $pointage->repas_vendredi = $request->repas_vendredi;
        $pointage->trajet_lundi = $request->trajet_lundi;
        $pointage->trajet_mardi = $request->trajet_mardi;
        $pointage->trajet_mercredi = $request->trajet_mercredi;
        $pointage->trajet_jeudi = $request->trajet_jeudi;
        $pointage->trajet_vendredi = $request->trajet_vendredi;

        /* calcule automatique des heures de chaque jours : */
        $lundi = strtotime($pointage->depart_lundi)-strtotime($pointage->arrivee_lundi)-strtotime($pointage->repas_lundi);
        $lundi = date('H:i', $lundi);
        $mardi = strtotime($pointage->depart_mardi)-strtotime($pointage->arrivee_mardi)-strtotime($pointage->repas_mardi);
        $mardi = date('H:i', $mardi);
        $mercredi = strtotime($pointage->depart_mercredi)-strtotime($pointage->arrivee_mercredi)-strtotime($pointage->repas_mercredi);
        $mercredi = date('H:i', $mercredi);
        $jeudi = strtotime($pointage->depart_jeudi)-strtotime($pointage->arrivee_jeudi)-strtotime($pointage->repas_jeudi);
        $jeudi = date('H:i', $jeudi);
        $vendredi = strtotime($pointage->depart_vendredi)-strtotime($pointage->arrivee_vendredi)-strtotime($pointage->repas_vendredi);
        $vendredi = date('H:i', $vendredi);

        /* Enregistrement dans la BD : */
        $pointage->totalTravail_lundi = $lundi;
        $pointage->totalTravail_mardi = $mardi;
        $pointage->totalTravail_mercredi = $mercredi;
        $pointage->totalTravail_jeudi = $jeudi;
        $pointage->totalTravail_vendredi = $vendredi;

        function heure_to_secondes($heure){
            $array_heure=explode(":",$heure);
            $secondes=3600*(int)$array_heure[0]+60*(int)$array_heure[1];
            return $secondes;
        }

        function add_heures($heure1,$heure2,$heure3,$heure4,$heure5)
        {
            $secondes1 = heure_to_secondes($heure1);
            $secondes2 = heure_to_secondes($heure2);
            $secondes3 = heure_to_secondes($heure3);
            $secondes4 = heure_to_secondes($heure4);
            $secondes5 = heure_to_secondes($heure5);
            $somme = $secondes1 + $secondes2 + $secondes3 + $secondes4 + $secondes5;
            $s = $somme % 60; //reste de la division en minutes => secondes
            $m1 = ($somme - $s) / 60; //minutes totales
            $m = $m1 % 60; //reste de la division en heures => minutes
            $h = ($m1 - $m) / 60; //heures
            $resultat = $h . "H " . $m;
            return $resultat;
        }

        $pointage->totalHeure = add_heures($pointage->totalTravail_lundi,$pointage->totalTravail_mardi,$pointage->totalTravail_mercredi,$pointage->totalTravail_jeudi,$pointage->totalTravail_vendredi);

        $pointage->observation = $request->observation;

        $pointage->save();

        if(Auth::user()->isAdmin()){
            return redirect('/pointages/'.$pointage->id)->with('success','Pointage modifié avec succès !');
        }
        else{
            return redirect('/pointages/'.$pointage->id)->with('success','Votre pointage de la semaine '.$pointage->semaine.' à été modifié !');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->delete == 'valide') {
            $pointage = Pointage::find($id);
            $pointage->delete();
            return redirect('/pointages')->with('deleted','Votre pointage à bien été supprimé !');
        }
        else
            return redirect('/pointages/'.$id)->with('cancel','Suppression annulée !');
    }
}
