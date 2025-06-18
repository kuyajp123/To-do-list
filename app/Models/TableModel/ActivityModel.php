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
                NULL AS start,
                NULL AS end,
                NULL AS all_day,
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
                start,
                end,
                all_day,
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

    public function searchActivities($query)
    {
        $db = \Config\Database::connect();

        $sql = "
            SELECT 
                'task' AS type,
                id,
                title,
                description,
                NULL AS start,
                NULL AS end,
                NULL AS all_day,
                created_at
            FROM 
                tasks
            WHERE 
                title LIKE ?

            UNION ALL

            SELECT 
                'Event' AS type,
                id,
                title,
                NULL AS description,
                start,
                end,
                all_day,
                created_at
            FROM 
                calendar_events
            WHERE 
                title LIKE ?

            ORDER BY 
                created_at DESC;
        ";

        $query = $db->query($sql, ["%$query%", "%$query%"]);
        return $query->getResultArray();
    }
}
