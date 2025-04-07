<?php
class MessageManager
{
    public function findById(int $id): ?Message
    {
        $sql = <<<SQL
            SELECT *
            FROM messages
            WHERE id = :id
        SQL;
        $statement = DBManager::execQuery($sql, ['id' => $id]);
        $message = $statement->fetch();
        if ($message) {
            return new Message($message);
        }
        return null;
    }
    /**
     * @return Message[] | null
     */
    public function findAll(): ?array
    {
        $sql = <<<SQL
            SELECT *
            FROM messages
        SQL;
        $statement = DBManager::execQuery($sql);
        $messageResults = $statement->fetchAll();
        if ($messageResults) {
            $messages = [];
            foreach ($messageResults as $messageResult) {
                $messages[] = new Message($messageResult);
            }
            return $messages;
        }
        return null;
    }

}