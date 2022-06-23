@extends('layouts.app')

@section('content')
<!-- Administratoriaus paskyra -->
<div class="container" id="adminDash">
  <div class="row my-2">
    <h1 class="text-dark text-center">Administratoriaus paskyra</h1>
  </div>
  <!-- Pagrindines nuorodos -->
  <div class="row my-4">
    <div class="col-12">
      <ul class="nav nav-pills nav-fill">
        <li class="nav-item">
          <a class="nav-link active" data-bs-toggle="pill" href="#istaigos">Knygynai</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="pill" href="#kategorija">Kategorijos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="pill" href="#knygos">Knygos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="pill" href="#uzsakymai">Užsakymai
            <span id="vykdomuKiekis">{{\DB::table('uzsakymai')->where('busena', '=', 'vykdoma') ->get()->count()}}</span>
          </a>
        </li>
      </ul>
    </div>
  </div>
  <!-- Antros eiles nuorodos -->
  <div class="row">
    <div class="tab-content">
      <div class="tab-pane active" id="istaigos">
        <ul class="nav nav-tabs card-header-tabs p-2">
          <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="pill" href="#visosistaigos">Visi knygynai</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="pill" href="#pridetiKnygyna">Pridėti knygyną</a>
          </li>
        </ul>
        <!-- Knygynu lentele -->
        <div class="tab-content">
          <div class="tab-pane active" id="visosistaigos">
            @if(count($knygynas) < 1) <div class="text-dark text-center">Tuščia</div>
          @else
          <table class="table table-bordered">
            <thead>
              <tr class="text-center">
                <th>Knygyno ID</th>
                <th>Pavadinimas</th>
                <th>Kodas</th>
                <th>Adresas</th>
                <th>Nuotrauka</th>
                <th colspan="4">Veiksmas</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($knygynas as $knygynasa)
              <tr class="text-center">
                <td>{{$knygynasa->id}}</td>
                <td>{{$knygynasa->pavadinimas}}</td>
                <td>{{$knygynasa->kodas}}</td>
                <td>{{$knygynasa->adresas}}</td>
                <td>
                  <img src="{{ asset('images/istaigos/' . $knygynasa->nuotrauka) }}" width="50px" height="50px" style="object-fit: cover;" alt="nuotrauka">
                </td>
                <td><a href="{{ url('redaguoti-istaiga/' . $knygynasa->id) }}" class="btn btn-outline-dark btn-sm">Redaguoti</a></td>
                <td><a href="{{ url('istrinti-istaiga/' . $knygynasa->id) }}" class="btn btn-outline-danger btn-sm">Šalinti</a></td>
              </tr>
              @endforeach
            </tbody>
          </table>
          @endif
        </div>
        <!-- Knygyno pridejimas -->
        <form class="tab-pane container fade" style="padding: 0;" id="pridetiKnygyna" action="{{url('admin_dashboard/knygynoistaigos')}}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="mb-3">
            <label for="pavadinimas" class="form-label">Knygyno pavadinimas</label>
            <input type="text" class="form-control" name="pavadinimas" id="pavadinimas">
          </div>
          <div class="mb-3">
            <label for="kodas" class="form-label">Knygyno kodas</label>
            <input type="text" class="form-control" name="kodas" id="kodas">
          </div>
          <div class="mb-3">
            <label for="adresas" class="form-label">Knygyno adresas</label>
            <input type="text" class="form-control" name="adresas" id="adresas">
          </div>
          <div class="mb-3">
            <label for="nuotrauka" class="form-label">Knygyno nuotrauka</label>
            <input class="form-control" type="file" name="nuotrauka" id="nuotrauka">
          </div>
          <div class="w-100">
            <button type="submit" class="btn btn-outline-success float-end">Pateikti</button>
          </div>
        </form>
      </div>
    </div>
    <!-- Kategoriju lentele -->
    <div class="tab-pane" id="kategorija">
      <ul class="nav nav-tabs card-header-tabs p-2">
        <li class="nav-item">
          <a class="nav-link active" data-bs-toggle="pill" href="#visikategorija">Visos ketegorijos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="pill" href="#pridetikategorija">Pridėti kategorija prie knygyno</a>
        </li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane container active" id="visikategorija" style="padding: 0;">
          @if(count($kat) < 1) <div class="text-dark text-center">Tuščia</div>
        @else
        <table class="table table-bordered">
          <thead>
            <tr class="text-center">
              <th>Kategorija ID</th>
              <th>Kategorijos pavadinimas</th>
              <th>Knygyno ID</th>
              <th colspan="4">Veiksmas</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($kat as $kategorija)
            <tr class="text-center">
              <td>{{$kategorija->id}}</td>
              <td>{{$kategorija->pavadinimas}}</td>
              <td>{{$kategorija->knygu_istaigos_id}}</td>
              <td><a href="{{ url('redaguoti-kategorija/' . $kategorija->id) }}" class="btn btn-outline-dark btn-sm">Redaguoti</a></td>
              <td><a href="{{ url('istrinti-kategorija/' . $kategorija->id) }}" class="btn btn-outline-danger btn-sm">Šalinti</a></td>
            </tr>
            @endforeach
          </tbody>
        </table>
        @endif
      </div>
      <!-- Kategorijos sukurimas -->
      <form class="tab-pane container fade" style="padding: 0;" id="pridetikategorija" action="{{url('admin_dashboard/kategorija')}}" method="POST" enctype="multipart/form-data">
        @if(count($knygynas) < 1) <div class="text-secondary">Sukurkite knygyną, tada galėtumėte pridėti kategorijas.
    </div>
    @else
    @csrf
    <div class="mb-3">
      <label for="kategorija-pavadinimas" class="form-label">Kategorijos pavadinimas</label>
      <input type="text" class="form-control" name="kategorija-pavadinimas" id="kategorija-pavadinimas">
    </div>
    <select class="form-select mb-3" name="knygyno-istaigos-id" aria-label=".form-select-lg example">
      <option disabled selected>Pasirinkite knygyną</option>
      @foreach ($knygynas as $knygynasa)
      <option value="{!! $knygynasa->id !!}">{{$knygynasa->pavadinimas}}</option>
      @endforeach
    </select>
    <div class="w-100">
      <button type="submit" class="btn btn-outline-success float-end">Pateikti</button>
    </div>
    @endif
    </form>
  </div>
