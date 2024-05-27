<?php

class CommentManager
{
    private static $instance = null;

    // Private constructor to prevent multiple instances
    private function __construct()
    {
        require_once(ROOT . '/utils/DB.php');
        require_once(ROOT . '/class/Comment.php');
    }

    // Singleton pattern to get the single instance of CommentManager
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    // List all comments
    public function listComments()
    {
        $db = DB::getInstance();
        $rows = $db->select('SELECT * FROM `comment`');

        $comments = [];
        foreach ($rows as $row) {
            $comment = new Comment();
            $comments[] = $comment->setId($row['id'])
                                  ->setBody($row['body'])
                                  ->setCreatedAt($row['created_at'])
                                  ->setNewsId($row['news_id']);
        }

        return $comments;
    }

    // Add a comment for a specific news item
    public function addCommentForNews($body, $newsId)
    {
        $db = DB::getInstance();
        $sql = "INSERT INTO `comment` (`body`, `created_at`, `news_id`) VALUES (:body, :created_at, :news_id)";
        $params = [
            ':body' => $body,
            ':created_at' => date('Y-m-d'),
            ':news_id' => $newsId
        ];
        $db->exec($sql, $params);
        return $db->lastInsertId();
    }

    // Delete a comment by ID
    public function deleteComment($id)
    {
        $db = DB::getInstance();
        $sql = "DELETE FROM `comment` WHERE `id` = :id";
        $params = [':id' => $id];
        return $db->exec($sql, $params);
    }
}

?>
