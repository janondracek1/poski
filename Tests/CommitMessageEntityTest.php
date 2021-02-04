<?php
declare(strict_types=1);

namespace Tests;
use App\Model\Service\CommitMessageService;
use PHPUnit\Framework\TestCase;

include_once __DIR__ . '/../vendor/autoload.php';

class CommitMessageEntityTest extends TestCase
{
	/**
	 * @dataProvider validCommitMessageDataProvider
	 */
	public function testValidCommitMessage(string $commitHash, string $commitMessage): void
	{
		$class = $this->createMock(CommitMessageService::class);
		$class->create($commitHash, $commitMessage);
	}


	public function validCommitMessageDataProvider(): array
	{
		return [
			[
				"12071ef6d091a6fcc969ad7a363e1757",
				"
[add] [feature] @core #123456 Integrovat Premier: export objednávek

* Export objednávek cronem co hodinu.
* Export probíhá v dávkách.
* ...

BC: Refaktorovaný BaseImporter.
BC: ...

Feature: Nový logger.

TODO: Refactoring autoemail modulu."
			]
		];
	}


	/**
	 * @dataProvider invalidCommitMessageDataProvider
	 */
	public function testInvalidCommitMessage(): void
	{

	}


	public function invalidCommitMessageDataProvider(): array
	{
		return [

		];
	}


}