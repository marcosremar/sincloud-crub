<?php
require_once('models/Pessoas.php');
require_once('models/FormacaoAcademica.php');
use JasonGrimes\Paginator;
class PessoasController
{
    public function index()
    {
        $totalItems = 6;
        $itemsPerPage = 5;
        $currentPage = isset($_GET['current']) ? $_GET['current'] : 1;
        $urlPattern = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]&current=(:num)";

        $paginator = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);
        $search = isset($_POST['search']) ? $_POST['search'] : '';
        $limit = " LIMIT ".($currentPage-1)*$itemsPerPage.",  $itemsPerPage";
        $pessoasList = Pessoas::all($search, $limit);

        return new View('views/pessoas/index.php', compact(
            'pessoasList',
            'paginator'
        ));
    }
    public function create()
    {
        global $sytemTemplate;
        $sytemTemplate = 'views/blank_layout.php';
        $formUrl = 'index.php?controller=pessoas&action=store';

        $formacaoAcademicaStmt = FormacaoAcademica::all();

        return new View('views/pessoas/create.php', compact(
            'formUrl',
            'data',
            'generoStmt',
            'formacaoAcademicaStmt'
        ));
    }
    public function store()
    {
        $_SESSION['message'] = 'Pessoa criada com sucesso!';
        if(Pessoas::create($_POST) !== true){
            $_SESSION['message'] = 'Ocorreu um erro ao cadastrar um pessoa!';
        }

        $redirect = './index.php?controller=pessoas&action=index';
        header("location:$redirect");
    }
    public function edit()
    {
        global $sytemTemplate;
        $sytemTemplate = 'views/blank_layout.php';

        $data = Pessoas::find($_GET['id']);
        $formUrl = 'index.php?controller=pessoas&action=update&id='.$_GET['id'];

        $formacaoAcademicaStmt = FormacaoAcademica::all();

        return new View('views/pessoas/edit.php', compact(
            'formUrl',
            'data',
            'formacaoAcademicaStmt'
        ));
    }
    public function update()
    {
        $_SESSION['message'] = 'Pessoa atualizada com sucesso!';
        if(Pessoas::update($_GET['id'], $_POST) !== true){
            $_SESSION['message'] = 'Ocorreu um erro ao editar uma pessoa!';
        }

        $redirect = './index.php?controller=pessoas&action=index';
        header("location:$redirect");
    }

    public function destroy()
    {
        $_SESSION['message'] = 'Pessoa excluída com sucesso!';
        if(Pessoas::delete($_POST['id']) !== true){
            $_SESSION['message'] = 'Ocorreu um erro ao excluir uma pessoa!';
        }

        $_SESSION['message'] = 'Pessoa excluida com sucesso!';
        $redirect = $_SESSION['sytem_last_url'];
        header("location:$redirect");
    }

    public function formacaoAcademicaReport()
    {
        $data = Pessoas::getFormacaoAcademicaReport();
        return new View('views/pessoas/formacao_academica_report.php', compact('data'));
    }

    public function faixaEtariaReport()
    {
        $data = Pessoas::getFaixaEtariaReport();
        return new View('views/pessoas/faixa_etaria_report.php', compact('data'));
    }
}
