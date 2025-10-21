<?php
class DBManager
{
    private static $pdo;

    public static function getPDO(): PDO {
        if (self::$pdo === null) {
            self::$pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PWD); 
        }
        return self::$pdo;
    }

    public static function execQuery($sql, $params = []): PDOStatement {
        $pdo = self::getPDO();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $statement = $pdo->prepare($sql);
        $statement->execute($params);
        return $statement;
    }

    public static function getLastInsertId(): int {
        $pdo = self::getPDO();
        return (int)$pdo->lastInsertId();
    }
}