</div>
<!-- Knygu lentele -->
<div class="tab-pane" id="knygos">
  <ul class="nav nav-tabs card-header-tabs p-2">
    <li class="nav-item">
      <a class="nav-link active" data-bs-toggle="pill" href="#visiknygos">Visi knygos</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="pill" href="#pridetiknyga">Pridėti knygą prie kategorijos</a>
    </li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane container active" id="visiknygos" style="padding: 0;">
      @if(count($kny) < 1) <div class="text-dark text-center">Tuščia</div>
    @else
    <table class="table table-bordered">
      <thead>
        <tr class="text-center">
          <th>Knygos ID</th>
          <th>Knygos pavadinimas</th>
          <th>Knygos kaina</th>
          <th>Knygos aprasymas</th>
          <th>Kategorijos ID</th>
          <th colspan="2">Veiksmas</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($kny as $knyga)
        <tr class="text-center">
          <td>{{$knyga->id}}</td>
          <td>{{$knyga->knygos_pavadinimas}}</td>
          <td>{{$knyga->knygos_kaina}}</td>
          <td>{{$knyga->knygos_aprasymas}}</td>
          <td>{{$knyga->kategorija_id}}</td>
          <td><a href="{{url('redaguoti-knyga/' . $knyga->id)}}" class="btn btn-outline-dark btn-sm">Redaguoti</a></td>
          <td><a href="{{url('istrinti-knyga/' . $knyga->id)}}" class="btn btn-outline-danger btn-sm">Šalinti</a></td>
        </tr>
        @endforeach
      </tbody>
    </table>
    @endif
  </div>
  <!-- Knygos pridejimas -->
  <form class="tab-pane container fade" style="padding: 0;" id="pridetiknyga" action="{{url('admin_dashboard/knygos')}}" method="POST" enctype="multipart/form-data">
    @if(count($kat) < 1) <div class="text-secondary">Sukurkite kategoriją, tada galėtumėte pridėti knygą.
</div>
@else
@csrf
<div class="mb-3">
  <label for="kategorijos-pavadinimas" class="form-label">Knygos pavadinimas</label>
  <input type="text" class="form-control" name="kategorijos-pavadinimas" id="kategorijos-pavadinimas">
</div>
<div class="mb-3">
  <label for="kategorijos-kaina" class="form-label">Knygos kaina</label>
  <input type="number" step="0.01" class="form-control" name="kategorijos-kaina" id="kategorijos-kaina">
</div>
<div class="mb-3">
  <label for="kategorijos-aprasymas" class="form-label">Knygos aprašymas</label>
  <textarea class="form-control" rows="5" name="kategorijos-aprasymas" id="kategorijos-aprasymas"></textarea>
</div>
<select class="form-select mb-3" name="knyga-kategorija-id" aria-label=".form-select-lg example">
  <option disabled selected>Pasirinkite kategorija</option>
  @foreach ($kat as $kategorija)
  <option value="{!! $kategorija->id !!}">{{$kategorija->pavadinimas}} ({{\App\Models\istaiga::find($kategorija->knygu_istaigos_id)->pavadinimas}})</option>
  @endforeach
</select>
<div class="w-100">
  <button type="submit" class="btn btn-outline-success float-end">Pateikti</button>
</div>
@endif
</form>
</div>
</div>
<!-- Uzsakumu sarasas -->
<div class="tab-pane container fade" id="uzsakymai">
  @if(count($uzsak) < 1) <div class="text-dark text-center">Užsakymų nėra</div>
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
      <td>{{\App\Models\knyga::find($uzsakymas->knygos_id)->knygos_pavadinimas}}</td>
      <td>{{$uzsakymas->kiekis}}</td>
      <td>{{\App\Models\knyga::find($uzsakymas->knygos_id)->knygos_kaina}}</td>
      <td>{{$uzsakymas->created_at}}</td>
      <td>{{ucwords($uzsakymas->busena)}}</td>
      <form class="tab-pane container" style="padding: 0;" action="{{url('priimti-uzsakyma/' . $uzsakymas->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        <td style="text-align: center;  vertical-align: middle;"><button type="submit" class="btn btn-outline-dark btn-sm">Paruoštas</button></td>
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