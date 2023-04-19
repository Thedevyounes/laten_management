@php
$isMenu = false;
$navbarHideToggle = false;
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Modify E physique - ' .$libelle )

@section('content')


<div class="card mb-4">
  <div class="card-header d-flex align-items-center justify-content-between">
    <h5 class="mb-0">modifier E Physique</h5>
  </div>
  <div class="card-body">
    <form action="/modifyep" method="post">
      @csrf
      <input type="number" name="id_entite_physique" id="id_entite_physique" value="{{$id_entite_physique}}" hidden>
      <div class="mb-3">
        <label for="entite_social" class="form-label">Entite social</label>
        <select class="form-select" id="entite_social" name="entite_social" aria-label="Default select example">
          @foreach($esociale as $esocialPos => $esocialeRaisonS)
          <option value="{{$esocialeRaisonS->id_entite_social}}" {!! $esocialeRaisonS->id_entite_social == $id_entite_social ? "selected" : "" !!}
            >{{$esocialeRaisonS->raison_social}}</option>
          @endforeach
        </select>
      </div>
      @error('entite_social')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror

      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="libelle">Libelle</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="libelle" name="libelle" value="{{$libelle}}" />
        </div>
      </div>
      @error('libelle')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror

      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="numero_client">Numero client</label>
        <div class="col-sm-10">
          <input type="number" class="form-control" required id="numero_client" name="numero_client" value="{{$numero_client}}" placeholder="0123456" />
        </div>
      </div>
      @error('numero_client')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror

      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="adress">Adresse</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" required id="adress" name="adress" value="{{$adress}}" />
        </div>
      </div>
      @error('adress')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror

      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="code_postal">Code postal</label>
        <div class="col-sm-10">
          <div class="input-group input-group-merge">
            <input type="number" id="code_postal" name="code_postal" value="{{$code_postal}}" class="form-control" placeholder="00000" />
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
          <option value="AC" {!! $status_ep=="AC" ? "selected" : "" !!}>AC</option>
          <option value="KO" {!! $status_ep=="KO" ? "selected" : "" !!}>KO</option>
          <option value="PR" {!! $status_ep=="PR" ? "selected" : "" !!}>PR</option>

        </select>
      </div>
      @error('status_ep')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror

      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="date_creation">date_creation</label>
        <div class="col-sm-10">
          <input type="date" id="date_creation" name="date_creation" value="{{$date_creation}}" class="form-control" aria-describedby="basic-icon-default-message2">
        </div>
      </div>
      @error('date_creation')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror

      <div class="row justify-content-end">
        <div class="col-sm-10">
          <button type="submit" class="btn btn-primary">Modifier</button>
        </div>
      </div>
    </form>
  </div>
</div>

@endsection