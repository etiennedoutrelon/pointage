@extends('layouts.master')
@section('title', 'Bienvenu')
@section('content')
    <style>
        body{
            background-image: url({{asset("storage/img/light.jpg")}});
        }
    </style>

    <div class="view">

        <div class=" align-items-center">

            <div class="container">

                <div class="row">

                    <div class="col-md-12 white-text text-center">
                        <h1 class="welcome white-text text-uppercase font-weight-bold mb-0 pt-md-5 pt-5 wow fadeInDown" data-wow-delay="0.4s"><strong>Bienvenu {{Auth::user()->name}} !</strong></h1>

                        <hr class="hr-light my-4 wow fadeInDown" data-wow-delay="0.4s">
                        <h5 class="text-uppercase mb-4 white-text wow fadeInDown" data-wow-delay="0.6s"><strong>Application de pointage</strong></h5>
                        @if(Auth::user()->isAdmin())
                            <a class="btn btn-outline-white wow fadeInDown" data-wow-delay="0.8s" href="{{route('indexAdmin')}}" style="font-size: medium">Les pointages</a>
                        @else
                            <a class="btn btn-outline-white wow fadeInDown" data-wow-delay="0.8s" href="{{route('pointages.index')}}" style="font-size: medium">Mes pointages</a>
                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
