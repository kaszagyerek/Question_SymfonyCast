<?php

namespace App\Controller;

use App\Entity\Answer;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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
}
