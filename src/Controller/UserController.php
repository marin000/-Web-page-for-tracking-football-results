<?php

namespace App\Controller;
use App\Entity\User;
use App\Entity\Comments;
use App\Entity\FavClubs;
use App\Entity\FavPlayer;
use App\Entity\FavMatches;
use App\Entity\Predictions;
use App\Entity\Quiz;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\FootballData;
use Symfony\Component\Validator\Constraints\DateTime;
use Carbon\Carbon;
use App\Form\MatchdayFormType;
use App\Entity\CompetitionInfo;

class UserController extends AbstractController
{
    /**
     * @Route("/user/", name="user")
     */
    public function user()
    {
        $user=$this->getUser();

        $predictions=$user->getPredictions();

        $api = new FootballData();
        $result=0;
        foreach ($predictions as $match)
        {
            if($match->getChecked()==0)
            {
                $tmpId=$match->getMatchId();
                $tmp=$api->findMatchById($tmpId);
                if($tmp->match->status == "FINISHED")
                {
                    if($tmp->match->score->winner == $match->getPred())
                    {
                        $result=$result+3;
                    }
                    $match->setChecked(true);
                    flush();
                }
            }
        }

        $em = $this->getDoctrine()->getManager();
        $userUpd = $em->getRepository(User::class)->find($user);
        $result = $result+$userUpd->getResult();

        $userUpd->setResult($result);
        $em->flush();

        $doctrine = $this->getDoctrine();
        $repository = $doctrine->getRepository(User::class);
        $usersResults = $repository->getAllUsersSortedByResult();

        return $this->render("myProfile/user-results.html.twig",[
        'user' => $user,
        'id' => 100,
        'usersResults' => $usersResults,
        ]);
    }

    /**
     * @Route("/favourites/", name="userFavourites")
     */
    public function userFavourites()
    {
        $user=$this->getUser();

        $favClubs=$user->getFavClubs();
        $favPlayers=$user->getFavPlayers();
        $favMatches=$user->getFavMatches();

        $arrMatch=array();
        $api = new FootballData();
        foreach ($favMatches as $match) {
            $tmpId=$match->getMatchId();
            $tmp=$api->findMatchById($tmpId);
            array_push($arrMatch,$tmp);
        }

        return $this->render("myProfile/user-favourites.html.twig",[
        'user' => $user,
        'favClubs' => $favClubs,
        'favPlayers' => $favPlayers,
        'arrMatch' => $arrMatch,
        'favMatches' => $favMatches,
        'id'=> 101,
        ]);
    }

    /**
     * @Route("/favourites/delClub/{cid}",name="delFavClub")
     */
    public function delFavClub($cid)
    {
        $doctrine = $this->getDoctrine();
        $repository = $doctrine->getRepository(FavClubs::class);
        $club = $repository->find($cid);

        $user=$this->getUser();
        $user->removeFavClub($club);
        
        $u = $doctrine->getManager();
        $u->remove($club);
        $u->flush();

        return $this->redirectToRoute('userFavourites', []);
    }


    /**
     * @Route("/favourites/delPlayer/{pid}",name="delFavPlayer")
     */
    public function delFavPlayer($pid)
    {
        $doctrine = $this->getDoctrine();
        $repository = $doctrine->getRepository(FavPlayer::class);
        $player = $repository->find($pid);

        $user=$this->getUser();
        $user->removeFavPlayer($player);
        
        $u = $doctrine->getManager();
        $u->remove($player);
        $u->flush();

        return $this->redirectToRoute('userFavourites', []);
    }

     /**
     * @Route("/favourites/delMatch/{mid}",name="delFavMatch")
     */
    public function delFavMatch($mid)
    {
        $user=$this->getUser();

        $doctrine = $this->getDoctrine();
        $repository = $doctrine->getRepository(FavMatches::class);
        $match = $repository->find($mid);

        $user->removeFavMatch($match);
        
        $u = $doctrine->getManager();
        $u->remove($match);
        $u->flush();

        return $this->redirectToRoute('userFavourites', []);
    }

