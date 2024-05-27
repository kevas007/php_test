<?php

class News
{
    // Properties
    protected $id;
    protected $title;
    protected $body;
    protected $createdAt;

    // Set the news ID
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    // Get the news ID
    public function getId()
    {
        return $this->id;
    }

    // Set the news title
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    // Get the news title
    public function getTitle()
    {
        return $this->title;
    }

    // Set the news body
    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }

    // Get the news body
    public function getBody()
    {
        return $this->body;
    }

    // Set the creation date of the news
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    // Get the creation date of the news
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}

?>
