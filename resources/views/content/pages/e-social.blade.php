@extends('layouts/contentNavbarLayout')

@section('title', 'Entites Social')

@section('content')

@if ($message != '')

<div class="alert alert-success alert-dismissible" role="alert">
  {{$message}} <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
  </button>
</div>
@endif

<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Pages /</span> Entites social
</h4>

<div class="card">
  <h5 class="card-header">Tous les E social</h5>
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th>raison_social</th>
          <th>numero_registre</th>
          <th>patente</th>
          <th>adresse</th>
          <th>code_postal</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">

        @foreach($esociale as $esocialePosition => $esocialeInfos)
        <tr>
          <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $esocialeInfos->id_entite_social }}</strong></td>
          <td>
            {{ $esocialeInfos->raison_social }}
          </td>
          <td>
            <span class="badge bg-label-primary me-1">
              {{ $esocialeInfos->numero_registre }}
            </span>
          </td>
          <td>
            {{ $esocialeInfos->patente }}
          </td>
          <td>
            {{ $esocialeInfos->adresse }}
          </td>
          <td>
            {{ $esocialeInfos->code_postal }}
          </td>
          <td>
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="/modifyesocial/{{$esocialeInfos->id_entite_social}}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                <a class="dropdown-item" onclick="return confirm('êtes-vous sûr de vouloir supprimer cette entites social?')" href="/deleteES/{{$esocialeInfos->id_entite_social}}"><i class="bx bx-trash me-1"></i> Delete</a>
              </div>
            </div>
          </td>
        </tr>
        @endforeach

      </tbody>
    </table>
  </div>
</div>
<hr class="my-5">
<div class="card mb-4">
  <div class="card-header d-flex align-items-center justify-content-between">
    <h5 class="mb-0">Ajouter E Social</h5>
  </div>
  <div class="card-body">
    <form action="/addestodb" method="post">
      @csrf
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="numero_registre">numero registre</label>
        <div class="col-sm-10">
          <input type="number" class="form-control" id="numero_registre" name="numero_registre" placeholder="00000" required />
          <div class="form-text"> You can use numbers only </div>
        </div>
      </div>
      @error('numero_registre')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror

      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="raison_social">Raison social</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" required id="raison_social" name="raison_social" placeholder="ACME Inc." />
        </div>
      </div>
      @error('raison_social')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror

      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="code_postal">Code postal</label>
        <div class="col-sm-10">
          <div class="input-group input-group-merge">
            <input type="number" id="code_postal" name="code_postal" class="form-control" placeholder="00000" />
          </div>
          <div class="form-text"> You can use numbers only </div>
        </div>
      </div>
      @error('code_postal')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror

      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="patente">Patente</label>
        <div class="col-sm-10">
          <input type="text" id="patente" class="form-control phone-mask" placeholder="00000000" name="patente" />
        </div>
      </div>
      @error('patente')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="adresse">adresse</label>
        <div class="col-sm-10">
          <input id="adresse" name="adresse" class="form-control" placeholder="" aria-describedby="basic-icon-default-message2">
        </div>
      </div>
      @error('adresse')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror

      <div class="row justify-content-end">
        <div class="col-sm-10">
          <button type="submit" class="btn btn-primary">Ajouter</button>
        </div>
      </div>
    </form>
  </div>
</div>

@endsection