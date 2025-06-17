<?php

namespace App\Models\TableModel;

use CodeIgniter\Model;

class ActivityModel extends Model
{
    public function getUserActivities($userId)
    {
        $db = \Config\Database::connect();

        $sql = "
            SELECT 
                'task' AS type,
                id,
                title,
                description,
                created_at
            FROM 
                tasks
            WHERE 
                user_id = ?

            UNION ALL

            SELECT 
                'Event' AS type,
                id,
                title,
                NULL AS description,
                created_at
            FROM 
                calendar_events
            WHERE 
                user_id =  ?

            ORDER BY 
                created_at DESC;
        ";

        $query = $db->query($sql, [$userId, $userId]);
        return $query->getResultArray();
    }
}
