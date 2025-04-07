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

}