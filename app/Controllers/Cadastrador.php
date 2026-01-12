<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ServidorModel;
use Dompdf\Dompdf;
use Dompdf\Options;

class Cadastrador extends BaseController
{
    public function index()
    {
        $data = [];
        $data['user'] = auth()->user();
        return view('cadastrador/home', $data);
    }

    public function recadastro(){
        $cpf = $this->request->getPost('cpf');
        $servidor = $this->findServidorCPF($cpf);
        if (!$cpf) {
            return redirect()->back()->with('error', 'CPF inválido'); // Redireciona com mensagem de erro
        }
        if (!$servidor) {
            return redirect()->back()->with('error', 'Servidor efetivo não encontrado, consulte o RH'); // Redireciona com mensagem de erro
        }

        $data['servidor'] = $servidor;
        $id = $servidor['id'];

        // Redireciona para a etapa atual
        switch ($servidor['status_recadastro']) {
            case 'etapa1':
                return redirect()->to("/recadastro/etapa1/$id");
            case 'etapa2':
                return redirect()->to("/recadastro/etapa2/$id");
            case 'etapa3':
                return redirect()->to("/recadastro/etapa3/$id");
            case 'finalizado':
                return redirect()->to("/recadastro/concluido/$id");
        }
    }

    public function etapa1($id)
    {
        $servidorModel = new ServidorModel();
        $servidor = $servidorModel->find($id);

        return view('recadastro/etapa1', ['servidor' => $servidor, 'user' => auth()->user()]);
    }

    public function salvarEtapa1()
    {
        $id = $this->request->getPost('id');

        $dados = $this->request->getPost();
        $dados['cpf'] = str_replace(['.', '-'], '', $dados['cpf']);

        $servidorModel = new ServidorModel();
        $servidorModel->update($id, $dados);

        // Atualiza o status para a próxima etapa
        $servidorModel->update($id, ['status_recadastro' => 'etapa2']);

        return redirect()->to("/recadastro/etapa2/$id");
    }

    public function etapa2($id)
    {
        $servidorModel = new ServidorModel();
        $servidor = $servidorModel->find($id);
        
        return view('recadastro/etapa2', ['servidor' => $servidor, 'user' => auth()->user()]);
    }

    public function salvarEtapa2()
    {
        $fotoBase64 = $this->request->getPost('foto');
        $id = $this->request->getPost('id');

        $servidorModel = new ServidorModel();

        if ($fotoBase64) {
            // Remove o cabeçalho da string base64
            $fotoBase64 = str_replace('data:image/jpeg;base64,', '', $fotoBase64);
            $fotoBase64 = str_replace(' ', '+', $fotoBase64);

            // Decodifica a string base64
            $fotoData = base64_decode($fotoBase64);

            // Define o caminho do diretório
            $uploadPath = 'uploads/fotos/';

            // Verifica se o diretório existe, caso contrário, cria-o
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true); // Cria o diretório com permissões 0777
            }

            // Gera um nome único para o arquivo
            $fotoName = uniqid() . '.jpg';
            $fotoPath = $uploadPath . $fotoName;

            file_put_contents($fotoPath, $fotoData);
            // Aqui você pode salvar o caminho da imagem no banco de dados, por exemplo
            $servidorModel->save(['id' => $id, 'foto' => $fotoPath]);
        }

        $servidorModel->update($id, ['status_recadastro' => 'etapa3']);

        return redirect()->to("/recadastro/etapa3/$id");
    }

    public function etapa3($id)
    {
        $servidorModel = new ServidorModel();
        $servidor = $servidorModel->find($id);

        return view('recadastro/etapa3', ['servidor' => $servidor, 'user' => auth()->user()]);
    }

    public function salvarEtapa3()
    {
        $id = $this->request->getPost('id');
        $servidorModel = new ServidorModel();

        // Aqui você salvará os documentos no servidor (exemplo simplificado)
        $documento = $this->request->getFile('documento');
        if ($documento->isValid() && !$documento->hasMoved()) {
            // Define o nome do arquivo
            $fileName = "$id-" . uniqid() . '.' . $documento->getExtension();
    
            // Move o arquivo para o diretório de uploads
            $documento->move('uploads/documentos', $fileName);
    
            // Caminho completo do arquivo salvo
            $documentoPath = 'uploads/documentos/' . $fileName;
            
            // Atualiza o registro no banco com o caminho do arquivo
            $servidorModel->update($id, [
                'documento' => $documentoPath,
                'status_recadastro' => 'finalizado',
            ]);
        }
        
        $servidorModel->update($id, ['status_recadastro' => 'finalizado']);

        return redirect()->to("/recadastro/concluido/$id");
    }

    public function concluido($id)
    {   
        $servidorModel = new ServidorModel();
        $servidor = $servidorModel->find($id);
        return view('recadastro/concluido', ['servidor' => $servidor, 'user' => auth()->user()]);
    }
  
    private function findServidorCPF($cpf)
    {
        $cpf = preg_replace('/\D/', '', $cpf); // Remove pontos e traços
   
        $servidorModel = new \App\Models\ServidorModel();
        $servidor = $servidorModel->where('cpf', $cpf)->first(); // Busca pelo CPF  

        return $servidor;
    }
    
}
