<?php

// Define the root directory
define('ROOT', __DIR__);

// Include required classes
require_once(ROOT . '/utils/NewsManager.php');
require_once(ROOT . '/utils/CommentManager.php');

// Get instance of NewsManager and CommentManager
$newsManager = NewsManager::getInstance();
$commentManager = CommentManager::getInstance();

// List all news and their comments
foreach ($newsManager->listNews() as $news) {
    echo "############ NEWS " . $news->getTitle() . " ############\n";
    echo $news->getBody() . "\n";

    // List comments for the current news
    foreach ($commentManager->listComments() as $comment) {
        if ($comment->getNewsId() == $news->getId()) {
            echo "Comment " . $comment->getId() . " : " . $comment->getBody() . "\n";
        }
    }
}

// List all comments (if needed for further operations)
$comments = $commentManager->listComments();
