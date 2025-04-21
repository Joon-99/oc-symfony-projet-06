<?php
class UserManager
{
    public function findById(int $id): ?User
    {
        $sql = <<<SQL
            SELECT *
            FROM users
            WHERE id = :id
        SQL;
        $statement = DBManager::execQuery($sql, ['id' => $id]);
        $user = $statement->fetch();
        if ($user) {
            return new User($user);
        }
        return null;
    }
    /**
     * @return User[] | null
     */
    public function findAll(): ?array
    {
        $sql = <<<SQL
            SELECT *
            FROM users
        SQL;
        $statement = DBManager::execQuery($sql);
        $userResults = $statement->fetchAll();
        if ($userResults) {
            $users = [];
            foreach ($userResults as $userResult) {
                $users[] = new User($userResult);
            }
            return $users;
        }
        return null;
    }

    public function findByUsername(string $username): ?User
    {
        $sql = <<<SQL
            SELECT *
            FROM users
            WHERE username = :username
        SQL;
        $statement = DBManager::execQuery($sql, ['username' => $username]);
        $user = $statement->fetch();
        if ($user) {
            return new User($user);
        }
        return null;
    }

    public function findByEmail(string $email): ?User
    {
        $sql = <<<SQL
            SELECT *
            FROM users
            WHERE email = :email
        SQL;
        $statement = DBManager::execQuery($sql, ['email' => $email]);
        $user = $statement->fetch();
        if ($user) {
            return new User($user);
        }
        return null;
    }

    public function createUserFromEntity(User $user): bool
    {
        $sql = <<<SQL
            INSERT INTO users (username, email, password_hash, profile_img_id)
            VALUES (:username, :email, :password_hash, :profile_img_id)
        SQL;
        $statement = DBManager::execQuery($sql, [
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'password_hash' => $user->getPasswordHash(),
            'profile_img_id' => $user->getProfileImgId(),
        ]);
        return $statement->rowCount() > 0;
    }

    public function createUserFromData(array $userData): bool
    {
        $sql = <<<SQL
            INSERT INTO users (username, email, password_hash, profile_img_id)
            VALUES (:username, :email, :password_hash, :profile_img_id)
        SQL;
        $statement = DBManager::execQuery($sql, [
            'username' => $userData['username'],
            'email' => $userData['email'],
            'password_hash' => password_hash($userData['password'], PASSWORD_DEFAULT),
            'profile_img_id' => $userData['profile_img_id'] ?? null,
        ]);
        return $statement->rowCount() > 0;
    }
}