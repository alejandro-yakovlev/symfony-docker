<?php

namespace App\Tests\Functional\Testing\Domain\Entity\TestingSession;

use App\Shared\Domain\Service\UlidService;
use App\Shared\Domain\ValueObject\GlobalUserId;
use App\Testing\Domain\Entity\Test\AnswerOption;
use App\Testing\Domain\Entity\Test\DifficultyLevel;
use App\Testing\Domain\Entity\Test\Question;
use App\Testing\Domain\Entity\Test\QuestionType;
use App\Testing\Domain\Entity\Test\Test;
use App\Testing\Domain\Entity\TestingSession\TestingSession;
use App\Testing\Domain\Entity\TestingSession\UserAnswer;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TestingSessionCompletionTest extends WebTestCase
{
    /**
     * Процент правильно отвеченных вопросов является верным после завершения сессии тестирования.
     *
     * @dataProvider myDataProvider
     */
    public function test_correct_answer_percentage_is_correctly_after_completion(
        array $testData,
        int $expectedCorrectAnswerPercentage
    ): void {
        $creatorId = UlidService::generate();
        $testedUserId = UlidService::generate();

        $creator = new GlobalUserId($creatorId);
        $test = new Test(
            $creator, $testData['name'], $testData['description'], DifficultyLevel::EASY, UlidService::generate()
        );

        $user = new GlobalUserId($testedUserId);
        $testingSession = new TestingSession($test, $user);

        foreach ($testData['questions'] as $questionData) {
            $question = new Question($test, $questionData['description'], 1, $questionData['type']);
            $userAnswer = new UserAnswer($testingSession, $question);

            foreach ($questionData['answerOptions'] as $answerOptionData) {
                $answerOption = new AnswerOption(
                    $question,
                    $answerOptionData['description'],
                    $answerOptionData['isCorrect']
                );
                $question->addAnswerOption($answerOption);

                if ($answerOptionData['isSelectedByUser']) {
                    $userAnswer->addAnswerOption($answerOption);
                }
            }

            $testingSession->addAnswer($userAnswer);
            $test->addQuestion($question);
        }

        $testingSession->complete();

        $this->assertEquals($expectedCorrectAnswerPercentage, $testingSession->getCorrectAnswersPercentage());
    }

    public function myDataProvider(): array
    {
        return [
            [
                'test' => [
                    'name' => '',
                    'description' => '',
                    'questions' => [
                        [
                            'description' => '',
                            'type' => QuestionType::MULTIPLE_CHOICE,
                            'answerOptions' => [
                                [
                                    'description' => '',
                                    'isCorrect' => true,
                                    'isSelectedByUser' => true,
                                ],
                                [
                                    'description' => '',
                                    'isCorrect' => false,
                                    'isSelectedByUser' => false,
                                ],
                            ],
                        ],
                        [
                            'description' => '',
                            'type' => QuestionType::MULTIPLE_CHOICE,
                            'answerOptions' => [
                                [
                                    'description' => '',
                                    'isCorrect' => true,
                                    'isSelectedByUser' => true,
                                ],
                                [
                                    'description' => '',
                                    'isCorrect' => false,
                                    'isSelectedByUser' => false,
                                ],
                            ],
                        ],
                    ],
                ],
                'expectedCorrectAnswersPercentage' => 100,
            ],
            [
                'test' => [
                    'name' => '',
                    'description' => '',
                    'questions' => [
                        [
                            'description' => '',
                            'type' => QuestionType::MULTIPLE_CHOICE,
                            'answerOptions' => [
                                [
                                    'description' => '',
                                    'isCorrect' => true,
                                    'isSelectedByUser' => true,
                                ],
                                [
                                    'description' => '',
                                    'isCorrect' => false,
                                    'isSelectedByUser' => false,
                                ],
                            ],
                        ],
                        [
                            'description' => '',
                            'type' => QuestionType::MULTIPLE_CHOICE,
                            'answerOptions' => [
                                [
                                    'description' => '',
                                    'isCorrect' => true,
                                    'isSelectedByUser' => false,
                                ],
                                [
                                    'description' => '',
                                    'isCorrect' => false,
                                    'isSelectedByUser' => true,
                                ],
                            ],
                        ],
                    ],
                ],
                'expectedCorrectAnswersPercentage' => 50,
            ],
        ];
    }
}
