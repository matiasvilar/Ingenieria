<?php

namespace App\Models;

class User extends Database {

    public function createUser($name, $email, $password) {
        $query = $this->db->prepare("INSERT INTO usuario (nombre, email, contrasena) VALUES (?,?,?)");
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $query->bind_param('sss', $name, $email, $hash);
        $query->execute();
        $insertedId = $query->insert_id;
        $query->close();
        return $insertedId;
    }

    public function getUser($email) {
        $query = $this->db->prepare("SELECT * FROM usuario WHERE email = ?");        
        $query->bind_param('s', $email);
        $query->execute();
        $result = $query->get_result();
        $query->close();
        return $result->fetch_assoc();
    }

    public function createSecret($secret, $id) {
        $query = $this->db->prepare("UPDATE usuario SET doblefactor = ? WHERE id = ?");        
        $query->bind_param('si', $secret, $id);
        $query->execute();
    }

    public function deleteSecret($id) {
        $query = $this->db->prepare("UPDATE usuario SET doblefactor = null WHERE id = ?");        
        $query->bind_param('i', $id);
        $query->execute();
    }

}