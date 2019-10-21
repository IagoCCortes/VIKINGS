<?php
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class cartoriosController extends Controller {

    function index($start = NULL, $count = NULL, $search = NULL) {
        $start = ($start === NULL? 0 : $start);
        $count = ($count === NULL? 25 : $count);
        require(ROOT . 'Models/Cartorios.php');
        $cartorios = new Cartorios();
        $d['start'] = $start;
        $d['count'] = $count;
        $d['total'] = $cartorios->totalDeRegistros();
        $d['search'] = $search;
        if($search === NULL){
            $d['cartorios'] = $cartorios->mostraIntervaloDeRegistros($start, $count);
        }else{
            $d['cartorios'] = $cartorios->mostraRegistrosPesquisados($start, $count, $search);
        }
        $this->set($d);
        $this->render("index");
    }

    function indexAll($search = NULL) {
        require(ROOT . 'Models/Cartorios.php');
        $cartorios = new Cartorios();
        $d['search'] = $search;
        $d['start'] = 0;
        $d['total'] = $cartorios->totalDeRegistros();
        $d['count'] = $d['total'][0];
        $d['cartorios'] = $cartorios->mostraTodosRegistros();
        $this->set($d);
        $this->render("index");
    }

    function inserir() {
        if (isset($_POST["nome"])) {
            require(ROOT . 'Models/Cartorios.php');
            $cartorios= new Cartorios();
            if ($cartorios->inserir([$_POST["nome"], $_POST["razao"], $_POST["documento"], 
                                    $_POST["cep"], $_POST["endereco"], $_POST["bairro"], 
                                    $_POST["cidade"], $_POST["uf"], $_POST["telefone"], 
                                    $_POST["email"], $_POST["tabeliao"], $_POST["ativo"]])) {
                header("Location: " . WEBROOT . "Cartorios/index");
            }
        }
        
        $this->render("index");
    }

    function editar($cod) {

        require(ROOT . 'Models/Cartorios.php');
        $cartorios= new Cartorios();
        $d["cartorios"] = $cartorios->mostraRegistro($cod);

        if (isset($_POST["nome"])) {
            if ($cartorios->editar($cod, [$_POST["nome"], $_POST["razao"], $_POST["documento"], 
                                 $_POST["cep"], $_POST["endereco"], $_POST["bairro"], 
                                 $_POST["cidade"], $_POST["uf"], $_POST["telefone"], 
                                 $_POST["email"], $_POST["tabeliao"], $_POST["ativo"]])) {
                header("Location: " . WEBROOT . "Cartorios/index");
                $this->render("index");
            }
        }
        $this->set($d);
        $this->render("editar");
    }

    function deletar($cod) {

        require(ROOT . 'Models/Cartorios.php');
        $cartorios = new Cartorios();

        if ($cartorios->deletar($cod)) {
            header("Location: " . WEBROOT . "Cartorios/index");
        }
    }

    function inserirXML(){
        if ((isset($_FILES["doc"])) && ($_FILES['doc']['error'] == UPLOAD_ERR_OK)) {
            $xml = simplexml_load_file($_FILES['doc']['tmp_name']);

            require(ROOT . 'Models/Cartorios.php');
            $cartorios= new Cartorios();
            if ($cartorios->inserirVarios($xml)) {
                header("Location: " . WEBROOT . "Cartorios/index");
            }
        }
        $this->render("index");
    }
    
    function exportarXLSX(){
        if(isset($_POST['export_excel'])){
            require(ROOT . 'Models/Cartorios.php');
            $cartorios = new Cartorios();
            $resultado = $cartorios->mostraTodosRegistros();

            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->fromArray(['NOME', 'RAZÃO', 'DOCUMENTO', 'CEP', 'ENDEREÇO', 'BAIRRO', 'CIDADE', 'UF', 'TELEFONE', 'E-MAIL', 'TABELIÃO', 'ATIVO'], NULL, 'A1');

            $i = 2;
            foreach ($resultado as $row) {
                $sheet->fromArray([$row['NOME'], $row['RAZAO'], (string) $row['DOCUMENTO'], $row['CEP'], $row['ENDERECO'], $row['BAIRRO'], $row['CIDADE'], $row['UF'], 
                                    $row['TELEFONE'], $row['EMAIL'], $row['TABELIAO'], ($row['ATIVO'] == 1? 'SIM' : 'NÃO')], NULL, 'A' . $i);
                $i++;
            }    



            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="Cartórios.xlsx"');
            header('Cache-Control: max-age=0');

            $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save('php://output');
        }
    }
}
?>