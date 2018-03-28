<?php

namespace App\Http\Controllers;

use Request;

use Illuminate\Support\Facades\DB;
use App\CursoModel;
use App\NivelModel;

class CursoController extends Controller {

    public function listar() {

        // $cursos = DB::select('SELECT * FROM curso_models');
        $cursos = CursoModel::all();
        $niveis = NivelModel::all();
        return view('curso')->with('cursos', $cursos)->with('niveis', $niveis);
    }

    public function cadastrar() {

        $niveis = NivelModel::orderBy('id')->get();

        return view('cursoCadastrar')->with('niveis', $niveis);
    }

    public function editar($id) {
        return "Editar Curso";
    }

    public function salvar($id) {

        // INSERT
        if($id == 0) {
            $objCursoModel = new CursoModel();
            $objCursoModel->nome = mb_strtoupper(Request::input('nome'), 'UTF-8');
            $objCursoModel->abreviatura = mb_strtoupper(Request::input('abreviatura'), 'UTF-8');
            // Obtém Id Nivel
            $arr = explode(" ", Request::input('nivel'));
            $objCursoModel->id_nivel = $arr[0];
            // Fim
            $objCursoModel->tempo = Request::input('tempo');;
            $objCursoModel->ativo = 1;

            $objCursoModel->save();
        }
        // UPDATE
        else {

        }

        return redirect()->action('CursoController@listar')->withInput();
    }

    public function confirmar($id) {
        return "Confirmar Remoção Curso";
    }
}
