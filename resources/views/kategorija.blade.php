@extends('layouts.app')

@section('content')

<!-- Pagrindine nuotrauka -->
<div class="container-fluid">
    @foreach($ist as $knygynasa)
        <img src="{{asset('images/istaigos/' . $knygynasa->nuotrauka)}}" height="300px" width="100%" style="object-fit:cover;" alt="istaigos_nuotrauka">
    @endforeach
<!-- Kategoriju sarasas -->
    <div class="container">
        <div class="row p-4">
            @foreach($ist as $knygynasa)
            <div class="col-12">
                <h2 class="text-dark">{{$knygynasa->pavadinimas}}</h2>
                <h6 class="text-secondary">{{$knygynasa->adresas}}</h6>
            </div>
            @endforeach
            <h5 class="text-center">Pasirinkite knygos kategoriją</h5>
            @foreach($kat as $kategorija)
            <div class="col-lg-3 col-sm-12 py-4">
            <a href="{{ url('/kategorija/' . $kategorija->id) }}" class="btn">
                <div class="card" style="width: 15rem;">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{$kategorija->pavadinimas}}</h5>
                    </div>
                </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
    @if (!Auth::guest() && Auth::user()->role == 'administratorius')
    @php
    header("Location: " . URL::to('/admin_dashboard'), true, 302);
    exit();
    @endphp
    @endif

    @endsection