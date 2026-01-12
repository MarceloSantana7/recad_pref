<?php

namespace App\Models;

use CodeIgniter\Shield\Models\UserModel;

class CustomUserModel extends UserModel
{
    protected $allowedFields = [
        'username',
        'status',
        'status_message',
        'active',
        'last_active',
        'cpf', // Adiciona o CPF aqui
    ];
}
