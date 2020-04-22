@extends('layouts.master')
@section('title', 'Employés')
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
            <h3>Les employés</h3>
            <hr class="mt-2 mb-2">
        </div>
        <div class="table-responsive text-center table-hover bg-white">
            <table class="table">
                <thead style="background-color: #b9f6ca">
                <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">E-Mail</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    @foreach($employes as $employe)
                        <td>{{$employe->name}}</td>
                        <td>{{$employe->email}}</td>
                    @endforeach
                </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection
