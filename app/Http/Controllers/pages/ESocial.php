<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ESocial extends Controller
{
  public function index(Request $request)
  {
    $esociale = DB::select('select * from entitySociale;');
    $message = $request->header('message');

    echo Session::get('message');
    return view(
      'content.pages.e-social',
      [
        'message' => $message,
        'esociale' => $esociale

      ]
    );
  }
  public function addestodb(Request $request)
  {
    $raison_social = $request->input('raison_social');
    $numero_registre = $request->input('numero_registre');
    $patente = $request->input('patente');
    $adresse = $request->input('adresse');
    $code_postal = $request->input('code_postal');

    DB::insert('insert into entitySociale (raison_social, numero_registre, patente, adresse, code_postal) values (?, ?, ?, ?, ?)', [$raison_social, $numero_registre, $patente, $adresse, $code_postal]);

    return redirect('/pages/e-social')->with(['message' => 'La ste ' . $raison_social . ' added successfully']);
  }

  public function modifyesocial(int $id)
  {
    $esocial = DB::table('entitySociale')->where('id_entite_social', $id)->first();

    $id_entite_social = $esocial->id_entite_social;
    $raison_social = $esocial->raison_social;
    $numero_registre = $esocial->numero_registre;
    $patente = $esocial->patente;
    $adresse = $esocial->adresse;
    $code_postal = $esocial->code_postal;

    return view("content.pages.e-social-modify", [
      "id_entite_social" => $id_entite_social,
      "raison_social" => $raison_social,
      "numero_registre" => $numero_registre,
      "patente" => $patente,
      "adresse" => $adresse,
      "code_postal" => $code_postal
    ]);
  }

  public function modifyesindb(Request $request)
  {
    $id_entite_social = $request->input('id_entite_social');
    $raison_social = $request->input('raison_social');
    $numero_registre = $request->input('numero_registre');
    $patente = $request->input('patente');
    $adresse = $request->input('adresse');
    $code_postal = $request->input('code_postal');

    DB::table('entitySociale')
      ->where('id_entite_social', $id_entite_social)
      ->update([
        "raison_social" => $raison_social,
        "numero_registre" => $numero_registre,
        "patente" => $patente,
        "adresse" => $adresse,
        "code_postal" => $code_postal
      ]);

    return redirect('/pages/e-social')->with(['message' => 'esocial with id ' . $id_entite_social . ' updated successfully']);
  }


  public function deletees(int $id)
  {
    DB::table('entitySociale')->where('id_entite_social', '=', $id)->delete();

    return redirect('/pages/e-social')->with(['message' => 'esocial with id ' . $id . ' deleted successfully']);
  }
}
