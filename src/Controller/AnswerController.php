<?php

namespace App\Controller;

use App\Entity\Answer;
use App\Repository\AnswerRepository;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AnswerController extends AbstractController
{
    /**
     * @Route("/answers/{id}/vote", methods="POST", name="answer_vote")
     */
    public function commentVote(Answer $answer , $id, $direction, LoggerInterface $logger)
    {
        // todo - use id to query the database

        // use real logic here to save this to the database
        if ($direction === 'up') {
            $logger->info('Voting up!');
            $answer->setVotes($answer->getVotes()+1);
        } else {
            $logger->info('Voting down!');
            $answer->setVotes($answer->getVotes()-1);
        }

        return $this->json(['votes' => $answer->getVotes()]);
    }

    /**
     * @Route("/answers/popular", name="app_popular_answers")
     */
    public function popularAnswers(AnswerRepository $answerRepository, Request $request)
    {

        $answer = $answerRepository->findMostPopular(
            $request->query->get('q')
        );
        return $this->render('answer/popularAnswers.html.twig',[
            'answers' => $answer
        ]);
    }

}
