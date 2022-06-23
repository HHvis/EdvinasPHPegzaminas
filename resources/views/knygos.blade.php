@extends('layouts.app')
@section('content')

<!-- Knygu sarasas -->
<div class="container">
    <div class="row p-4">
    <h5 class="text-center">Rezervuokite knygą</h5>
        @foreach($kny as $knyga)
        <div class="col-lg-3 col-sm-12 py-4">
            <div class="card h-100" style="width: 15rem;">
                <div class="card-body">
                    <h5 class="card-title">{{$knyga->knygos_pavadinimas}}</h5>
                    <p class="text-dark">{{$knyga->knygos_aprasymas}}</p>
                    <p class="text-center"><b>{{$knyga->knygos_kaina}} €</b></p>
                    @if (Auth::guest())
                    <div class="alert alert-danger" role="alert">
                        Tik registruoti vartotojai gali užsisakyti.
                    </div>
                    @else
                    <div class="form-outline">
                        <form class="tab-pane container" id="pirktiknyga" action="{{url('pirkti-knyga/' . $knyga->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="number" min="1" max="10" oninput="this.value = Math.abs(this.value) >= 1 ? Math.abs(this.value) : null" placeholder="Įveskite kiekį" name="kiekis" id="kiekis" class="form-control" require />
                            <div class="my-2 text-center"><button type="submit" class="btn btn-outline-success">Rezervuoti</button></div>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
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