    /**
     * @Route("/comments/", name="userComments")
     */
    public function userComments(Request $request)
    {
        $user=$this->getUser();

       $comments = $this->getDoctrine()
            ->getRepository(Comments ::class)
            ->findAllByTime();

        if(isset($_POST['newComment'])) 
        {
            $content=$_POST['newComment'];
            $time=time();
            $time = date("H:i:s", $time);

            $newComment = new Comments();
            $newComment
                ->setUserId($user)
                ->setContent($content)
                ->setTime(\DateTime::createFromFormat('H:i:s', $time));

            $doctrine = $this->getDoctrine();
            $u = $doctrine->getManager();
            $u->persist($newComment);
            $u->flush();

            return $this->redirectToRoute('userComments', [
                'user' => $user,
                'comments' => $comments
                ]);

        }

        return $this->render("myProfile/user-comments.html.twig",[
        'user' => $user,
        'comments' => $comments,
        'id' => 103,
        ]);
    }

    /**
     * @Route("/predictions/", name="userPredict")
     */
    public function userPredict(Request $request)
    {
        $user=$this->getUser();

        $api = new FootballData();

        $now = date_create();
        $end = date_create(); 
        date_add($end,date_interval_create_from_date_string("3 days"));
        $response = $api->findMatchesForDateRange(date_format($now, "Y-m-d"),date_format($end, "Y-m-d"));

        $predictions=$user->getPredictions();

        $arrPred=array();
        $api = new FootballData();
        foreach ($predictions as $match)
        {
            $tmpId=$match->getMatchId();
            $tmp=$api->findMatchById($tmpId);
            array_push($arrPred,$tmp);
        }

        return $this->render("myProfile/user-predict.html.twig",[
            "response" => $response,
            "user" => $user,
            "arrPred" => $arrPred,
            "predictions" => $predictions,
            'id' => 102,
        ]);
    }

    /**
     * @Route("/predictions/{mid}/{pred}",name="userPredictSave")
     */
    public function userPredictSave($mid,$pred)
    {
        $user=$this->getUser();

        $newPred = new Predictions();
        $newPred
            ->addUserId($user)
            ->setMatchId($mid)
            ->setPred($pred)
            ->setChecked(false);

        $doctrine = $this->getDoctrine();
        $u = $doctrine->getManager();
        $u->persist($newPred);
        $u->flush();

        return $this->redirectToRoute('userPredict', []);
    }

    /**
     * @Route("/quiz/",name="userQuiz")
     */
    public function userQuiz()
    {
        $user=$this->getUser();

        $doctrine = $this->getDoctrine();
        $quiz = $doctrine->getRepository(Quiz::class)->findOneBy([]);

        $result=0;

        if(isset($_POST['submit'])) 
        {
            if(($_POST['ans1'] == $quiz->getAns1correct()) &&
             ($_POST['ans2'] == $quiz->getAns2correct()) &&
             ($_POST['ans3'] == $quiz->getAns3correct()) &&
             ($_POST['ans4'] == $quiz->getAns4correct()) &&
             ($_POST['ans5'] == $quiz->getAns5correct())) 
            {
                $result = $result+5;
                $this->addFlash('success', 'Congratulations! You have answered correctly on all questions.');
            }
            else
            {
                $this->addFlash('warning', "You have not answered all the questions correctly.
                Correct answers: 1-" . $quiz->getAns1correct()[4] . ", 2-" . $quiz->getAns2correct()[4] . 
                ", 3-" . $quiz->getAns3correct()[4] . ", 4-". $quiz->getAns4correct()[4] . 
                ", 5-" . $quiz->getAns5correct()[4]);
            }
            $arr=array();
            $arr=$quiz->getArrUsers();
            array_push($arr,$user->getId());

            $quiz->setArrUsers($arr);
            flush();
        }

        $em = $this->getDoctrine()->getManager();
        $userUpd = $em->getRepository(User::class)->find($user);
        $result = $result+$userUpd->getResult();

        $userUpd->setResult($result);
        $em->flush();

        return $this->render("myProfile/user-quiz.html.twig",[
            "user" => $user,
            "quiz" => $quiz,
            'id' => 104,
        ]);
    }
}