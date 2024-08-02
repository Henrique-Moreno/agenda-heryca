<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Servidor;
use Illuminate\Support\Facades\File;

class HomePage extends Controller
{
  public function index(Request $request)
  {
    // Tenta carregar os dados do banco de dados
    $servidores = Servidor::with(['usuario', 'cargo'])->get();

    // Se não houver dados no banco, carrega os dados do arquivo JSON
    if ($servidores->isEmpty()) {
      $jsonPath = database_path('fallback_data/servidores.json');
      if (File::exists($jsonPath)) {
        $jsonData = File::get($jsonPath);
        $servidores = collect(json_decode($jsonData));
      } else {
        $servidores = collect(); // Retorna uma coleção vazia se o arquivo JSON não existir
      }
    }

    return view('content.pages.pages-home', compact('servidores'));
  }
}
