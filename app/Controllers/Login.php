<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Login extends BaseController
{
    public function login()
    {
        // Lógica de autenticação (exemplo simplificado)
        $credentials = [
            'email'    => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
        ];
        // Tenta autenticar o usuário
        if (auth()->attempt($credentials)) {
            // Usuário autenticado com sucesso

            if(auth()->loggedIn()){            
                // Verifica o grupo do usuário            
                $user = auth()->user();

                if ($user->inGroup('admin')) {
                    return redirect()->to('/admin/dashboard'); // Redireciona para o painel do admin
                } elseif ($user->inGroup('cadastrador')) {
                    return redirect()->to('/cadastrador/dashboard'); // Redireciona para o painel do usuário
                } else {
                    return redirect()->to('/'); // Redireciona para a página inicial
                }
            }else{
                return redirect()->back()->with('error', 'Credenciais inválidas.');
            }
        } else {
            // Falha na autenticação
            return redirect()->back()->with('error', 'Credenciais inválidas.');
        }
    }
}
