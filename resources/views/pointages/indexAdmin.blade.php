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
    <div class="mt-5 formulaire">
        <div class="text-center mb-3">
            <h3>Les pointages</h3>
            <hr class="mt-2 mb-2">
        </div>
        @if(!empty($pointages))
            <fieldset>
                <div class="form-group">
                    <form action="{{route('indexAdmin')}}" method="get" class="form-inline my-2 my-lg-0">
                        <select class="custom-select" name="cat" style="width: 200px;">
                            <option value="All" @if($cat == 'All') selected @endif>Tous...</option>
                            @foreach($users as $user)
                                <option value="{{$user}}"  @if($cat == $user) selected @endif>{{$user}}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary my-2 my-sm-0" style="margin-left: 20px;">OK</button>
                    </form>
                </div>
            </fieldset>

            <table class="table table-bordered table-hover bg-white">
                <thead style="background-color: #ffecb3">
                <tr>
                    <td scope="col">Employé</td>
                    <td scope="col" style="width: 200px;">Semaine</td>
                    <td scope="col">Debut</td>
                    <td scope="col">Fin</td>
                    <td scope="col" style="width: 115px;">Détails</td>
                </tr>
                </thead>
                @foreach($pointages as $pointage)
                    <tr>
                        <td>{{$pointage->user_name}}</td>
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

        @else
            Aucun pointage pour le moment..
        @endif
    </div>

@endsection
