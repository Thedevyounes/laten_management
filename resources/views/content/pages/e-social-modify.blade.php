@php
$isMenu = false;
$navbarHideToggle = false;
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Modify E social - ' .$raison_social )

@section('content')

<div class="card mb-4">
  <div class="card-header d-flex align-items-center justify-content-between">
    <h5 class="mb-0">Modifier E Social - {{ $raison_social }}</h5>
  </div>
  <div class="card-body">
    <form action="/modifyes" method="post">
      @csrf
      <input type="number" name="id_entite_social" id="id_entite_social" value="{{ $id_entite_social }}" hidden>
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="numero_registre">numero registre</label>
        <div class="col-sm-10">
          <input type="number" class="form-control" id="numero_registre" value="{{$numero_registre}}" name="numero_registre" placeholder="00000" required />
          <div class="form-text"> You can use numbers only </div>
        </div>
      </div>
      @error('numero_registre')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror

      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="raison_social">Raison social</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" required id="raison_social" value="{{$raison_social}}" name="raison_social" placeholder="ACME Inc." />
        </div>
      </div>
      @error('raison_social')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror

      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="code_postal">Code postal</label>
        <div class="col-sm-10">
          <div class="input-group input-group-merge">
            <input type="number" id="code_postal" value="{{$code_postal}}" name="code_postal" class="form-control" placeholder="00000" />
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
          <input type="text" id="patente" class="form-control phone-mask" placeholder="00000000" value="{{$patente}}" name="patente" />
        </div>
      </div>
      @error('patente')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="adresse">adresse</label>
        <div class="col-sm-10">
          <input id="adresse" value="{{$adresse}}" name="adresse" class="form-control" placeholder="" aria-describedby="basic-icon-default-message2">
        </div>
      </div>
      @error('adresse')
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