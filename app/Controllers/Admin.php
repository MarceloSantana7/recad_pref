<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Admin extends Controller
{
    public function index()
    {

        // Conecta ao banco de dados
        $db = \Config\Database::connect();

        // 1. Quantidade de servidores pendentes (não "finalizado")
        $servidoresPendentes = $db->table('servidor')
            ->where('status_recadastro !=', 'finalizado')
            ->countAllResults();

        // 2. Obter todos os cadastradores (usuários do grupo "Cadastrador")
        $cadastradores = $db->table('users')
            ->select('users.id, users.username')
            ->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
            ->where('auth_groups_users.group', 'cadastrador')
            ->get()
            ->getResultArray();

        // 3. Calcular quantidade de servidores cadastrados e tempo médio de atendimento por cadastrador
        $dadosCadastradores = [];
        foreach ($cadastradores as $cadastrador) {
            // Quantidade de servidores cadastrados
            $totalCadastrados = $db->table('servidor')
                ->where('id_cadastrador', $cadastrador['id'])
                ->countAllResults();

            // Tempo médio de atendimento
            $servidores = $db->table('servidor')
                ->select('updated_at, created_at')
                ->where('id_cadastrador', $cadastrador['id'])
                ->orderBy('updated_at', 'ASC')
                ->get()
                ->getResultArray();

            $totalDiferencaSegundos = 0;
            $totalAtendimentos = count($servidores);

            for ($i = 0; $i < $totalAtendimentos - 1; $i++) {
                $diferenca = strtotime($servidores[$i + 1]['updated_at']) - strtotime($servidores[$i]['updated_at']);
                if ($diferenca > 0) {
                    $totalDiferencaSegundos += $diferenca;
                }
            }

            $tempoMedio = $totalAtendimentos > 1
                ? $totalDiferencaSegundos / ($totalAtendimentos - 1)
                : 0;

            $dadosCadastradores[] = [
                'username' => $cadastrador['username'] ?? 'Não informado',
                'totalCadastrados' => $totalCadastrados,
                'tempoMedioAtendimento' => $tempoMedio > 0 ? gmdate('H:i:s', $tempoMedio) : 'N/A',
            ];
        }

        $ultimosServidores = $db->table('servidor')
        ->select('foto, nome_completo, cpf, updated_at')
        ->orderBy('updated_at', 'DESC')
        ->where('status_recadastro', 'finalizado')
        ->limit(10)
        ->get()
        ->getResultArray();

        // Quantidade total de servidores cadastrados (status "finalizado" ou outro critério válido)
        $servidoresCadastrados = $db->table('servidor')
        ->where('status_recadastro', 'finalizado')
        ->countAllResults();

        $totalServidores = $servidoresPendentes + $servidoresCadastrados;

        // Passar os dados para a view
        $data = [
            'servidoresPendentes' => $servidoresPendentes,
            'servidoresCadastrados' => $servidoresCadastrados, 
            'totalServidores' => $totalServidores,
            'dadosCadastradores' => $dadosCadastradores,
            'ultimosServidores' => $ultimosServidores,
            'user' => auth()->user()
        ];

        $velocidadeTotalPorHora = 0;

        foreach ($dadosCadastradores as $cadastrador) {
            $tempoMedio = $cadastrador['tempoMedioAtendimento'];
            $tempoEmMinutos = 0;
        
            // Converter tempo médio de atendimento para minutos, ignorando valores inválidos
            if (preg_match('/^(\d{2}):(\d{2}):(\d{2})$/', $tempoMedio, $matches)) {
                $horas = (int)$matches[1];
                $minutos = (int)$matches[2];
                $segundos = (int)$matches[3];
                $tempoEmMinutos = $horas * 60 + $minutos + $segundos / 60; // Tempo em minutos
            }
        
            // Calcular a velocidade por hora apenas se o tempo médio for válido e maior que zero
            if ($tempoEmMinutos > 0) {
                $velocidadeCadastrador = 60 / $tempoEmMinutos; // Quantos registros por hora
                $velocidadeTotalPorHora += $velocidadeCadastrador;
            }
        }
        
        // Enviar o valor para a view
        $data['velocidadeTotalPorHora'] = $velocidadeTotalPorHora;

       
        return view("admin/dashboard", $data);
    }
}
