@extends('layouts/contentNavbarLayout')

@section('title', 'Contrat error')

@section('content')

<div class="card">
  <h5 class="card-header">Les contrats qui ont le status AC présent sur deux versions ou plus</h5>
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr>
          <th>id_entite_physique</th>
          <th>libelle</th>
          <th>numero_client</th>
          <th>status_ep</th>
          <th> id_contrat</th>
          <th> numero_contrat</th>
          <th> statut_contrat</th>
          <th> version_contrat</th>
          <th> type_contrat</th>
          <th> id_article</th>
          <th> libelle </th>
          <th> montant </th>
          <th> remise </th>
          <th> devise </th>

        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @foreach($clientsAremiser as $Position => $Infos)
        <tr>
          <td rowspan="{{ $lenghtsEp [$Infos['id_entite_physique']] +2}}">{{ $Infos['id_entite_physique'] }}</td>
          <td rowspan="{{ $lenghtsEp [$Infos['id_entite_physique']]  +2}}">{{ $Infos['libelle'] }} </td>
          <td rowspan="{{ $lenghtsEp [$Infos['id_entite_physique']]  +2}}"> {{ $Infos['numero_client'] }} </td>
          <td rowspan="{{ $lenghtsEp [$Infos['id_entite_physique']] +2 }}"> {{ $Infos['status_ep'] }} </td>

        </tr>

        @foreach($Infos['contrats'] as $contratPosition => $contratInfos)

        <tr>
          <td rowspan="{{ $lenghtsCo [$contratInfos['id_contrat']] +1}}"> {{ $contratInfos['id_contrat']}}</td>
          <td rowspan="{{ $lenghtsCo [$contratInfos['id_contrat']] +1}}"> {{ $contratInfos['numero_contrat']}} </td>
          <td rowspan="{{ $lenghtsCo [$contratInfos['id_contrat']] +1}}"> {{ $contratInfos['statut_contrat']}} </td>
          <td rowspan="{{ $lenghtsCo [$contratInfos['id_contrat']] +1}}"> {{ $contratInfos['version_contrat']}} </td>
          <td rowspan="{{ $lenghtsCo [$contratInfos['id_contrat']] +1}}"> {{ $contratInfos['type_contrat']}} </td>

        </tr>

        @foreach($contratInfos['articles'] as $articlesPosition => $articleInfos)

        <tr>
          <td> {{ $articleInfos['id_article']}}</td>
          <td> {{ $articleInfos['libelle']}} </td>
          <td> {{ $articleInfos['montant']}} </td>
          <td> {{ $articleInfos['remise']}} </td>
          <td> {{ $articleInfos['devise']}} </td>
        </tr>
        @endforeach

        @endforeach

        @endforeach

      </tbody>
    </table>
  </div>
</div>
<hr class="my-1">

<div class="card mb-4">
  <form action="/addremise" method="post">
    @csrf
    @foreach ($articleIds as $arti)

    <input hidden type="number" name="listIds[]" value="{{ $arti }}">

    @endforeach
    <div class="row justify-content-end">
      <div class="col-sm-10">
        <button type="submit" class="btn btn-primary">Ajouter Remise</button>
      </div>
    </div>
  </form>
</div>

@endsection