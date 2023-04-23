<?php
require_once __DIR__ . '/BaseDao.class.php';
class UserDao extends BaseDao
{
public function __construct()
{
parent::__construct("users");
}
// custom function, which is not present in BaseDao
// query_unique -> returns only 1 result if multiple are present
function getUserByFirstNameAndLastName($firstName, $lastName)
{
return $this->query_unique("SELECT * FROM users WHERE firstName =
:firstName AND lastName = :lastName", ["firstName" => $firstName,
"lastName" => $lastName]);
}
    function query($query, $params = [])
    {
        $stmt = $this->conn->prepare($query);

        $stmt->execute($params);
        return $stmt;
    }
    function getUsers()
    {
        $stmt = $this->query("SELECT * FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    function getUserById($id)
    {
        $stmt = $this->query("SELECT * FROM users WHERE id = :id", ["id"
        => $id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    function addUser($user)
    {
        $this->query("INSERT INTO users (firstName, lastName, age) VALUES
(:firstName, :lastName, :age)", $user);
        $user['id'] = $this->conn->lastInsertId();
        return $user;
    }
    function updateUser($id, $user)
    {
        $this->query("UPDATE users SET firstName = :firstName, lastName =
:lastName, age = :age WHERE id = :id", array_merge(["id" => $id], $user));
        echo "User updated successfully <br>";
    }
    function deleteUser($id)
    {
        $this->query("DELETE FROM users WHERE id = :id", ["id" => $id]);
        echo "User deleted successfully <br>";
    }
}
