<?php
// model
class User extends CI_Model {
     function getFriends()
     {
         return $this->db->query("SELECT DISTINCT friends.alias, friends.id FROM users JOIN friends ON users.id = friends.users_id WHERE friends.users_id = ?", $this->session->userdata('id'))->result_array();
     }
     function getOthers(){
        return $this->db->query("SELECT DISTINCT users.alias, users.id FROM users JOIN friends ON users.id = friends.users_id WHERE friends.users_id != " . $this->session->userdata('id'))->result_array();
     }
     function addFriend($input){
        $query = "INSERT INTO friends (name, alias, email, created_at, updated_at, users_id) VALUES (?, ?, ?, NOW(), NOW()," . $this->session->userdata('id'). ")";
        $values = array($input['name'], $input['alias'], $input['email']);
        return $this->db->query($query, $values); 
     }
     function removeFriend($input){
        return  $this->db->query("DELETE FROM friends WHERE id = ?", $input);
     }
     function getUserByEmail($email)
     {
         return $this->db->query("SELECT * FROM users WHERE email = ?", array($email))->row_array();
     }
     function getFriendById($id)
     {
         return $this->db->query("SELECT * FROM users WHERE id = ?", array($id))->row_array();
     }
     function getUserById($id)
     {
         return $this->db->query("SELECT * FROM users WHERE id = ?", array($id))->row_array();
     }
     function addUser($input)
     {
         $query = "INSERT INTO users (name, alias, email, password, date_of_birth, created_at, updated_at) VALUES (?,?,?,?,?, NOW(), NOW())";
         $values = array($input['name'], $input['alias'], $input['email'], $input['password'], $input['dob']); 
         return $this->db->query($query, $values);
     }
}
?>