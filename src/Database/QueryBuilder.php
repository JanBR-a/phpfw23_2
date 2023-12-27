<?php

namespace App\Database;
class QueryBuilder{
    private $selectables=[];
    private $table;
    private $whereClause;
    private $limit;
    protected $pdo;

    function __construct($pdo)
    {
        $this->pdo=$pdo;
    }

    function selectAll($table){
        $statement = $this->pdo->prepare("select * from {$table}");
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_CLASS);
    }

    public function insert(string $table, array $data): bool {
        $fields = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));
        
        $query = "INSERT INTO $table ($fields) VALUES ($placeholders)";
        $statement = $this->pdo->prepare($query);

        return $statement->execute($data);
    }

    public function select(string $table, array $conditions = [], array $fields = ['*']): array {
        $fields = implode(', ', $fields);
        $query = "SELECT $fields FROM $table";

        if (!empty($conditions)) {
            $query .= " WHERE ";
            $conditionsStrings = [];
            foreach ($conditions as $field => $value) {
                $conditionsStrings[] = "$field = :$field";
            }
            $query .= implode(' AND ', $conditionsStrings);
        }

        $statement = $this->pdo->prepare($query);
        $statement->execute($conditions);

        return $statement->fetchAll(\PDO::FETCH_CLASS);
    }

    public function delete(string $table, array $conditions): int {
        $query = "DELETE FROM $table WHERE ";
        $conditionsStrings = [];
        foreach ($conditions as $field => $value) {
            $conditionsStrings[] = "$field = :$field";
        }
        $query .= implode(' AND ', $conditionsStrings);

        $statement = $this->pdo->prepare($query);
        $statement->execute($conditions);

        return $statement->rowCount();
    }

    public function update(string $table, array $data, array $conditions): int {
        $fields = [];
        foreach ($data as $field => $value) {
            $fields[] = "$field = :$field";
        }
        $fields = implode(', ', $fields);

        $query = "UPDATE $table SET $fields WHERE ";
        $conditionsStrings = [];
        foreach ($conditions as $field => $value) {
            $conditionsStrings[] = "$field = :$field";
        }
        $query .= implode(' AND ', $conditionsStrings);

        $statement = $this->pdo->prepare($query);
        $mergedData = array_merge($data, $conditions);
        $statement->execute($mergedData);

        return $statement->rowCount();
    }

    public function findById(string $table, int $id): ?array {
        return $this->select($table, ['id' => $id])[0] ?? null;
    }
}