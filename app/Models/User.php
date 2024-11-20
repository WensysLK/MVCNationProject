<?php
class User extends Model {

    public function getUser($username_email,$password) {
        $stmt = $this->db->prepare("SELECT u.userID, u.Username, u.Email, u.password, u.userRoleID, r.UserRoleName 
            FROM users u 
            JOIN userrole r ON u.userRoleID = r.UserRoleID
            WHERE u.Username = ? OR u.Email = ? LIMIT 1");
        $stmt->bind_param("ss", $username_email, $username_email); // Bind the username or email
        $stmt->execute();
        return $stmt->get_result();
    }
}
