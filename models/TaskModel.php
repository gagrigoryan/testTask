<?php


class TaskModel extends Model
{
    public function create($task) {
        $task['user_name'] = htmlspecialchars($task['user_name']);
        $task['email'] = htmlspecialchars($task['email']);
        $task['text'] = htmlspecialchars($task['text']);
        $task['is_changed'] = 0;
        $task['is_active'] = 0;
        $sql = "INSERT INTO tasks (user_name, email, text, is_active, is_changed) VALUES (:user_name, :email, :text, :is_active, :is_changed)";
        $stmt= $this->db->prepare($sql);
        $stmt->execute($task);

        return json_encode(array('status' => "success", 'message'=> 'task add'));
    }

    public function update($task) {
        $data['text'] = htmlspecialchars($task['text']);
        $data['id'] = $task['id'];
        $data['is_active'] = "0";
        $data['is_changed'] = true;
        if (array_key_exists('is_active', $task)) {
            $data['is_active'] = true;
        }
        var_dump($data);
        $sql = "UPDATE tasks SET text=:text, is_active=:is_active, is_changed=:is_changed WHERE id=:id";
        $stmt= $this->db->prepare($sql);
        $stmt->execute($data);

        //return json_encode(array('status' => "success", 'message'=> 'task update'));
    }
}