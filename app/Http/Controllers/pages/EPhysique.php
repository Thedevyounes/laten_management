<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class EPhysique extends Controller
{
  public function index(Request $request)
  {
    $ephysique = DB::select('select * from entitePhysique;');
    $esociale = DB::select('select * from entitySociale;');

    $message = $request->header('message');

    echo Session::get('message');
    return view(
      'content.pages.e-physique',
      [
        'message' => $message,
        'ephysique' => $ephysique,
        'esociale' => $esociale
      ]
    );
  }
  public function addeptodb(Request $request)
  {
    $id_entite_social = $request->input('entite_social');
    $adress = $request->input('adress');
    $code_postal = $request->input('code_postal');
    $libelle = $request->input('libelle');
    $numero_client = $request->input('numero_client');
    $status_ep = $request->input('status_ep');
    $date_creation = $request->input('date_creation');

    DB::insert('insert into entitePhysique (id_entite_social , libelle,numero_client,adresse ,code_postal, status_ep,date_creation) values (?, ?, ?, ?, ?, ?, ?)', [$id_entite_social, $libelle, $numero_client, $adress, $code_postal, $status_ep, $date_creation]);

    return redirect('/pages/e-physique')->with(['message' => 'Le/La ' . $libelle . ' added successfully']);
  }

  public function modifyephysique(int $id)
  {
    $ephysique = DB::table('entitePhysique')->where('id_entite_physique', $id)->first();


    $id_entite_social = $ephysique->id_entite_social;
    $adress = $ephysique->adresse;
    $code_postal = $ephysique->code_postal;
    $id_entite_physique = $ephysique->id_entite_physique;
    $libelle = $ephysique->libelle;
    $numero_client = $ephysique->numero_client;
    $status_ep = $ephysique->status_ep;
    $date_creation = $ephysique->date_creation;

    $esociale = DB::select('select id_entite_social, raison_social from entitySociale;');

    return view("content.pages.e-physique-modify", [
      "id_entite_social" => $id_entite_social,
      "esociale" => $esociale,
      "adress" => $adress,
      "code_postal" => $code_postal,
      "id_entite_physique" => $id_entite_physique,
      "libelle" => $libelle,
      "numero_client" => $numero_client,
      "status_ep" => $status_ep,
      "date_creation" => $date_creation
    ]);
  }

  public function modifyepindb(Request $request)
  {
    $id_entite_social = $request->input('entite_social');
    $adresse = $request->input('adresse');
    $code_postal = $request->input('code_postal');
    $id_entite_physique = $request->input('id_entite_physique');
    $libelle = $request->input('libelle');
    $numero_client = $request->input('numero_client');
    $status_ep = $request->input('status_ep');
    $date_creation = $request->input('date_creation');

    DB::table('entitePhysique')
      ->where('id_entite_physique', $id_entite_physique)
      ->update([
        "id_entite_social" => $id_entite_social,
        "libelle" => $libelle,
        "numero_client" => $numero_client,
        "status_ep" => $status_ep,
        "date_creation" => $date_creation,
        "adresse" => $adresse,
        "code_postal" => $code_postal
      ]);

    return redirect('/pages/e-physique')->with(['message' => 'ephysique with id ' . $id_entite_physique . ' updated successfully']);
  }

  public function deleteep(int $id)
  {
    DB::table('entitePhysique')->where('id_entite_physique', '=', $id)->delete();

    return redirect('/pages/e-physique')->with(['message' => 'ephysique with id ' . $id . ' deleted successfully']);
  }

  public function detailsephysique(int $id)
  {
    $contrats = DB::table('contrat')
      ->where('id_entite_physique', '=', $id)
      ->get();

    $libelle = DB::select('select libelle from entitePhysique where id_entite_physique =' . $id . ';');

    $contartsIds = array();
    foreach ($contrats as $contratPosition => $contratInfos) {
      array_push($contartsIds, $contratInfos->id_contrat);
    }

    $articles = DB::table('article')
      ->whereIn('id_contrat', $contartsIds)
      ->get();

    $countArtContr = array();

    foreach ($contartsIds as $key => $value) {

      $countArtContr[$value] = DB::table('article')
        ->where('id_contrat', '=', $value)
        ->count();
    }

    $contactRoles = DB::table('contactRole')
      ->where('id_entite_physique', '=', $id)
      ->join('contact', 'contactRole.id_contact', '=', 'contact.id_contact')
      ->get();

    return view('content.pages.e-physique-details', [
      'contrats' => $contrats,
      'articles' => $articles,
      'countArtContr' => $countArtContr,
      'contactRoles' => $contactRoles,
      'libelle' => $libelle[0]->libelle,

    ]);
  }

  public function contraterror()
  {
    $contraterror = DB::select('SELECT c1.* FROM contrat c1 inner join contrat c2 on c1.numero_contrat = c2.numero_contrat where c1.statut_contrat = "AC" and c2.statut_contrat = "AC" and c1.version_contrat <> c2.version_contrat  GROUP BY c1.id_contrat ORDER BY id_entite_physique ASC, date_creation DESC, version_contrat ASC;');

    return view('content.pages.contraterror', [
      'contraterror' => $contraterror
    ]);
  }
  public function deletePreviouscontrat()
  {
    $contraterror = DB::select('SELECT c1.* FROM contrat c1 inner join contrat c2 on c1.numero_contrat = c2.numero_contrat where c1.statut_contrat = "AC" and c2.statut_contrat = "AC" and c1.version_contrat <> c2.version_contrat GROUP BY c1.id_contrat;');

    $contratErrorArrary = array();

    foreach ($contraterror as $key => $value) {
      array_push($contratErrorArrary, array(
        "date_creation" => $value->date_creation,
        "id_contrat" => $value->id_contrat,
        "numero_contrat" => $value->numero_contrat,
        "id_entite_physique" => $value->id_entite_physique
      ));
    }

    $groupByEp = array_reduce($contratErrorArrary, array($this, 'groupByIdEntitePhysique'), array());

    foreach ($groupByEp as $groupByEpkey => $groupByEpvalue) {
      $groupByNumC = array_reduce($groupByEpvalue, array($this, 'groupBynumero_contrat'), array());

      foreach ($groupByNumC as $groupByNumCkey => $groupByNumCvalue) {
        $max_date_creation = null;
        $max_id_contrat = null;
        $allIds = array();

        foreach ($groupByNumCvalue as $contrat => $item) {

          array_push($allIds, $item['id_contrat']);
          if ($max_date_creation === null || $item['date_creation'] > $max_date_creation) {
            $max_date_creation = $item['date_creation'];
            $max_id_contrat = $item['id_contrat'];
          }
        }
        if (($key2 = array_search($max_id_contrat, $allIds)) !== false) {
          unset($allIds[$key2]);
        }
        DB::table('article')
          ->whereIn('id_contrat', $allIds)
          ->delete();

        DB::table('contrat')
          ->whereIn('id_contrat', $allIds)
          ->delete();
      }
    }
  }

  public function preClientRemise()
  {
    $epAremiser = DB::select('SELECT ep.*, c.* FROM entitephysique ep inner join contrat c on ep.id_entite_physique = c.id_entite_physique inner join article a on c.id_contrat = a.id_contrat where c.type_contrat = "prepaid" and a.remise = 0;');
    $articleIds = array();
    $epInfos = array();

    foreach ($epAremiser as $epKey => $epValue) {
      if (count($epInfos) == 0) {
        array_push($epInfos, array(
          "id_entite_physique" => $epValue->id_entite_physique,
          "libelle" => $epValue->libelle,
          "numero_client" => $epValue->numero_client,
          "adresse" => $epValue->adresse,
          "code_postal" => $epValue->code_postal,
          "status_ep" => $epValue->status_ep,
          "date_creation" => $epValue->date_creation,
          "contrats" => array()
        ));
        $contratPre = DB::select('SELECT * FROM  contrat where id_entite_physique = 2;');
        foreach ($contratPre as $contratKey => $contratValue) {
          array_push(
            $epInfos[count($epInfos) - 1]['contrats'],
            array(
              "id_contrat" => $contratValue->id_contrat,
              "id_entite_physique" => $contratValue->id_entite_physique,
              "numero_contrat" => $contratValue->numero_contrat,
              "statut_contrat" => $contratValue->statut_contrat,
              "version_contrat" => $contratValue->version_contrat,
              "type_contrat" => $contratValue->type_contrat,
              "fréquence_facturation" => $contratValue->fréquence_facturation,
              "date_creation" => $contratValue->date_creation,
              "date_demarrage" => $contratValue->date_demarrage,
              "articles" => array()
            )
          );
          $articles = DB::select('SELECT * FROM  article where id_contrat = ' . $contratValue->id_contrat . ';');
          foreach ($articles as $articlesKey => $articlesValue) {
            array_push(
              $articleIds,
              $articlesValue->id_article
            );
            array_push(
              $epInfos[count($epInfos) - 1]['contrats'][count($epInfos[count($epInfos) - 1]['contrats']) - 1]['articles'],
              array(
                "id_article" => $articlesValue->id_article,
                "id_contrat" => $articlesValue->id_contrat,
                "libelle" => $articlesValue->libelle,
                "montant" => $articlesValue->montant,
                "remise" => $articlesValue->remise,
                "devise" => $articlesValue->devise,
                "date_creation" => $articlesValue->date_creation,
              )
            );
          }
        }
      } else {

        if (!in_array($epValue->id_entite_physique, $epInfos[count($epInfos) - 1], true)) {

          array_push($epInfos, array(
            "id_entite_physique" => $epValue->id_entite_physique,
            "libelle" => $epValue->libelle,
            "numero_client" => $epValue->numero_client,
            "adresse" => $epValue->adresse,
            "code_postal" => $epValue->code_postal,
            "status_ep" => $epValue->status_ep,
            "date_creation" => $epValue->date_creation,
            "contrats" => array()
          ));
          $contratPre = DB::select('SELECT c.* FROM  contrat c inner join article a on c.id_contrat = a.id_contrat where c.type_contrat = "prepaid" and a.remise = 0 and c.id_entite_physique = ' . $epValue->id_entite_physique . ' group by c.id_contrat;');
          foreach ($contratPre as $contratKey => $contratValue) {
            array_push(
              $epInfos[count($epInfos) - 1]['contrats'],
              array(
                "id_contrat" => $contratValue->id_contrat,
                "id_entite_physique" => $contratValue->id_entite_physique,
                "numero_contrat" => $contratValue->numero_contrat,
                "statut_contrat" => $contratValue->statut_contrat,
                "version_contrat" => $contratValue->version_contrat,
                "type_contrat" => $contratValue->type_contrat,
                "fréquence_facturation" => $contratValue->fréquence_facturation,
                "date_creation" => $contratValue->date_creation,
                "date_demarrage" => $contratValue->date_demarrage,
                "articles" => array()

              )
            );
          }
          $articles = DB::select('SELECT * FROM  article where id_contrat = ' . $contratValue->id_contrat . ';');
          foreach ($articles as $articlesKey => $articlesValue) {
            array_push(
              $articleIds,
              $articlesValue->id_article
            );
            array_push(
              $epInfos[count($epInfos) - 1]['contrats'][count($epInfos[count($epInfos) - 1]['contrats']) - 1]['articles'],
              array(
                "id_article" => $articlesValue->id_article,
                "id_contrat" => $articlesValue->id_contrat,
                "libelle" => $articlesValue->libelle,
                "montant" => $articlesValue->montant,
                "remise" => $articlesValue->remise,
                "devise" => $articlesValue->devise,
                "date_creation" => $articlesValue->date_creation,
              )
            );
          }
        }
      }
    }

    $lenghtsEp = array();
    $lenghtsCo = array();

    foreach ($epInfos as $Info) {
      $countEp = 0;
      foreach ($Info['contrats'] as $contrat) {
        $countEp += count($contrat['articles']);
        foreach ($Info['contrats'] as $InfoCo) {
          $lenghtsCo[$InfoCo['id_contrat']] = count($InfoCo['articles']);
        }
      }
      $lenghtsEp[$Info['id_entite_physique']] = $countEp;
    }

    return view('content.pages.clientsaremiser', [
      'clientsAremiser' => $epInfos,
      'lenghtsEp' => $lenghtsEp,
      'lenghtsCo' => $lenghtsCo,
      'articleIds' => $articleIds
    ]);
  }

  public function addremise(Request $request)
  {
    $listIds = $request->input('listIds');
    if ($listIds != null) {

      DB::table('article')
        ->whereIn('id_article', $listIds)
        ->update(['remise' => DB::raw('IF(remise=0, 10, remise+remise*0.1)')]);

      DB::table('article')
        ->whereIn('id_article', $listIds)
        ->update(['prix_facture' => DB::raw('montant-remise')]);
    }
    return redirect('/preClientRemise');
  }

  private function groupBynumero_contrat($result, $item)
  {
    $key = $item['numero_contrat'];
    if (!isset($result[$key])) {
      $result[$key] = array();
    }
    $result[$key][] = $item;
    return $result;
  }

  private function groupByIdEntitePhysique($result, $item)
  {
    $key = $item['id_entite_physique'];
    if (!isset($result[$key])) {
      $result[$key] = array();
    }
    $result[$key][] = $item;
    return $result;
  }
}
