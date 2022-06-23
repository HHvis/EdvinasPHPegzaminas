@extends('layouts.app')

@section('content')
<!-- Knygyno redagavimo puslapis -->
<div class="container">
  <div class="row py-4">
    <h1 class="text-dark">Knygyno redagavimas</h1>
  </div>
  @if (session('status'))
  <div class="row py-4">
    <h6 class="alert alert-success">{{ session('status') }}</h6>
  </div>
  @endif
  @if (session('photo-failure'))
  <div class="row py-4">
    <h6 class="alert alert-danger">{{ session('photo-failure') }}</h6>
  </div>
  @endif
  <div class="row py-4">
    <div class="col-12" style="padding: 0;">
      <form style="padding: 0;" class="tab-pane container active" id="pridetiknygynoistaiga" action="{{url('atnaujinti-istaiga/' . $ist->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label for="pavadinimas" class="form-label">Knygyno pavadinimas</label>
          <input type="text" class="form-control" name="pavadinimas" value="{{$ist->pavadinimas}}" id="pavadinimas">
        </div>
        <div class="mb-3">
          <label for="kodas" class="form-label">Knygyno kodas</label>
          <input type="text" class="form-control" name="kodas" value="{{$ist->kodas}}" id="kodas">
        </div>
        <div class="mb-3">
          <label for="adresas" class="form-label">Knygyno adresas</label>
          <input type="text" class="form-control" name="adresas" value="{{$ist->adresas}}" id="adresas">
        </div>
        <div class="mb-3">
          <label for="nuotrauka" class="form-label">Knygyno nuotrauka</label>
          <input class="form-control" type="file" name="nuotrauka" id="nuotrauka">
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