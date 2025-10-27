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

    public function findAllConvosByUserId(int $userId): ?array
    {
        $sql = <<<SQL
            SELECT u.id AS user_id, u.profile_img_id AS user_profile_img_id, u.username AS username, m.id AS message_id, m.content AS last_message_content
            FROM messages m 
            JOIN ( 
                SELECT GREATEST(sender_id, receiver_id) AS participant1,
                        LEAST(sender_id, receiver_id) AS participant2,
                        MAX(created_at) AS latest_message_time
                FROM messages
                GROUP BY GREATEST(sender_id, receiver_id), LEAST(sender_id, receiver_id)
                ) latest ON 
                GREATEST(m.sender_id, m.receiver_id) = latest.participant1
                AND LEAST(m.sender_id, m.receiver_id) = latest.participant2
                AND m.created_at = latest.latest_message_time
            LEFT JOIN users u ON (u.id = CASE WHEN m.sender_id = :userId THEN m.receiver_id ELSE m.sender_id END)
            WHERE participant1 = :userId OR participant2 = :userId;
        SQL;
        $statement = DBManager::execQuery($sql, ['userId' => $userId]);
        $conversationResults = $statement->fetchAll();
        if ($conversationResults) {
            $conversations = [];
            foreach ($conversationResults as $conversationResult) {
                $userManager = new UserManager();
                $user = $userManager->findById($conversationResult['user_id']); 
                $messageManager = new MessageManager();
                $message = $messageManager->findById($conversationResult['message_id']);
                $conversations[] = ['user' => $user, 'last_message' => $message];
            }
            return $conversations;
        }
        return null;
    }

    /**
     * @return Message[]
     */
    public function findAllBetweenUsers(User $user, ?User $recipient): array {
        $sql = <<<SQL
            SELECT *
            FROM messages
            WHERE (sender_id = :user AND receiver_id = :recipient)
               OR (sender_id = :recipient AND receiver_id = :user)
            ORDER BY created_at ASC
        SQL;
        $statement = DBManager::execQuery($sql, [
            'user' => $user->getId(),
            'recipient' => $recipient ? $recipient->getId() : 0,
        ]);
        $messageResults = $statement->fetchAll();
        if ($messageResults) {
            $messages = [];
            foreach ($messageResults as $messageResult) {
                $messages[] = new Message($messageResult);
            }
            return $messages;
        }
        return [];
    }

}