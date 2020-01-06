<?php
declare(strict_types=1);

namespace Ticket\Application\UseCase\EditComment;

class EditCommentCommand
{
    private string $commentId;
    private string $content;
    private string $authorId;

    public function __construct(string $commentId, string $content, string $authorId)
    {
        $this->commentId = $commentId;
        $this->content = $content;
        $this->authorId = $authorId;
    }

    public function commentId(): string
    {
        return $this->commentId;
    }

    public function content(): string
    {
        return $this->content;
    }

    public function authorId(): string
    {
        return $this->authorId;
    }
}