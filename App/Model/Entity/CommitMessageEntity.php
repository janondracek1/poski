<?php


namespace App\Model\Entity;


class CommitMessageEntity implements ICommitMessageEntity
{


	public function __construct(
		private string $commitHash,
		private string $title,
		private ?int $taskId,
		private array $tags,
		private array $details,
		private array $bcBreaks,
		private array $todos,
	) {
	}


	public function getCommitHash(): string
	{
		return $this->commitHash;
	}


	public function getTitle(): string
	{
		return $this->title;
	}


	public function getTaskId(): ?int
	{
		return $this->taskId;
	}


	public function getTags(): array
	{
		return $this->tags;
	}


	public function getDetails(): array
	{
		return $this->details;
	}


	public function getBcBreaks(): array
	{
		return $this->bcBreaks;
	}


	public function getTodos(): array
	{
		return $this->todos;
	}



}