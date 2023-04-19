@extends('layouts/contentNavbarLayout')

@section('title', 'Contrat error')

@section('content')

<div class="card">
  <h5 class="card-header">Les contrats qui ont le status AC présent sur deux versions ou plus</h5>
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr>
          <th>id_contrat</th>
          <th>id_entite_physique</th>
          <th>numero_contrat</th>
          <th>statut_contrat</th>
          <th>version_contrat</th>
          <th>type_contrat</th>
          <th>fréquence_facturation</th>
          <th>date_creation</th>
          <th>date_demarrage</th>

        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @foreach($contraterror as $key => $contratvalue)
        <tr>
          <td>{{ $contratvalue->id_contrat }}</td>
          <td>{{ $contratvalue->id_entite_physique }} </td>
          <td> {{ $contratvalue->numero_contrat }} </td>
          <td> {{ $contratvalue->statut_contrat }} </td>
          <td> {{ $contratvalue->version_contrat }} </td>
          <td> {{ $contratvalue->type_contrat }} </td>
          <td> {{ $contratvalue->fréquence_facturation }} </td>
          <td> {{ $contratvalue->date_creation }} </td>
          <td> {{ $contratvalue->date_demarrage }} </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
<hr class="my-1">

<div class="card mb-4">
  <form action="/deletePreviouscontrat" method="post">
    <div class="row justify-content-end">
      <div class="col-sm-10">
        <button type="submit" class="btn btn-primary">Corriger</button>
      </div>
    </div>
  </form>
</div>

@endsection