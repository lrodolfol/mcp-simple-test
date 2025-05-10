<?php
namespace App\Controllers;

use App\Models\User;

class UserController {

    public function create() : bool {
        $data = json_decode(file_get_contents("php://input"));
        
        if(!empty($data->name) && !empty($data->age)) {
            $user = new User();
            $user->name = $data->name;
            $user->age = $data->age;
            
            if($user->create()) {
                echo json_encode(['message' => 'Usuário criado com sucesso']);
                return true;
            } else {
                echo json_encode(['message' => 'Erro ao criar usuário']);
                return false;
            }
        } else {
            echo json_encode(['message' => 'Dados incompletos']);
            return false;
        }
    }

    public function delete($id) {
        $user = new User();
        $user->id = $id;
        
        if($user->delete()) {
            echo json_encode(['message' => 'Usuário excluído com sucesso']);
        } else {
            echo json_encode(['message' => 'Erro ao excluir usuário']);
        }
    }

    public function getAll() {
        $user = new User();
        $result = $user->getAll();
        $num = $result->rowCount();
        
        if($num > 0) {
            $users_arr = [];
            $users_arr['data'] = [];
            
            while($row = $result->fetch(\PDO::FETCH_ASSOC)) {
                extract($row);
                
                $user_item = [
                    'Id' => $row['Id'],
                    'Name' => $row["Name"],
                    'Age' => $row["Age"]
                ];
                
                array_push($users_arr['data'], $user_item);
            }
            
            echo json_encode($users_arr);
        } else {
            echo json_encode(['message' => 'Nenhum usuário encontrado']);
        }
    }
    
    public function getById($id) {
        $user = new User();
        $user->id = $id;
        
        if($user->getById()) {
            $user_arr = [
                'id' => $user->id,
                'Name' => $user->name,
                'Email' => $user->age
            ];
            
            echo json_encode($user_arr);
        } else {
            echo json_encode(['message' => 'Usuário não encontrado']);
        }
    }
}
