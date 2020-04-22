@extends('layouts.master')
@section('title', 'Nouveau pointage')
@section('content')
    <section class="form-simple">

        <!--Form with header-->
        <div class="card">

            <!--Header-->
            <div class="header pt-3 grey lighten-2">
                <div class="row d-flex justify-content-center">
                    <h3 class="deep-grey-text mt-3 mb-4 pb-1 mx-5"><i class="far fa-plus-square mr-2"></i>Nouveau pointage</h3>
                </div>
            </div>
            <!--Header-->

            <div class="card-body mx-4 mt-4">
                <form action="{{route('pointages.store')}}" method="POST">
                    {!! csrf_field() !!}
                    <p class="mb-5" aria-hidden="true">⚠️ Les champs avec <abbr>*</abbr> sont obligatoires.</p>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="semaine"><strong>Semaine : </strong><abbr aria-hidden="true">*</abbr></label>
                            <input type="number" class="form-control" name="semaine" id="semaine"
                                   value="{{ old('semaine') }}" placeholder="n°" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="debut"><strong>Debut : </strong><abbr aria-hidden="true">*</abbr></label>
                            <input type="date" class="form-control" name="debut" id="debut"
                                   value="{{ old('debut') }}"
                                   placeholder="aaaa-mm-jj" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="fin"><strong>Fin : </strong><abbr aria-hidden="true">*</abbr></label>
                            <input type="date" class="form-control" name="fin" id="fin"
                                   value="{{ old('fin') }}"
                                   placeholder="aaaa-mm-jj" required>
                        </div>
                    </div>
                    <div class="text-center" style="margin-top: 2rem">
                        <hr class="mt-4 mb-4">
                        <h3>Lundi</h3>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label><strong>Chantier : (séléctionner parmis la liste) </strong></label>
                            <select class="form-control" name="chantier_lundi" style="font-weight: bold;">
                                <option value="" selected>Choisir..</option>
                                @foreach($chantiers as $chantier)
                                    <option value="{{$chantier->nom}}" @if(!is_null(old('chantier_lundi')) && in_array($chantier->id, old('chantier_lundi'))) selected @endif>{{$chantier->nom}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="arrivee_lundi"><strong>Arrivée : </strong></label>
                            <input type="time" class="form-control" name="arrivee_lundi" id="arrivee_lundi"
                                   value="{{ old('arrivee_lundi') }}" placeholder="hh:mm">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="depart_lundi"><strong>Départ : </strong></label>
                            <input type="time" class="form-control" name="depart_lundi" id="depart_lundi"
                                   value="{{ old('depart_lundi') }}" placeholder="hh:mm">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="repas_lundi"><strong>Repas : </strong></label>
                            <input type="time" class="form-control" name="repas_lundi" id="repas_lundi"
                                   value="{{ old('repas_lundi') }}" placeholder="hh:mm">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="trajet_lundi"><strong>Trajet : (optionnel) </strong></label>
                            <input type="time" class="form-control" name="trajet_lundi" id="trajet_lundi"
                                   value="{{ old('trajet_lundi') }}" placeholder="hh:mm">
                        </div>
                    </div>
                    <!--
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label for="totalTravail_lundi"><strong>Heures travaillées : </strong></label>
                            <input type="text" class="form-control" name="totalTravail_lundi" id="totalTravail_lundi"
                                   placeholder="hh:mm">
                        </div>
                    </div>
                    -->
                    <div class="text-center" style="margin-top: 2rem">
                        <hr class="mt-4 mb-4">
                        <h3>Mardi</h3>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label><strong>Chantier : (séléctionner parmis la liste) </strong></label>
                            <select class="form-control" name="chantier_mardi" style="font-weight: bold;">
                                <option value="" selected>Choisir..</option>
                                @foreach($chantiers as $chantier)
                                    <option value="{{$chantier->nom}}" @if(!is_null(old('chantier_mardi')) && in_array($chantier->id, old('chantier_mardi'))) selected @endif>{{$chantier->nom}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="arrivee_mardi"><strong>Arrivée : </strong></label>
                            <input type="time" class="form-control" name="arrivee_mardi" id="arrivee_mardi"
                                   value="{{ old('arrivee_mardi') }}" placeholder="hh:mm">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="depart_mardi"><strong>Départ : </strong></label>
                            <input type="time" class="form-control" name="depart_mardi" id="depart_mardi"
                                   value="{{ old('depart_mardi') }}" placeholder="hh:mm">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="repas_mardi"><strong>Repas : </strong></label>
                            <input type="time" class="form-control" name="repas_mardi" id="repas_mardi"
                                   value="{{ old('repas_mardi') }}" placeholder="hh:mm">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="trajet_mardi"><strong>Trajet : (optionnel) </strong></label>
                            <input type="time" class="form-control" name="trajet_mardi" id="trajet_mardi"
                                   value="{{ old('trajet_mardi') }}" placeholder="hh:mm">
                        </div>
                    </div>
                    <!--
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label for="totalTravail_mardi"><strong>Heures travaillées : </strong></label>
                            <input type="text" class="form-control" name="totalTravail_mardi" id="totalTravail_mardi"
                                   placeholder="hh:mm">
                        </div>
                    </div>
                    -->
                    <div class="text-center" style="margin-top: 2rem">
                        <hr class="mt-4 mb-4">
                        <h3>Mercredi</h3>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label><strong>Chantier : (séléctionner parmis la liste) </strong></label>
                            <select class="form-control" name="chantier_mercredi" style="font-weight: bold;">
                                <option value=""  selected>Choisir..</option>
                                @foreach($chantiers as $chantier)
                                    <option value="{{$chantier->nom}}" @if(!is_null(old('chantier_mercredi')) && in_array($chantier->id, old('chantier_mercredi'))) selected @endif>{{$chantier->nom}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="arrivee_mercredi"><strong>Arrivée : </strong></label>
                            <input type="time" class="form-control" name="arrivee_mercredi" id="arrivee_mercredi"
                                   value="{{ old('arrivee_mercredi') }}" placeholder="hh:mm">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="depart_mercredi"><strong>Départ : </strong></label>
                            <input type="time" class="form-control" name="depart_mercredi" id="depart_mercredi"
                                   value="{{ old('depart_mercredi') }}" placeholder="hh:mm">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="repas_mercredi"><strong>Repas : </strong></label>
                            <input type="time" class="form-control" name="repas_mercredi" id="repas_mercredi"
                                   value="{{ old('repas_mercredi') }}" placeholder="hh:mm">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="trajet_mercredi"><strong>Trajet : (optionnel) </strong></label>
                            <input type="time" class="form-control" name="trajet_mercredi" id="trajet_mercredi"
                                   value="{{ old('trajet_mercredi') }}" placeholder="hh:mm">
                        </div>
                    </div>
                    <!--
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label for="totalTravail_mercredi"><strong>Heures travaillées : </strong></label>
                            <input type="text" class="form-control" name="totalTravail_mercredi" id="totalTravail_mercredi"
                                   placeholder="hh:mm">
                        </div>
                    </div>
                    -->
                    <div class="text-center" style="margin-top: 2rem">
                        <hr class="mt-4 mb-4">
                        <h3>Jeudi</h3>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label><strong>Chantier : (séléctionner parmis la liste) </strong></label>
                            <select class="form-control" name="chantier_jeudi" style="font-weight: bold;">
                                <option value="" selected>Choisir..</option>
                                @foreach($chantiers as $chantier)
                                    <option value="{{$chantier->nom}}" @if(!is_null(old('chantier_jeudi')) && in_array($chantier->id, old('chantier_jeudi'))) selected @endif>{{$chantier->nom}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="arrivee_jeudi"><strong>Arrivée : </strong></label>
                            <input type="time" class="form-control" name="arrivee_jeudi" id="arrivee_jeudi"
                                   value="{{ old('arrivee_jeudi') }}" placeholder="hh:mm">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="depart_jeudi"><strong>Départ : </strong></label>
                            <input type="time" class="form-control" name="depart_jeudi" id="depart_jeudi"
                                   value="{{ old('depart_jeudi') }}" placeholder="hh:mm">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="repas_jeudi"><strong>Repas : </strong></label>
                            <input type="time" class="form-control" name="repas_jeudi" id="repas_jeudi"
                                   value="{{ old('repas_jeudi') }}" placeholder="hh:mm">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="trajet_jeudi"><strong>Trajet : (optionnel) </strong></label>
                            <input type="time" class="form-control" name="trajet_jeudi" id="trajet_jeudi"
                                   value="{{ old('trajet_jeudi') }}" placeholder="hh:mm">
                        </div>
                    </div>
                    <!--
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label for="totalTravail_jeudi"><strong>Heures travaillées : </strong></label>
                            <input type="text" class="form-control" name="totalTravail_jeudi" id="totalTravail_jeudi"
                                   placeholder="hh:mm">
                        </div>
                    </div>
                    -->
                    <div class="text-center" style="margin-top: 2rem">
                        <hr class="mt-4 mb-4">
                        <h3>Vendredi</h3>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label><strong>Chantier : (séléctionner parmis la liste)</strong></label>
                            <select class="form-control" name="chantier_vendredi" style="font-weight: bold;">
                                <option value="" selected>Choisir..</option>
                                @foreach($chantiers as $chantier)
                                    <option value="{{$chantier->nom}}" @if(!is_null(old('chantier_vendredi')) && in_array($chantier->id, old('chantier_vendredi'))) selected @endif>{{$chantier->nom}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="arrivee_vendredi"><strong>Arrivée : </strong></label>
                            <input type="time" class="form-control" name="arrivee_vendredi" id="arrivee_vendredi"
                                   value="{{ old('arrivee_vendredi') }}" placeholder="hh:mm">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="depart_vendredi"><strong>Départ : </strong></label>
                            <input type="time" class="form-control" name="depart_vendredi" id="depart_vendredi"
                                   value="{{ old('depart_vendredi') }}" placeholder="hh:mm">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="repas_vendredi"><strong>Repas : </strong></label>
                            <input type="time" class="form-control" name="repas_vendredi" id="repas_vendredi"
                                   value="{{ old('repas_vendredi') }}" placeholder="hh:mm">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="trajet_vendredi"><strong>Trajet : (optionnel) </strong></label>
                            <input type="time" class="form-control" name="trajet_vendredi" id="trajet_vendredi"
                                   value="{{ old('trajet_vendredi') }}" placeholder="hh:mm">
                        </div>
                    </div>
                    <!--
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label for="totalTravail_vendredi"><strong>Heures travaillées : </strong></label>
                            <input type="text" class="form-control" name="totalTravail_vendredi" id="totalTravail_vendredi"
                                   placeholder="hh:mm">
                        </div>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="totalHeure"><strong>Total heure : </strong></label>
                        <input type="text" class="form-control" name="totalHeure" id="totalHeure"
                               placeholder="hh:mm">
                    </div>
                    -->

                    <hr class="mt-4 mb-4">
                    <div class="form-group">
                        <label for="observation"><strong>Observation :</strong></label>
                        <textarea name="observation" class="form-control" id="observation" rows="3"
                                  placeholder="Observation..">{{ old('observation') }}</textarea>
                    </div>
                    <div class="row" style="display: block; margin: auto; text-align: center;">
                        <button class="btn btn-success" type="submit" style="display: inline; color: whitesmoke; text-decoration: none;">
                            Valider
                        </button>
                        <a href="{{route('pointages.index')}}">
                            <button class="btn btn-danger" type="button" style="display: inline; color: whitesmoke; text-decoration: none;">
                                Annuler
                            </button>
                        </a>
                    </div>
                </form>

            </div>

        </div>
        <!--/Form with header-->

    </section>


    @if ($errors->any())
        <div style="border-radius: 2px; background-color: whitesmoke; color: rgba(0, 0, 0, 0.5); width: 40%; margin: auto; margin-bottom: 3%; border-radius: 8px; box-shadow: 1px 3px 7px rgba(0, 0, 0, 0.3);">
            <div style="color: rgba(255, 255, 255, 1); background-color: rgba(248, 43, 13, 0.7); width: 100%; font-size: 50px; height: 70px; text-align: center; border-top-right-radius: 8px; border-top-left-radius: 8px; ">
                <i class="fas fa-exclamation-triangle" style="padding: 8px;"></i>
            </div>
            <div style="padding: 2%;">
                <span style="text-align: center; color: rgba(248, 43, 13, 0.7); font-weight: bold;">Les erreurs suivantes doivent être corrigées...</span>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

@endsection
