@extends('layouts.app')

@section('content')

<div class="container">
    @foreach($ist as $istaiga)
        <img src="{{asset('images/istaigos/' . $istaiga->nuotrauka)}}" height="300px" width="100%" style="object-fit:cover;" alt="istaigos_nuotrauka">
    @endforeach
    <div class="container">
        <div class="row p-4">
            @foreach($ist as $istaiga)
            <div class="col-12">
                <h2 class="text-dark">{{$istaiga->pavadinimas}}</h2>
                <h6 class="text-secondary">{{$istaiga->adresas}}</h6>
            </div>
            @endforeach
            @foreach($men as $meniu)
            <div class="col-lg-3 col-sm-12 py-4">
            <a href="{{ url('/meniu/' . $meniu->id) }}" class="btn">
                <div class="card" style="width: 15rem;">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{$meniu->pavadinimas}}</h5>
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