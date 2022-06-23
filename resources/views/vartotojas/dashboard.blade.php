@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-sm-12 col 12 my-4">
            <div class="tab-content">
                <div class="tab-pane container active" id="manouzsakymai">
                    @if(count($uzsak) < 1) <div class="display-3 text-center text-dark my-4">Užsakymų neturite</div>
                <a href="/">
                    <div class="text-center">Pateikite savo pirmą užsakymą</div>
                </a>
                @else
                <h2 class="text-dark">Mano Užsakymai</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">Data</th>
                            <th class="text-center">Pavadinimas</th>
                            <th class="text-center">Kiekis</th>
                            <th class="text-center">Kaina</th>
                            <th class="text-center">Busena</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($uzsak as $uzsakymas)
                        <tr>
                            <td class="text-center">{{$uzsakymas->created_at}}</td>
                            <td class="text-center">{{\App\Models\patiekalas::find($uzsakymas->patiekalo_id)->patiekalo_pavadinimas}}</td>
                            <td class="text-center">{{$uzsakymas->kiekis}}</td>
                            <td class="text-center">{{\App\Models\patiekalas::find($uzsakymas->patiekalo_id)->patiekalo_kaina}}</td>
                            <td class="text-center">{{ucwords($uzsakymas->busena)}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
    </div>
    <a href="/">
        <div class="btn btn-outline-dark text-center">Grįžti į pagrindinį puslapį</div>
    </a>
</div>
</div>
@endsection