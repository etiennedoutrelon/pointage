@extends('layouts.master')
@section('title', "Semaine {$pointage->semaine}")
@section('content')

    <div class="text-center" style="margin-top: 2rem; margin-bottom: 20px;">
        @if($action == 'delete')
            <h2>Suppression du pointage de la semaine {{$pointage->semaine}}</h2>
        @else
            <div style="display: inline !important;">
                <h2>Pointage de la semaine {{$pointage->semaine}}</h2>
                <h5>(Du {{$pointage->debut}} au {{$pointage->fin}})</h5>
            </div>
        @endif
        <hr class="mt-2 mb-2">
    </div>
    <div class="card-deck" style="margin-bottom: 20px;">
        <div class="card border-secondary mb-3">
            <div class="card-header" style="text-align: center">Lundi</div>
            <div class="card-body text-secondary">
                @if($pointage->chantier_lundi != null)
                    <p class="card-text"><strong>Chantier : </strong>{{$pointage->chantier_lundi}}</p>
                    <p class="card-text"><strong>Arrivée : </strong>{{$pointage->arrivee_lundi}}</p>
                    <p class="card-text"><strong>Départ : </strong>{{$pointage->depart_lundi}}</p>
                    <p class="card-text"><strong>Repas : </strong>{{$R_lundi}}</p>
                    <p class="card-text"><strong>Heures Travaillées : </strong><span style="color: red"><br>{{$H_lundi}}</span></p>
                @else
                    <p>Jour non travaillé</p>
                @endif
            </div>
        </div>
        <div class="card border-secondary mb-3">
            <div class="card-header" style="text-align: center">Mardi</div>
            <div class="card-body text-secondary">
                @if($pointage->chantier_mardi != null)
                    <p class="card-text"><strong>Chantier : </strong>{{$pointage->chantier_mardi}}</p>
                    <p class="card-text"><strong>Arrivée : </strong>{{$pointage->arrivee_mardi}}</p>
                    <p class="card-text"><strong>Départ : </strong>{{$pointage->depart_mardi}}</p>
                    <p class="card-text"><strong>Repas : </strong>{{$R_mardi}}</p>
                    <p class="card-text"><strong>Heures Travaillées : </strong><span style="color: red"><br>{{$H_mardi}}</span></p>
                @else
                    <p>Jour non travaillé</p>
                @endif
            </div>
        </div>
        <div class="card border-secondary mb-3">
            <div class="card-header" style="text-align: center">Mercredi</div>
            <div class="card-body text-secondary">
                @if($pointage->chantier_mercredi != null)
                    <p class="card-text"><strong>Chantier : </strong>{{$pointage->chantier_mercredi}}</p>
                    <p class="card-text"><strong>Arrivée : </strong>{{$pointage->arrivee_mercredi}}</p>
                    <p class="card-text"><strong>Départ : </strong>{{$pointage->depart_mercredi}}</p>
                    <p class="card-text"><strong>Repas : </strong>{{$R_mercredi}}</p>
                    <p class="card-text"><strong>Heures Travaillées : </strong><span style="color: red"><br>{{$H_mercredi}}</span></p>
                @else
                    <p>Jour non travaillé</p>
                @endif
            </div>
        </div>
        <div class="card border-secondary mb-3">
            <div class="card-header" style="text-align: center">Jeudi</div>
            <div class="card-body text-secondary">
                @if($pointage->chantier_jeudi != null)
                    <p class="card-text"><strong>Chantier : </strong>{{$pointage->chantier_jeudi}}</p>
                    <p class="card-text"><strong>Arrivée : </strong>{{$pointage->arrivee_jeudi}}</p>
                    <p class="card-text"><strong>Départ : </strong>{{$pointage->depart_jeudi}}</p>
                    <p class="card-text"><strong>Repas : </strong>{{$R_jeudi}}</p>
                    <p class="card-text"><strong>Heures Travaillées : </strong><span style="color: red"><br>{{$H_jeudi}}</span></p>
                @else
                    <p>Jour non travaillé</p>
                @endif
            </div>
        </div>
        <div class="card border-secondary mb-3" >
            <div class="card-header" style="text-align: center">Vendredi</div>
            <div class="card-body text-secondary">
                @if($pointage->chantier_vendredi != null)
                    <p class="card-text"><strong>Chantier : </strong>{{$pointage->chantier_vendredi}}</p>
                    <p class="card-text"><strong>Arrivée : </strong>{{$pointage->arrivee_vendredi}}</p>
                    <p class="card-text"><strong>Départ : </strong>{{$pointage->depart_vendredi}}</p>
                    <p class="card-text"><strong>Repas : </strong>{{$R_vendredi}}</p>
                    <p class="card-text"><strong>Heures Travaillées : </strong><span style="color: red"><br>{{$H_vendredi}}</span></p>
                @else
                <p>Jour non travaillé</p>
                @endif
            </div>
        </div>
    </div>
    @if($pointage->observation !== null)
        <div class="row mb-4 mt-2">
            <div class="col-lg-2">
                <div class="card border-secondary">
                    <div class="card-header" style="text-align: center">Total semaine</div>
                    <div class="card-body text-secondary">
                        <p class="card-text text-center" style=" color: red">{{$pointage->totalHeure}}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-10">
                <div class="card border-secondary">
                    <div class="card-header" style="text-align: center">Obesrvation</div>
                    <div class="card-body text-secondary">
                        <p class="card-text text-center">{{$pointage->observation}}</p>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="row mb-4 mt-2">
            <div class="col-lg-2" style="margin-right: auto; margin-left: auto;">
                <div class="card border-secondary">
                    <div class="card-header" style="text-align: center">Total semaine</div>
                    <div class="card-body text-secondary">
                        <p class="card-text text-center">{{$pointage->totalHeure}}</p>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if($action == 'delete')
        <form action="{{route('pointages.destroy',$pointage->id)}}" method="POST">
            @csrf
            @method('DELETE')
            <div class="text-center">
                <h3>Etes-vous sûr de vouloir supprimer ce pointage ?</h3>
                <p>(Cette action est irréverssible)</p>
                <button class="btn btn-success" type="submit" name="delete" value="valide">Valider</button>
                <button class="btn btn-danger" type="submit" name="delete" value="annule">Annuler</button>
            </div>
        </form>
    @else
        <div style="text-align: center">
            @if(Auth::user()->isAdmin())
                <a href="{{route('indexAdmin')}}"><button class="btn btn-info">Retour</button></a>
                <a href="{{route('pointages.edit', $pointage->id)}}"><button class="btn btn-warning">Éditer</button></a>
            @else
                <a href="{{route('pointages.index')}}"><button class="btn btn-info">Retour</button></a>
                @if($nbJours<=35)
                    <a href="{{route('pointages.edit', $pointage->id)}}"><button class="btn btn-warning">Éditer</button></a>
                @endif
                <a href="{{route('pointages.show', $pointage->id)}}?action=delete"><button class="btn btn-danger">Supprimer</button></a>
                <p class="mt-2">⚠️ Vous avez 35 jours pour modifier votre pointage si besoin !<br>(Il vous reste : {{$joursRestants}} jours)</p>
            @endif
        </div>
    @endif
@endsection
