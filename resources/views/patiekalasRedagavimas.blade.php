@extends('layouts.app')

@section('content')
<div class="container">

  <div class="row py-4">
    <h1 class="text-dark">Patiekalo redagavimas</h1>
  </div>

  @if (session('patiekalas-status'))
  <div class="row py-4">
    <h6 class="alert alert-success">{{ session('patiekalas-status') }}</h6>
  </div>
  @endif

  @if (session('patiekalo-pavadinimas-failure'))
  <div class="row py-4">
    <h6 class="alert alert-danger">{{ session('patiekalo-pavadinimas-failure') }}</h6>
  </div>
  @endif

  @if (session('patiekalo-kaina-failure'))
  <div class="row py-4">
    <h6 class="alert alert-danger">{{ session('patiekalo-kaina-failure') }}</h6>
  </div>
  @endif

  @if (session('patiekalo-aprasymas-failure'))
  <div class="row py-4">
    <h6 class="alert alert-danger">{{ session('patiekalo-aprasymas-failure') }}</h6>
  </div>
  @endif




  <div class="row py-4">


    <div class="col-12" style="padding: 0;">




      <form class="tab-pane container" style="padding: 0;" id="pridetipatiekala" action="{{url('atnaujinti-patiekala/' . $pat->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label for="patiekalo-pavadinimas" class="form-label">Patiekalo pavadinimas</label>
          <input type="text" class="form-control" value="{{$pat->patiekalo_pavadinimas}}" name="patiekalo-pavadinimas" id="patiekalo-pavadinimas">
        </div>
        <div class="mb-3">
          <label for="patiekalo-kaina" class="form-label">Patiekalo kaina</label>
          <input type="number" step="0.01" class="form-control" value="{{$pat->patiekalo_kaina}}" name="patiekalo-kaina" id="patiekalo-kaina">
        </div>
        <div class="mb-3">
          <label for="patiekalo-aprasymas" class="form-label">Patiekalo aprašymas</label>
          <textarea class="form-control" rows="5" name="patiekalo-aprasymas" id="patiekalo-aprasymas">{{$pat->patiekalo_aprasymas}}</textarea>
        </div>
        <div class="w-100">
          <button type="submit" class="btn btn-outline-success float-end">Atnaujinti</button>
          <a href="/"><button type="button" class="btn btn-outline-dark float-end mx-1">Grįžti</button> </a>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
</div>
</div>
@endsection