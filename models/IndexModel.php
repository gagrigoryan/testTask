<?php


class IndexModel extends Model
{
    public function getTasks() {
        $sql = "SELECT * FROM tasks";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($res)) {
            return $res;
        } else {
            return false;
        }
    }

}