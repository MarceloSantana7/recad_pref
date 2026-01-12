<?php

namespace App\Controllers;

class TestEmail extends BaseController
{
    public function sendTestEmail()
    {
        $email = \Config\Services::email();

        // Configuração de e-mail (caso não esteja usando `.env`)
        $email->setTo('marcelo.ssantos127@gmail.com');
        $email->setSubject('Teste de E-mail no CodeIgniter 4');
        $email->setMessage('<p>Este é um e-mail de teste enviado pelo CodeIgniter 4.</p>');

        if ($email->send()) {
            return "E-mail enviado com sucesso!";
        } else {
            // Mostra erros de depuração, se houver
            return $email->printDebugger(['headers']);
        }
    }
}
