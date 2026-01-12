<?php

namespace App\Models;

use CodeIgniter\Model;

class ServidorModel extends Model
{
    protected $table = 'servidor';
    protected $primaryKey = 'id'; // Ajuste conforme sua tabela
    protected $useTimestamps = true; // Ajuste conforme sua necessidade

    protected $allowedFields = [           // Campos que podem ser preenchidos ou atualizados
        'matricula',
        'documento',
        'id_cadastrador',
        'nome_completo',
        'lotacao_atual',
        'cpf',
        'data_nascimento',
        'departamento',
        'divisao',
        'secretaria',
        'endereco',
        'numero',
        'cidade',
        'bairro',
        'uf',
        'cep',
        'nome_pai',
        'nome_mae',
        'estado_civil',
        'sexo',
        'naturalidade',
        'telefone',
        'celular',
        'email',
        'instrucao',
        'cor',
        'deficiencia',
        'tipo_sanguineo',
        'rg',
        'orgao_emissor',
        'data_emissao_rg',
        'pis',
        'tituloEleitor',
        'secao',
        'zona',
        'status_recadastro',
        'foto',
        'observacoes',
        'created_at',
        'updated_at',
    ];
}
