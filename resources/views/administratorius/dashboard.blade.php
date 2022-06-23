@extends('layouts.app')

@section('content')
<div class="container" id="adminDash">
  <div class="row my-3">
    <h1 class="text-dark text-center">Administratoriaus paskyra</h1>
  </div>
  <div class="row my-4">
    <div class="col-12">
      <ul class="nav nav-pills nav-fill">
        <hr>
        <li class="nav-item">
          <a class="nav-link active" data-bs-toggle="pill" href="#istaigos">Įstaigos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="pill" href="#meniu">Meniu</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="pill" href="#patiekalai">Patiekalai</a>
        </li>
        <hr>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="pill" href="#uzsakymai">Užsakymai
            <span id="vykdomuKiekis">{{\DB::table('uzsakymai')->where('busena', '=', 'vykdoma') ->get()->count()}}</span>
          </a>
        </li>
      </ul>
    </div>
  </div>
  <div class="row">
    <div class="tab-content">
      <div class="tab-pane active" id="istaigos">
        <ul class="nav nav-tabs card-header-tabs">
          <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="pill" href="#visosistaigos">Visos įstaigos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="pill" href="#pridetiistaiga">Pridėti įstaigą</a>
          </li>
        </ul>
        <div class="tab-content my-4">
          <div class="tab-pane active" id="visosistaigos">
            @if(count($istaig) < 1) <div class="text-secondary">Tuščia</div>
          @else
          <table class="table table-bordered">
            <thead>
              <tr class="text-center">
                <th>Įstaigos ID</th>
                <th>Pavadinimas</th>
                <th>Kodas</th>
                <th>Adresas</th>
                <th>Nuotrauka</th>
                <th colspan="4">Veiksmas</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($istaig as $istaiga)
              <tr class="text-center">
                <td>{{$istaiga->id}}</td>
                <td>{{$istaiga->pavadinimas}}</td>
                <td>{{$istaiga->kodas}}</td>
                <td>{{$istaiga->adresas}}</td>
                <td>
                  <img src="{{ asset('images/istaigos/' . $istaiga->nuotrauka) }}" width="50px" height="50px" style="object-fit: cover;" alt="nuotrauka">
                </td>
                <td><a href="{{ url('redaguoti-istaiga/' . $istaiga->id) }}" class="btn btn-outline-dark btn-sm">Redaguoti</a></td>
                <td><a href="{{ url('istrinti-istaiga/' . $istaiga->id) }}" class="btn btn-outline-danger btn-sm">Šalinti</a></td>
              </tr>
              @endforeach
            </tbody>
          </table>
          @endif
        </div>
        <form class="tab-pane container fade" style="padding: 0;" id="pridetiistaiga" action="{{url('admin_dashboard/maitinimoistaigos')}}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="mb-3">
            <label for="pavadinimas" class="form-label">Įstaigos pavadinimas</label>
            <input type="text" class="form-control" name="pavadinimas" id="pavadinimas">
          </div>
          <div class="mb-3">
            <label for="kodas" class="form-label">Įstaigos kodas</label>
            <input type="text" class="form-control" name="kodas" id="kodas">
          </div>
          <div class="mb-3">
            <label for="adresas" class="form-label">Įstaigos adresas</label>
            <input type="text" class="form-control" name="adresas" id="adresas">
          </div>
          <div class="mb-3">
            <label for="nuotrauka" class="form-label">Įstaigos nuotrauka</label>
            <input class="form-control" type="file" name="nuotrauka" id="nuotrauka">
          </div>
          <div class="w-100">
            <button type="submit" class="btn btn-outline-success float-end">Pateikti</button>
          </div>
        </form>
      </div>
    </div>
    <div class="tab-pane" id="meniu">
      <ul class="nav nav-tabs card-header-tabs">
        <li class="nav-item">
          <a class="nav-link active" data-bs-toggle="pill" href="#visimeniu">Visi meniu</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="pill" href="#pridetimeniu">Pridėti meniu prie maitinimo įstaigos</a>
        </li>
      </ul>
      <div class="tab-content py-4">
        <div class="tab-pane container active" id="visimeniu" style="padding: 0;">
          @if(count($men) < 1) <div class="text-secondary">Tuščia</div>
        @else
        <table class="table table-bordered">
          <thead>
            <tr class="text-center">
              <th>Meniu ID</th>
              <th>Meniu pavadinimas</th>
              <th>Įstaigos ID</th>
              <th colspan="4">Veiksmas</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($men as $meniu)
            <tr class="text-center">
              <td>{{$meniu->id}}</td>
              <td>{{$meniu->pavadinimas}}</td>
              <td>{{$meniu->maitinimo_istaigos_id}}</td>
              <td><a href="{{ url('redaguoti-meniu/' . $meniu->id) }}" class="btn btn-outline-dark btn-sm">Redaguoti</a></td>
              <td><a href="{{ url('istrinti-meniu/' . $meniu->id) }}" class="btn btn-outline-danger btn-sm">Šalinti</a></td>
            </tr>
            @endforeach
          </tbody>
        </table>
        @endif
      </div>
      <form class="tab-pane container fade" style="padding: 0;" id="pridetimeniu" action="{{url('admin_dashboard/meniu')}}" method="POST" enctype="multipart/form-data">
        @if(count($istaig) < 1) <div class="text-secondary">Turi buti bent viena maitinimo įstaiga, kad galetumete pridėti meniu
    </div>
    @else
    @csrf
    <div class="mb-3">
      <label for="meniu-pavadinimas" class="form-label">Meniu pavadinimas</label>
      <input type="text" class="form-control" name="meniu-pavadinimas" id="meniu-pavadinimas">
    </div>
    <select class="form-select mb-3" name="maitinimo-istaigos-id" aria-label=".form-select-lg example">
      <option disabled selected>Pasirinkite įstaigą</option>
      @foreach ($istaig as $istaiga)
      <option value="{!! $istaiga->id !!}">{{$istaiga->pavadinimas}}</option>
      @endforeach
    </select>
    <div class="w-100">
      <button type="submit" class="btn btn-outline-success float-end">Pateikti</button>
    </div>
    @endif
    </form>
  </div>
