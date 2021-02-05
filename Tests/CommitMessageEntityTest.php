<?php
declare(strict_types=1);

namespace Tests;
use App\Model\Service\CommitMessageService;
use PHPUnit\Framework\TestCase;

include_once __DIR__ . '/../vendor/autoload.php';

class CommitMessageEntityTest extends TestCase
{

	protected CommitMessageService $commitMessageService;


	public function setUp(): void
	{
		parent::setUp(); // TODO: Change the autogenerated stub
		$this->commitMessageService = new CommitMessageService();
	}


	/**
	 * @dataProvider validCommitMessageDataProvider
	 */
	public function testValidCommitMessage(
		string $commitHash,
		string $commitMessage,
		string $expectedCommitHash,
		array $expectedTags,
		?int $expectedTaskId,
		string $expectedTitle,
		array $expectedDetails,
		array $expectedBcBreaks,
		array $expectedTodos,
	): void
	{
		$commitMessageEntity = $this->commitMessageService->create($commitHash, $commitMessage);
		$this->assertEquals($expectedCommitHash, $commitMessageEntity->getCommitHash());
		$this->assertEqualsCanonicalizing($expectedTags, $commitMessageEntity->getTags());
		$this->assertSame($expectedTitle, $commitMessageEntity->getTitle());
		$this->assertSame($expectedTaskId, $commitMessageEntity->getTaskId());
		$this->assertEqualsCanonicalizing($expectedDetails, $commitMessageEntity->getDetails());
		$this->assertEqualsCanonicalizing($expectedBcBreaks, $commitMessageEntity->getBcBreaks());
		$this->assertEqualsCanonicalizing($expectedTodos, $commitMessageEntity->getTodos());
	}


	public function validCommitMessageDataProvider(): array
	{
		return [
			[
				"12071ef6d091a6fcc969ad7a363e1757",
				"[add] [feature] @core #123456 Integrovat Premier: export objednávek

* Export objednávek cronem co hodinu.
* Export probíhá v dávkách.

BC: Refaktorovaný BaseImporter.

Feature: Nový logger.

TODO: Refactoring autoemail modulu.",
				"12071ef6d091a6fcc969ad7a363e1757",
				['add', 'feature'],
				123456,
				"Integrovat Premier: export objednávek",
				['Export objednávek cronem co hodinu.', 'Export probíhá v dávkách.'],
				['Refaktorovaný BaseImporter.'],
				['Refactoring autoemail modulu.'],
			],
			[
				"9503747639e026d449025a335648089c",
				"[test] [implementation] [beta] Test implementation - WIP

* Tohle tu má co dělat
- Tohle tu nemá co dělat

TODO: FIX
TODO: Implement
DOTO: I don't know",
				"9503747639e026d449025a335648089c",
				['test', 'implementation', 'beta'],
				null,
				"Test implementation - WIP",
				['Tohle tu má co dělat'],
				[],
				['FIX', 'Implement'],
			],
			[
				"69309c7712b6f01beb8d135f6e0ec4b3",
				"Title

- this will be ommited

OMITME: this as well",
				"69309c7712b6f01beb8d135f6e0ec4b3",
				[],
				null,
				"Title",
				[],
				[],
				[],
			],
		];
	}


	/**
	 * @dataProvider invalidTitleCommitMessageDataProvider
	 */
	public function testInvalidTitleCommitMessage(string $commitHash, string $commitMessage): void
	{
		$this->expectException(\TypeError::class);
		$this->commitMessageService->create($commitHash, $commitMessage);
	}


	public function invalidTitleCommitMessageDataProvider(): array
	{
		return [
			[
				"69309c7712b6f01beb8d135f6e0ec4b3",
				"[tag1] [tag2]
				
* Export objednávek cronem co hodinu.
* Export probíhá v dávkách.

BC: Refaktorovaný BaseImporter.

Feature: Nový logger.

TODO: Refactoring autoemail modulu.
				",
				"69309c7712b6f01beb8d135f6e0ec4b3",
			],
		];
	}


}