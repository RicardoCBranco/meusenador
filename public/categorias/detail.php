<?php
        include_once filter_input(INPUT_SERVER,"DOCUMENT_ROOT")."/../vendor/autoload.php";
        include('phplot/phplot.php');

        $ctrl = new \Ufrpe\Senadores\Modules\Categoria\Control\CategoriaController();
        $dados = $ctrl->detailAction();
                $gr = new PHPlot(720,360);
                $gr->SetTitle(wordwrap(utf8_decode($dados['categoria']['tipo_despesa']),70,"\n",true));
                $gr->SetDataType('text-data');
                $gr->SetXTitle('Senadores');
                $gr->setYTitle('Gastos(R$)');
                $gr->SetPlotType('bars');
                $gr->SetDataValues($dados['detailpage']);
                $gr->DrawGraph();