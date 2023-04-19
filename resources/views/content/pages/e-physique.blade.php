@extends('layouts/contentNavbarLayout')

@section('title', 'Entites Physique')

@section('content')

@if ($message != '')

<div class="alert alert-success alert-dismissible" role="alert">
  {{$message}} <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
  </button>
</div>
@endif

<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Pages /</span> Entites physique
</h4>

<div class="card">
  <h5 class="card-header">Tous les E physique</h5>
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th># entite social</th>
          <th>Libelle</th>
          <th>Numero Client</th>
          <th>Adresse</th>
          <th>Code Postal</th>
          <th>Status Ep</th>
          <th>Date Creation</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">

        @foreach($ephysique as $ephysiquePosition => $ephysiqueInfos)
        <tr>
          <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $ephysiqueInfos->id_entite_physique }}</strong></td>
          <td>
            {{ $ephysiqueInfos->id_entite_social }}
          </td>
          <td>
            {{ $ephysiqueInfos->libelle }}
          </td>
          <td>
            <span class="badge bg-label-primary me-1">
              {{ $ephysiqueInfos->numero_client }}
            </span>
          </td>
          <td>
            {{ $ephysiqueInfos->adresse }}
          </td>
          <td>
            {{ $ephysiqueInfos->code_postal }}
          </td>
          <td>
            {{ $ephysiqueInfos->status_ep }}
          </td>
          <td>
            {{ $ephysiqueInfos->date_creation }}
          </td>
          <td>
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="/detailsephysique/{{$ephysiqueInfos->id_entite_physique}}"><i class="bx bx-edit-alt me-1"></i>Details</a>
                <a class="dropdown-item" href="/modifyephysique/{{$ephysiqueInfos->id_entite_physique}}"><i class="bx bx-edit-alt me-1"></i>Edit</a>
                <a class="dropdown-item" onclick="return confirm('êtes-vous sûr de vouloir supprimer cette entites physique?')" href="/deleteep/{{$ephysiqueInfos->id_entite_physique}}"><i class="bx bx-trash me-1"></i>Delete</a>
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
    <h5 class="mb-0">Ajouter E Physique</h5>
  </div>
  <div class="card-body">
    <form action="/addeptodb" method="post">
      @csrf
      <div class="mb-3">
        <label for="entite_social" class="form-label">Entite social</label>
        <select class="form-select" id="entite_social" name="entite_social" aria-label="Default select example">
          @foreach($esociale as $esocialPos => $esocialeRaisonS)
          <option value="{{$esocialeRaisonS->id_entite_social}}">{{$esocialeRaisonS->raison_social}}</option>
          @endforeach
        </select>
      </div>
      @error('entite_social')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror

      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="libelle">Libelle</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="libelle" name="libelle" />
        </div>
      </div>
      @error('libelle')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror

      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="numero_client">Numero client</label>
        <div class="col-sm-10">
          <input type="number" class="form-control" required id="numero_client" name="numero_client" placeholder="0123456" />
        </div>
      </div>
      @error('numero_client')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror

      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="adress">Adresse</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" required id="adress" name="adress" />
        </div>
      </div>
      @error('adress')
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

      <div class="mb-3">
        <label for="status_ep" class="fcol-sm-2 col-form-label">Status ep</label>
        <select class="form-select" id="status_ep" name="status_ep" aria-label="Default select example">
          <option value="AC">AC</option>
          <option value="KO">KO</option>
          <option value="PR">PR</option>
        </select>
      </div>
      @error('status_ep')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror

      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="date_creation">date_creation</label>
        <div class="col-sm-10">
          <input type="date" id="date_creation" name="date_creation" class="form-control" aria-describedby="basic-icon-default-message2">
        </div>
      </div>
      @error('date_creation')
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