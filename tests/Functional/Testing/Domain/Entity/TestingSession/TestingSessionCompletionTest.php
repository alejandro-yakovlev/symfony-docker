<?php

namespace App\Tests\Functional\Testing\Domain\Entity\TestingSession;

use App\Shared\Domain\Service\UlidService;
use App\Testing\Domain\Aggregate\Test\AnswerOption;
use App\Testing\Domain\Aggregate\Test\DifficultyLevel;
use App\Testing\Domain\Aggregate\Test\Question;
use App\Testing\Domain\Aggregate\Test\QuestionType;
use App\Testing\Domain\Aggregate\TestingSession\TestingSession;
use App\Testing\Domain\Aggregate\TestingSession\UserAnswer;
use App\Testing\Domain\Factory\TestFactory;
use App\Tests\Tools\DITools;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TestingSessionCompletionTest extends WebTestCase
{
    use DITools;

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

        $testFactory = $this->getService(TestFactory::class);
        $test = $testFactory->create(
            $creatorId,
            $testData['name'],
            $testData['description'],
            DifficultyLevel::EASY,
            100,
            UlidService::generate()
        );

        $questionUserAnsweredOptions = [];

        foreach ($testData['questions'] as $questionData) {
            $question = new Question($test, $questionData['name'], $questionData['description'], $questionData['type']);

            foreach ($questionData['answerOptions'] as $answerOptionData) {
                $answerOption = new AnswerOption(
                    $question,
                    $answerOptionData['description'],
                    $answerOptionData['isCorrect']
                );
                $question->addAnswerOption($answerOption);

                if ($answerOptionData['isSelectedByUser']) {
                    $questionUserAnsweredOptions[$question->getId()][] = $answerOption;
                }
            }

            $test->addQuestion($question);
        }

        $testingSession = new TestingSession($test, $testedUserId);
        foreach ($testingSession->getTest()->getQuestions() as $question) {
            $userAnswer = new UserAnswer($testingSession, $question);
            foreach ($questionUserAnsweredOptions[$question->getId()] as $answerOption) {
                $userAnswer->addAnswerOption($answerOption);
            }
            $testingSession->addAnswer($userAnswer);
        }

        //        $testingSession->complete();

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
                            'name' => '',
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
                            'name' => '',
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
                            'name' => '',
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
                            'name' => '',
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
