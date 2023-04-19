@php
$isMenu = false;
$navbarHideToggle = false;
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Details E Physique - ' . $libelle )

@section('content')

<div class="card">
  <h5 class="card-header">Contrat & Articles</h5>
  <div class="card-body">
    <div class="table-responsive text-nowrap">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th> id_contrat</th>
            <th> id_entite_physique</th>
            <th> numero_contrat</th>
            <th> statut_contrat</th>
            <th> version_contrat</th>
            <th> type_contrat</th>
            <th> fréquence_facturation</th>
            <th> date_creation</th>
            <th> date_demarrage</th>
            <th> id_article</th>
            <th> libelle </th>
            <th> montant </th>
            <th> remise </th>
            <th> devise </th>
            <th> date_creation </th>

          </tr>
        </thead>
        <tbody class="table-border-bottom-0">

          @foreach($contrats as $contratsPosition => $contratInfos)
          <tr>

            <td rowspan="{{$countArtContr[$contratInfos->id_contrat] + 2}}"> <strong>{{ $contratInfos->id_contrat }}</strong></td>
            <td rowspan="{{$countArtContr[$contratInfos->id_contrat] + 2}}">{{ $contratInfos->id_entite_physique }}</td>
            <td rowspan="{{$countArtContr[$contratInfos->id_contrat] + 2}}"> <span class="badge bg-label-primary me-1">{{ $contratInfos->numero_contrat }}</span> </td>
            <td rowspan="{{$countArtContr[$contratInfos->id_contrat] + 2}}"> {{ $contratInfos->statut_contrat }} </td>
            <td rowspan="{{$countArtContr[$contratInfos->id_contrat] + 2}}"> {{ $contratInfos->version_contrat }} </td>
            <td rowspan="{{$countArtContr[$contratInfos->id_contrat] + 2}}"> {{ $contratInfos->type_contrat }} </td>
            <td rowspan="{{$countArtContr[$contratInfos->id_contrat] + 2}}"> {{ $contratInfos->fréquence_facturation }} </td>
            <td rowspan="{{$countArtContr[$contratInfos->id_contrat] + 2}}"> {{ $contratInfos->date_creation }} </td>
            <td rowspan="{{$countArtContr[$contratInfos->id_contrat] + 2}}"> {{ $contratInfos->date_demarrage }} </td>

          </tr>
          @foreach($articles as $articlesPosition => $articleInfos)

          @if($articleInfos->id_contrat == $contratInfos->id_contrat)

          <tr>
            <td><strong> {{ $articleInfos->id_article}}</strong></td>
            <td> {{ $articleInfos->libelle}} </td>
            <td> <span class="badge bg-label-primary me-1">{{ $articleInfos->montant}} </span></td>
            <td> {{ $articleInfos->remise}} </td>
            <td> {{ $articleInfos->devise}} </td>
            <td> {{ $articleInfos->date_creation}} </td>
          </tr>
          @endif
          @endforeach

          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
<!--/ Basic Bootstrap Table -->

<hr class="my-5">


<!-- Basic Bootstrap Table -->
<div class="card">
  <h5 class="card-header">Table Basic</h5>
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr>

          <th>id_contact</th>
          <th>nom</th>
          <th>prenom</th>
          <th>cin</th>
          <th>adresse</th>
          <th>role</th>

        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @foreach($contactRoles as $contactPos => $contactInfos)
        <tr>
          <td> <strong>{{ $contactInfos->id_contact }}</strong></td>
          <td>{{ $contactInfos->nom }} </td>
          <td> {{ $contactInfos->prenom }} </td>
          <td> {{ $contactInfos->cin }} </td>
          <td> {{ $contactInfos->adresse }} </td>
          <td> {{ $contactInfos->role }} </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
<!--/ Basic Bootstrap Table -->


@endsection