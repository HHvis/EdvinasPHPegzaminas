@extends('layouts.app')

@section('content')
<!-- Knygu redagavimo puslapis -->
<div class="container">
  <div class="row py-4">
    <h1 class="text-dark">Knygos redagavimas</h1>
  </div>
  @if (session('knyga-status'))
  <div class="row py-4">
    <h6 class="alert alert-success">{{ session('knyga-status') }}</h6>
  </div>
  @endif
  <div class="row py-4">
    <div class="col-12" style="padding: 0;">
      <form class="tab-pane container" style="padding: 0;" id="pridetiknyga" action="{{url('atnaujinti-knyga/' . $kny->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label for="kategorijos-pavadinimas" class="form-label">Knygos pavadinimas</label>
          <input type="text" class="form-control" value="{{$kny->knygos_pavadinimas}}" name="kategorijos-pavadinimas" id="kategorijos-pavadinimas">
        </div>
        <div class="mb-3">
          <label for="kategorijos-kaina" class="form-label">Knygos kaina</label>
          <input type="number" step="0.01" class="form-control" value="{{$kny->knygos_kaina}}" name="kategorijos-kaina" id="kategorijos-kaina">
        </div>
        <div class="mb-3">
          <label for="kategorijos-aprasymas" class="form-label">Knygos aprašymas</label>
          <textarea class="form-control" rows="5" name="kategorijos-aprasymas" id="kategorijos-aprasymas">{{$kny->knygos_aprasymas}}</textarea>
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