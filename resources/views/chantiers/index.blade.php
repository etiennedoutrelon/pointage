@extends('layouts.master')
@section('title', 'Chantiers')
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
            <h3>Les Chantiers</h3>
            <hr class="mt-2 mb-2">
        </div>
        @if(!empty($chantiers))
            <table class="table table-bordered bg-white" style="margin-left: auto; margin-right: auto; margin-top: 3%;">
                <thead style="background-color: #bbdefb">
                <tr>
                    <td colspan="2" style="text-align: center; font-size: larger; font-family: 'Trebuchet MS;',sans-serif">
                        Intitulé
                    </td>
                </tr>
                </thead>
                <tr>
                    <td>
                        @foreach ($chantiers as $chantier)
                            <span style="border: 1px solid rgba(0,0,0,0.1); border-radius: 5px; padding: 5px; margin: 5px; line-height: 50px;">{{$chantier->nom}}
                        <form action="{{route('chantiers.destroy', $chantier->id)}}" method="POST" style="display: inline !important;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" name="delete" value="valide" style="border: none; height: 2vh; color: rgba(255,47,56,0.71);"><i class="fas fa-times" style="float: right; color: rgba(255,47,56,0.71);"></i></button>
                        </form>
                    </span>
                        @endforeach
                    </td>
                </tr>
            </table>
        @else
            <h3>Aucun chantier répertorié</h3>
        @endif
        <div class="row" style="display: block; margin: auto; margin-bottom: 3%; text-align: center;">
            <a href="{{route('chantiers.create')}}" style="text-decoration: none;">
                <button class="btn btn-success" type="button" style="display: inline; color: whitesmoke; text-decoration: none;">
                    Nouveau
                </button>
            </a>
        </div>
    </div>
@endsection
