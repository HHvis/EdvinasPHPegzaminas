@extends('layouts.app')

@section('content')
<!-- Kategoriju redagavimo puslapis -->
<div class="container">
  <div class="row py-4">
    <h1 class="text-dark">Kategorijos redagavimas</h1>
  </div>
  @if (session('kategorija-status'))
  <div class="row py-4">
    <h6 class="alert alert-success">{{ session('kategorija-status') }}</h6>
  </div>
  @endif
  @if (session('kategorija-pavadinimas-failure'))
  <div class="row py-4">
    <h6 class="alert alert-danger">{{ session('kategorija-pavadinimas-failure') }}</h6>
  </div>
  @endif
  <div class="row py-4">
    <div class="col-12" style="padding: 0;">
      <form style="padding: 0;" class="tab-pane container active" id="pridetikategorija" action="{{ url('atnaujinti-kategorija/' . $kat->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label for="kategorija-pavadinimas" class="form-label">Kategorijos pavadinimas</label>
          <input type="text" class="form-control" name="kategorija-pavadinimas" value="{{$kat->pavadinimas}}" id="kategorija-pavadinimas">
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