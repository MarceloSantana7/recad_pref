<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AdicionaTabelaServidor extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_cadastrador' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null'       => true
            ],
            'matricula' => [
                'type'       => 'VARCHAR',
                'constraint' => 10,
            ],
            'nome_completo' => [
                'type'       => 'VARCHAR',
                'constraint' => 255
            ],            
            'cpf' => [
                'type'       => 'VARCHAR',
                'constraint' => 14,
            ],
            'data_nascimento' => [
                'type' => 'DATE',
            ],
            'departamento' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'divisao' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'secretaria' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            // Campos de endereço
            'endereco' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'numero' => [
                'type'       => 'VARCHAR',
                'constraint' => 10,
                'null'       => true,
            ],
            'cidade' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'bairro' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'uf' => [
                'type'       => 'VARCHAR',
                'constraint' => 2,
                'null'       => true,
            ],
            'cep' => [
                'type'       => 'VARCHAR',
                'constraint' => 9, // Formato 99999-999
                'null'       => true,
            ],
            // Informação pessoal
            'nome_pai' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'nome_mae' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'estado_civil' => [
                'type'       => 'VARCHAR',
                'constraint' => 50, // Solteiro, Casado, etc.
                'null'       => true,
            ],
            'sexo' => [
                'type'       => 'VARCHAR',
                'constraint' => 10, // Masculino, Feminino, Outro
                'null'       => true,
            ],
            'naturalidade' => [
                'type'       => 'VARCHAR',
                'constraint' => 100, // Cidade de origem
                'null'       => true,
            ],
            'telefone' => [
                'type'       => 'VARCHAR',
                'constraint' => 15, // Formato (XX) XXXX-XXXX
                'null'       => true,
            ],
            'celular' => [
                'type'       => 'VARCHAR',
                'constraint' => 15, // Formato (XX) XXXXX-XXXX
                'null'       => true,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'instrucao' => [
                'type'       => 'VARCHAR',
                'constraint' => 100, // Ex.: "2º Grau Completo"
                'null'       => true,
            ],
            'cor' => [
                'type'       => 'VARCHAR',
                'constraint' => 50, // Ex.: "Branco", "Pardo", etc.
                'null'       => true,
            ],
            'deficiencia' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true, // Normalizar tipos de deficiência
            ],
            'tipo_sanguineo' => [
                'type'       => 'VARCHAR',
                'constraint' => 3, // Ex.: "A+", "O-", etc.
                'null'       => true,
            ],
            'rg' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
            ],
            'orgao_emissor' => [
                'type'       => 'VARCHAR',
                'constraint' => 50, // Ex.: "SSP"
                'null'       => true,
            ],
            'data_emissao_rg' => [
                'type'       => 'DATE',
                'null'       => true,
            ],
            'pis' => [
                'type'       => 'VARCHAR',
                'constraint' => 11, // PIS geralmente possui 11 dígitos
                'null'       => true,
            ],
            'tituloEleitor' => [
                'type' => 'VARCHAR',
                'constraint' => 12,
                'null'       => true,
            ], 
            'secao' => [
                'type' => 'VARCHAR',
                'constraint' => 12,
                'null'       => true,
            ],
            'zona' => [
                'type' => 'VARCHAR',
                'constraint' => 12,
                'null'       => true,
            ],
            'status_recadastro' => [
                'type'       => 'ENUM',
                'constraint' => ['etapa1', 'etapa2', 'etapa3', 'finalizado'],
                'default'    => 'etapa1',
            ],
            'foto' => [
            'type'       => 'VARCHAR',
            'constraint' => 255, // Tamanho suficiente para armazenar o caminho ou URL
            'null'       => true, // Campo opcional
            ],
            'documento' => [
            'type'       => 'VARCHAR',
            'constraint' => 255, // Tamanho suficiente para armazenar o caminho ou URL
            'null'       => true, // Campo opcional
            ],
            'observacoes' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'lotacao_atual' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true); // Define 'id' como chave primária
        $this->forge->createTable('servidor');
    }

    public function down()
    {
        $this->forge->dropTable('servidor');
    }
}
