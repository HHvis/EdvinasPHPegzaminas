@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row py-4">
    <h1 class="text-dark">Meniu redagavimas</h1>
  </div>
  @if (session('meniu-status'))
  <div class="row py-4">
    <h6 class="alert alert-success">{{ session('meniu-status') }}</h6>
  </div>
  @endif
  @if (session('meniu-pavadinimas-failure'))
  <div class="row py-4">
    <h6 class="alert alert-danger">{{ session('meniu-pavadinimas-failure') }}</h6>
  </div>
  @endif
  <div class="row py-4">
    <div class="col-12" style="padding: 0;">
      <form style="padding: 0;" class="tab-pane container active" id="pridetimeniu" action="{{ url('atnaujinti-meniu/' . $men->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label for="meniu-pavadinimas" class="form-label">Meniu pavadinimas</label>
          <input type="text" class="form-control" name="meniu-pavadinimas" value="{{$men->pavadinimas}}" id="meniu-pavadinimas">
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