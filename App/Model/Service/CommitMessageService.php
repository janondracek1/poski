<?php


namespace App\Model\Service;


use App\Model\Entity\CommitMessageEntity;
use Nette\Tokenizer\Stream;
use Nette\Tokenizer\Tokenizer;

class CommitMessageService
{

	public const TOKEN_TAG = "TAG";
	public const REGEX_TAG = "\[(\w+)\]";
	public const TOKEN_BRANCH = "BRANCH";
	public const REGEX_BRANCH = "\s@(\w+)";
	public const TOKEN_TASK_ID = "TASK_ID";
	public const REGEX_TASK_ID = "\s#(\d+)";
	public const TOKEN_TITLE = "TITLE";
	public const REGEX_TITLE = "\s(.+)";
	public const TOKEN_DETAIL = "DETAIL";
	public const REGEX_DETAIL = "^\*\s(.+)";
	public const TOKEN_BC_BREAK = "BC_BREAK";
	public const REGEX_BC_BREAK = "BC: (\.+)";
	public const TOKEN_FEATURE = "FEATURE";
	public const REGEX_FEATURE = "Feature: (\.+)";
	public const TOKEN_TODO = "TODO";
	public const REGEX_TODO = "TODO: (\.+)";

	private Tokenizer $tokenizer;

	public function __construct()
	{
		$this->tokenizer = new Tokenizer([
			self::TOKEN_TAG => self::REGEX_TAG,
			self::TOKEN_TASK_ID => self::REGEX_TASK_ID,
			self::TOKEN_TITLE => self::REGEX_TITLE,
			self::TOKEN_BRANCH => self::REGEX_BRANCH,
			self::TOKEN_DETAIL => self::REGEX_DETAIL,
			self::TOKEN_BC_BREAK => self::REGEX_BC_BREAK,
			self::TOKEN_FEATURE => self::REGEX_FEATURE,
			self::TOKEN_TODO => self::REGEX_TODO,
		]);
	}


	public function create(string $commitHash, string $commitMessageString): CommitMessageEntity
	{
		$stream = $this->tokenizer->tokenize($commitMessageString);
	}


	private function getTags(Stream $stream): array
	{

	}


	private function get


	protected function


}