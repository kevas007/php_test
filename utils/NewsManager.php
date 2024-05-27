<?php

class NewsManager
{
    // Singleton instance
    private static $instance = null;

    // Private constructor to prevent direct object creation
    private function __construct()
    {
        require_once(ROOT . '/utils/DB.php');
        require_once(ROOT . '/utils/CommentManager.php');
        require_once(ROOT . '/class/News.php');
    }

    // Get the singleton instance of the NewsManager class
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * List all news
     * @return array An array of News objects
     */
    public function listNews(): array
    {
        $db = DB::getInstance();
        $rows = $db->select('SELECT * FROM `news`');

        $news = [];
        foreach ($rows as $row) {
            $n = new News();
            $news[] = $n->setId($row['id'])
                        ->setTitle($row['title'])
                        ->setBody($row['body'])
                        ->setCreatedAt($row['created_at']);
        }

        return $news;
    }

    /**
     * Add a record in news table
     * @param string $title The title of the news
     * @param string $body The body content of the news
     * @return string The ID of the newly inserted news record
     */
    public function addNews(string $title, string $body): string
    {
        $db = DB::getInstance();
        $sql = "INSERT INTO `news` (`title`, `body`, `created_at`) VALUES (:title, :body, :created_at)";
        $params = [
            ':title' => $title,
            ':body' => $body,
            ':created_at' => date('Y-m-d')
        ];
        $db->exec($sql, $params);
        return $db->lastInsertId();
    }

    /**
     * Delete a news record and its linked comments
     * @param int $id The ID of the news to be deleted
     * @return int The number of rows affected
     */
    public function deleteNews(int $id): int
    {
        // Delete linked comments first
        $comments = CommentManager::getInstance()->listComments();
        $idsToDelete = [];

        foreach ($comments as $comment) {
            if ($comment->getNewsId() == $id) {
                $idsToDelete[] = $comment->getId();
            }
        }

        foreach ($idsToDelete as $commentId) {
            CommentManager::getInstance()->deleteComment($commentId);
        }

        // Delete the news record
        $db = DB::getInstance();
        $sql = "DELETE FROM `news` WHERE `id` = :id";
        $params = [':id' => $id];
        return $db->exec($sql, $params);
    }
}

?>
