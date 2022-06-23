@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Paieska -->
    <div class="row">
        <div class="my-2 col-md-4 offset-md-8">
            <div class="input-group">
                <input class="form-control border-end-0" id="ieskotiIstaigos" type="search" placeholder="Ieškoti">
                <span class="input-group-append">
                    <button class="btn btn-outline-dark border ms-n5" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </div>
    </div>
    <!-- Pagrindine nuotrauka -->
    <div class="row p-1">
        <div class="col-12">
            <img src="https://img-cdn.inc.com/image/upload/w_1920,h_1080,c_fill/images/panoramic/GettyImages-577674005_492115_zfpgiw.jpg" style="width: 100%; height: 250px; object-fit: cover;">
        </div>
    </div>
    <!-- Pasirinkimu sarasas -->
        <div class="col-12">
            <h2 class="text-dark text-center">Pasirinkiti iš geriausių</h2>
            <div class="row" id="istaiga">
                @foreach ($istaig as $istaiga)
                <div class="col-lg-3 col-md-3 col-sm-12 py-1 istaigos">
                    <a href="{{ url('/istaiga/' . $istaiga->id) }}" class="btn">
                        <div class="card border-light mb-3" style="max-width: 18rem;">
                            <img src="{{asset('images/istaigos/' . $istaiga->nuotrauka)}}" class="card-img-top" alt="nuotrauka">
                            <div class="card-header">{{ucwords($istaiga->pavadinimas)}}</div>
                            <div class="card-body" id="box1">
                                <h6 class="card-title">Adresas: {{$istaiga->adresas}}</h6>
                                <p class="card-text">Excerpt</p>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
</div>
<script>
    $(document).ready(function() {
        $("#ieskotiIstaigos").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#istaiga .istaigos").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>
@if (!Auth::guest() && Auth::user()->role == 'administratorius')
@php
header("Location: " . URL::to('/admin_dashboard'), true, 302);
exit();
@endphp
@endif

@endsection