<?php

namespace App\DataFixtures;

use App\Entity\Answer;
use App\Entity\Question;
use App\Factory\AnswerFactory;
use App\Factory\QuestionFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        QuestionFactory::new()->createMany(20);

        QuestionFactory::new()->unpublished()->createMany(5);

        $answer = new Answer();
        $answer->setContent('ez egy tökéletes leirása annak amit csinálok');
        $answer->setUsername('kaszagyerek');


        $question = new Question();
        $question->setName('how to un diaapperat your waller');
        $question->setQuestion('....i sould not habe done this...');

        $answer->setQuestion($question);

        $manager->persist($answer);
        $manager->persist($question);

        AnswerFactory::createMany(100);
        AnswerFactory::new()->needsApproval()->many(20)->create();

        $manager->flush();
    }
}
