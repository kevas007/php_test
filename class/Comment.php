<?php

class Comment
{
    // Properties
    protected $id;
    protected $body;
    protected $createdAt;
    protected $newsId;

    // Set the comment ID
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    // Get the comment ID
    public function getId()
    {
        return $this->id;
    }

    // Set the comment body
    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }

    // Get the comment body
    public function getBody()
    {
        return $this->body;
    }

    // Set the creation date of the comment
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    // Get the creation date of the comment
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    // Set the associated news ID
    public function setNewsId($newsId)
    {
        $this->newsId = $newsId;
        return $this;
    }

    // Get the associated news ID
    public function getNewsId()
    {
        return $this->newsId;
    }
}

?>
