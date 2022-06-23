@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Paieska -->
    <div class="row">
        <div class="col-6">
        <h1 class="my-2 text-dark text-left">Praktinė egzamino dalis</h1>
        </div>
        <div class="my-2 col-md-4 offset-md-2">
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

    <!-- Knygynu sarasas -->
        <div class="col-12">
            <div class="row" id="istaiga">
                @foreach ($knygynas as $knygynasa)
                <div class="col-lg-4 col-md-4 col-sm-12 py-1 istaigos">
                    <a href="{{ url('/istaiga/' . $knygynasa->id) }}" class="btn">
                        <div class="card border-light mb-3" style="max-width: 18rem;">
                            <img src="{{asset('images/istaigos/' . $knygynasa->nuotrauka)}}" class="card-img-top" alt="nuotrauka" style="height:280px;width:100%">
                            <div class="card-header">{{ucwords($knygynasa->pavadinimas)}}</div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
</div>
<!-- Paieska -->
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