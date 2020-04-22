@extends('layouts.master')
@section('title', 'Pointages')
@section('content')
    <style>
        .formulaire{
            margin-top: 2%;
            margin-bottom: 2%;
            margin-left: auto;
            margin-right: auto;
            border: 1px solid rgba(0, 0, 0, 0.2) !important;
            border-radius: 5px !important;
            background-color: whitesmoke;
            padding: 3%;
        }
    </style>

    <div class="formulaire">
        <div class="text-center mb-3">
            <h3>Mes pointages</h3>
            <hr class="mt-2 mb-2">
        </div>
        <table class="table table-bordered table-hover bg-white">
            <thead style="background-color: #ffecb3">
            <tr class="text-center">
                <td scope="col" style="width: 200px;">Semaine</td>
                <td scope="col">Debut</td>
                <td scope="col">Fin</td>
                <td scope="col" style="width: 115px;">Détails</td>
            </tr>
            </thead>
                @foreach($pointages as $pointage)
                    <tr class="text-center">
                        <td>{{$pointage->semaine}}</td>
                        <td>{{$pointage->debut}}</td>
                        <td>{{$pointage->fin}}</td>
                        <td>
                            <a href="{{route('pointages.show', $pointage->id)}}" style="text-decoration: underline;">
                                CLIQUEZ ICI
                            </a>
                        </td>
                    </tr>
                @endforeach
        </table>

        <div class="row" style="display: block; margin: auto; margin-bottom: 3%; text-align: center;">
            <a href="{{route('pointages.create')}}">
                <button class="btn btn-success" type="button" style="display: inline; color: whitesmoke; text-decoration: none;">
                    Nouveau pointage
                </button>
            </a>
            <a href="{{route('/')}}">
                <button class="btn btn-info" type="button" style="display: inline; color: whitesmoke; text-decoration: none;">
                    Accueil
                </button>
            </a>
        </div>
    </div>

@endsection
