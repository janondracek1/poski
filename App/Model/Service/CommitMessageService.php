<?php


namespace App\Model\Service;


use App\Model\Entity\CommitMessageEntity;

class CommitMessageService
{

	public const REGEX_TAG = "/\[(\w+)\]/";
	public const REGEX_TASK_ID = "/\#(\d+)/";
	public const REGEX_TITLE = "/\s([A-Za-z].+)$/m";
	public const REGEX_DETAIL = "/^\*\s(.+)$/m";
	public const REGEX_BC_BREAK = "/^BC: (.+)$/m";
	public const REGEX_FEATURE = "/^Feature: (.+)$/m";
	public const REGEX_TODO = "/^TODO: (.+)$/m";

	public function __construct()
	{
	}


	public function create(string $commitHash, string $commitMessage): CommitMessageEntity
	{
		[$commitMessageFirstLine, $commitMessage] = $this->prepareMessage($commitMessage);
		//first-line only
		$arrayTag = $this->parseValues($commitMessageFirstLine, self::REGEX_TAG);
		$taskId = $this->parseValues($commitMessageFirstLine, self::REGEX_TASK_ID)[0] ?? null;
		$title = $this->parseValues($commitMessageFirstLine, self::REGEX_TITLE)[0];
		//rest of lines
		$arrayDetail = $this->parseValues($commitMessage, self::REGEX_DETAIL);
		$arrayBCBreak = $this->parseValues($commitMessage, self::REGEX_BC_BREAK);
		$arrayFeature = $this->parseValues($commitMessage, self::REGEX_FEATURE);
		$arrayTodo = $this->parseValues($commitMessage, self::REGEX_TODO);
		$commitMessageEntity = new CommitMessageEntity(
			$commitHash,
			$title,
			$taskId,
			$arrayTag,
			$arrayDetail,
			$arrayBCBreak,
			$arrayTodo,
			$arrayFeature
		);

		return $commitMessageEntity;
	}


	protected function prepareMessage(string $commitMessage): array
	{
		$commitMessageLines = [];
		preg_match_all('/^(.+)$/m', $commitMessage, $commitMessageLines);
		$commitMessageLines = $commitMessageLines[1];
		$commitMessageFirstLine = array_shift($commitMessageLines);
		$commitMessage = implode(PHP_EOL, $commitMessageLines);
		return [$commitMessageFirstLine, $commitMessage];
	}


	private function parseValues(string $commitMessage, string $regex): array
	{
		$matches = [];
		preg_match_all($regex, $commitMessage, $matches);
		$matches = array_map(function($match){
			return rtrim($match);
		}, $matches[1] ?? []);

		return $matches;
	}


}