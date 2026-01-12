<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        if(auth()->loggedIn()){            
            // Verifica o grupo do usuário            
            $user = auth()->user();

            if ($user->inGroup('admin')) {
                return redirect()->to('/admin/dashboard'); // Redireciona para o painel do admin
            } elseif ($user->inGroup('cadastrador')) {
                return redirect()->to('/cadastrador/dashboard'); // Redireciona para o painel do usuário
            } else {
                return redirect()->to('/login'); // Redireciona para a página inicial
            }
        } 
        
        return redirect()->to('/login');
    }
}
