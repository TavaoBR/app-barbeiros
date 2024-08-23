<?php 

namespace Src\POST\Barbeiro;

class ConsultarHorarioDisponivel {
    protected string $data;

    public function __construct() {
        $this->data = $_POST['data'] ?? '';
    }

    public function Result($data) {
        $fk = $data['fk'];
        echo $this->selectAgenda($this->data, $fk);
    }

    private function selectAgenda(string $data, int $fk) {
        $agenda = agendaBarbeiroData($fk, $data);
        $horariosDisponiveis = [];

        if ($agenda[0] > 0) {
            foreach ($agenda[1] as $consulta) {
                if($consulta->status != 3 AND $consulta->status != 4){
                    $horariosDisponiveis[] = date("H:i", strtotime($consulta->horario));
                }
                
            }
            return $this->selectHorarios($fk, $horariosDisponiveis);
        } else {
            return $this->selectHorarios($fk);
        }
    }

    private function selectHorarios(int $fk, array $horariosDisponiveis = []) {
        $horarios = horariosAtendimentoBarbeiro($fk);
        $html = "<div class='mb-4'>";

        if ($horarios[0] > 0) {
            // Cria uma lista de horários disponíveis para exibir
            $horariosExibir = [];

            if (count($horariosDisponiveis) > 0) {
                // Filtra horários disponíveis
                $horariosLivres = array_diff(
                    array_map(function($hora) { return date("H:i", strtotime($hora->hora)); }, $horarios[1]),
                    $horariosDisponiveis
                );

                if (!empty($horariosLivres)) {
                    $horariosExibir = $horariosLivres;
                } else {
                    $html .= "<input type='text' class='form-control' value='Que pena, todos os horários para a data selecionada já foram preenchidos. Escolha outra data.' disabled />";
                }
            } else {
                // Nenhuma data está agendada para o dia selecionado
                $horariosExibir = array_map(function($hora) { return date("H:i", strtotime($hora->hora)); }, $horarios[1]);
            }

            if (!empty($horariosExibir)) {
                foreach ($horariosExibir as $hora) {
                    $html .= "<div class='btn-group' style='margin-right: 10px;'>
                    <input type='radio' class='btn-check' name='horario' id='horario-$hora' value='$hora' autocomplete='off' />
                    <label class='btn btn-primary' for='horario-$hora'>$hora</label>
                    </div>";
                }
            }
        } else {
            $html .= "<input type='text' class='form-control' value='Nenhum horário foi cadastrado pelo barbeiro.' disabled />";
        }

        $html .= "</div>";
        return $html;
    }
}


