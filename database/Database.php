<?php

namespace database;

class Database
{
    public object $connection;

    public function __construct(public string $host, public string $db_name, public string $username, public string $password)
    {

    }

    public function getConnection() : object | string {

        try {

            $dsn = "mysql:host=$this->host;dbname=$this->db_name";

            $options = [
                \PDO::ATTR_EMULATE_PREPARES   => false, // Отключаем эмуляцию подготовленных выражений
                \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION, // Включаем режим выброса исключений при ошибке
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC, // Устанавливаем режим возврата ассоциативных массивов результатов
            ];

            return new \PDO($dsn, $this->username, $this->password, $options);

        } catch (\PDOException $exception) {

            return 'Возникла ошибка при подключении к базе данных! Текст ошибки:' . $exception . '.';

        }

    }
}