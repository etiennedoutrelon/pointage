@extends('layouts.master')
@section('title', 'Mon compte')
@section('content')
    <style>
        body{
            background-image: url({{asset("storage/img/light.jpg")}});
        }
    </style>
    <div class="container col-md-8" style="margin-top: 5%;">
        <!-- Material form register -->
        <div class="card" style="transform: none; opacity: 1;">

            <h5 class="card-header blue-gradient white-text text-center py-4 font-weight-bold">
                <strong>Mon compte</strong>
            </h5>

            <div class="card-body card-body-cascade text-center mb-5">
                @if($user->avatar != null)
                    <div class="avatar mx-auto white mb-3">
                        <img src="{{url(Auth::user()->avatar)}}" class="img-fluid mt-3" alt="Responsive image" style="max-height: 200px;">
                    </div>
                @endif
                <h4>Nom : <span class="text-info">{{Auth::user()->name}}</span></h4>
                <h4>E-mail : <span class="text-info">{{Auth::user()->email}}</span></h4>
                <a href="{{route('compte.editer')}}">
                    <button class="btn btn-primary mt-3">Editer votre profil</button>
                </a>
            </div>
        </div>
    </div>

@endsection