</div>
<div class="tab-pane" id="patiekalai">
  <ul class="nav nav-tabs card-header-tabs">
    <li class="nav-item">
      <a class="nav-link active" data-bs-toggle="pill" href="#visipatiekalai">Visi patiekalai</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="pill" href="#pridetipatiekala">Pridėti patiekalą prie meniu</a>
    </li>
  </ul>
  <div class="tab-content py-4">
    <div class="tab-pane container active" id="visipatiekalai" style="padding: 0;">
      @if(count($pat) < 1) <div class="text-secondary">Tuščia</div>
    @else
    <table class="table table-bordered">
      <thead>
        <tr class="text-center">
          <th>Patiekalo ID</th>
          <th>Patiekalo pavadinimas</th>
          <th>Patiekalo kaina</th>
          <th>Patiekalo aprasymas</th>
          <th>Meniu ID</th>
          <th colspan="2">Veiksmas</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($pat as $patiekalas)
        <tr class="text-center">
          <td>{{$patiekalas->id}}</td>
          <td>{{$patiekalas->patiekalo_pavadinimas}}</td>
          <td>{{$patiekalas->patiekalo_kaina}}</td>
          <td>{{$patiekalas->patiekalo_aprasymas}}</td>
          <td>{{$patiekalas->meniu_id}}</td>
          <td><a href="{{url('redaguoti-patiekala/' . $patiekalas->id)}}" class="btn btn-outline-dark btn-sm">Redaguoti</a></td>
          <td><a href="{{url('istrinti-patiekala/' . $patiekalas->id)}}" class="btn btn-outline-danger btn-sm">Šalinti</a></td>
        </tr>
        @endforeach
      </tbody>
    </table>
    @endif
  </div>
  <form class="tab-pane container fade" style="padding: 0;" id="pridetipatiekala" action="{{url('admin_dashboard/patiekalai')}}" method="POST" enctype="multipart/form-data">
    @if(count($men) < 1) <div class="text-secondary">Turi buti bent vienas meniu, kad galetumete pridėti patiekalą
</div>
@else
@csrf
<div class="mb-3">
  <label for="patiekalo-pavadinimas" class="form-label">Patiekalo pavadinimas</label>
  <input type="text" class="form-control" name="patiekalo-pavadinimas" id="patiekalo-pavadinimas">
</div>
<div class="mb-3">
  <label for="patiekalo-kaina" class="form-label">Patiekalo kaina</label>
  <input type="number" step="0.01" class="form-control" name="patiekalo-kaina" id="patiekalo-kaina">
</div>
<div class="mb-3">
  <label for="patiekalo-aprasymas" class="form-label">Patiekalo aprašymas</label>
  <textarea class="form-control" rows="5" name="patiekalo-aprasymas" id="patiekalo-aprasymas"></textarea>
</div>
<select class="form-select mb-3" name="patiekalas-meniu-id" aria-label=".form-select-lg example">
  <option disabled selected>Pasirinkite meniu</option>
  @foreach ($men as $meniu)
  <option value="{!! $meniu->id !!}">{{$meniu->pavadinimas}} ({{\App\Models\istaiga::find($meniu->maitinimo_istaigos_id)->pavadinimas}})</option>
  @endforeach
</select>
<div class="w-100">
  <button type="submit" class="btn btn-primary float-end">Pateikti</button>
</div>
@endif
</form>
</div>
</div>
<div class="tab-pane container fade" id="uzsakymai">
  @if(count($uzsak) < 1) <div class="text-secondary">Užsakymų nėra</div>
@else
<table class="table table-bordered">
  <thead>
    <tr class="text-center">
      <th>Vartotojo ID</th>
      <th>Pavadinimas</th>
      <th>Kiekis</th>
      <th>Kaina</th>
      <th>Data</th>
      <th>Busena</th>
      <th colspan="2">Veiksmas</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($uzsak as $uzsakymas)
    <tr class="text-center">
      <td>{{$uzsakymas->vartotojo_id}}</td>
      <td>{{\App\Models\patiekalas::find($uzsakymas->patiekalo_id)->patiekalo_pavadinimas}}</td>
      <td>{{$uzsakymas->kiekis}}</td>
      <td>{{\App\Models\patiekalas::find($uzsakymas->patiekalo_id)->patiekalo_kaina}}</td>
      <td>{{$uzsakymas->created_at}}</td>
      <td>{{ucwords($uzsakymas->busena)}}</td>
      <form class="tab-pane container" style="padding: 0;" action="{{url('priimti-uzsakyma/' . $uzsakymas->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        <td style="text-align: center;  vertical-align: middle;"><button type="submit" class="btn btn-outline-dark btn-sm">Priimti</button></td>
      </form>
      <form class="tab-pane container" style="padding: 0;" action="{{url('atsaukti-uzsakyma/' . $uzsakymas->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        <td style="text-align: center;  vertical-align: middle;"><button type="submit" class="btn btn-outline-danger btn-sm">Atšaukti</button></td>
      </form>
    </tr>
    @endforeach
  </tbody>
</table>
@endif
</div>
</div>
</div>
</div>
@endsection