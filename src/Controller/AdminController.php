<?php

namespace App\Controller;
use App\Entity\User;
use App\Entity\Comments;
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

class AdminController extends AbstractController
{
    /**
     * @Route("/admin/", name="admin")
     */
    public function admin(Request $request)
    {
        $user=$this->getUser();

        return $this->render("myProfile/admin.html.twig",[
        'user' => $user,
        'id' => null,
        ]);
    }

    /**
     * @Route("/admin/users/", name="adminUsers")
     */
    public function adminUsers()
    {
        $user=$this->getUser();

        $usersDB = $this->getDoctrine()
            ->getRepository(User ::class)
            ->findAll();

        if(isset($_POST['searchUser']))
        {
            return $this->redirectToRoute('selectedUser',[
                "searchUser" => $_POST['searchUser'],
            ]);
        }

        return $this->render("myProfile/admin-users.html.twig",[
        'user' => $user,
        'usersDB' => $usersDB,
        'id' => 1,
        ]);
    }

    /**
     * @Route("/admin/users/{searchUser}", name="selectedUser")
     */
    public function selectedUser($searchUser)
    {
        $user=$this->getUser();

        $userDB = $this->getDoctrine()
            ->getRepository(User ::class)
            ->findOneByName($searchUser);
            
            return $this->render("myProfile/admin-searchUser.html.twig",[
                'user' => $user,
                'userDB' => $userDB,
                'id' => 1,
                ]);
    }


    /**
     * @Route("/admin/users/delete/{id}", name="adminUsersD")
     */
    public function adminUsersD($id)
    {   
        $user=$this->getUser();

        $doctrine = $this->getDoctrine();

       $userDB = $doctrine->getRepository(User::class)->find($id);

       $u = $doctrine->getManager();
       $u->remove($userDB);
       $u->flush();

       return $this->redirectToRoute('adminUsers', ['user' => $user]);
    }

    /**
     * @Route("/admin/users/block/{id}", name="adminUsersB")
     */
    public function adminUsersB($id)
    {   
        $user=$this->getUser();

        $doctrine = $this->getDoctrine();

       $userDB = $doctrine->getRepository(User::class)->find($id);

       $userDB->setBlocked(true);
       $u = $doctrine->getManager();
       $u->persist($userDB);
       $u->flush();

       return $this->redirectToRoute('adminUsers', ['user' => $user]);
    }

    /**
     * @Route("/admin/users/unblock/{id}", name="adminUsersU")
     */
    public function adminUsersU($id)
    {   
       $user=$this->getUser();

       $doctrine = $this->getDoctrine();

       $userDB = $doctrine->getRepository(User::class)->find($id);

       $userDB->setBlocked(false);
       $u = $doctrine->getManager();
       $u->persist($userDB);
       $u->flush();

       return $this->redirectToRoute('adminUsers', ['user' => $user]);
    }

    /**
     * @Route("/admin/comments/", name="adminComments")
     */
    public function adminComments()
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

            return $this->redirectToRoute('adminComments', [
                'user' => $user,
                'comments' => $comments
                ]);

        }

        return $this->render("myProfile/admin-comments.html.twig",[
        'user' => $user,
        'comments' => $comments,
        'id' => 2,
        ]);
    }

        /**
     * @Route("/admin/comments/delete/", name="adminCommentsD")
     */
    public function adminCommentsD()
    {   
        $user=$this->getUser();

        $doctrine = $this->getDoctrine();

       $comments = $doctrine->getRepository(Comments::class)->findAll();

       $u = $doctrine->getManager();
       foreach ($comments as $comment) {
            $u->remove($comment);
       }
       $u->flush();

       return $this->redirectToRoute('adminComments', []);
    }

    /**
     * @Route("/admin/quiz/", name="adminQuiz")
     */
    public function adminQuiz()
    {
        $user=$this->getUser();

        if(isset($_POST['submit'])) 
        {
            $newQuiz = new Quiz();
            $newQuiz
                ->setName($_POST['name'])
                ->setQuest1($_POST['quest1'])
                ->setAns1a($_POST['ans1a'])
                ->setAns1b($_POST['ans1b'])
                ->setAns1c($_POST['ans1c'])
                ->setAns1correct($_POST['ans1correct'])
                ->setQuest2($_POST['quest2'])
                ->setAns2a($_POST['ans2a'])
                ->setAns2b($_POST['ans2b'])
                ->setAns2c($_POST['ans2c'])
                ->setAns2correct($_POST['ans2correct'])
                ->setQuest3($_POST['quest3'])
                ->setAns3a($_POST['ans3a'])
                ->setAns3b($_POST['ans3b'])
                ->setAns3c($_POST['ans3c'])
                ->setAns3correct($_POST['ans3correct'])
                ->setQuest4($_POST['quest4'])
                ->setAns4a($_POST['ans4a'])
                ->setAns4b($_POST['ans4b'])
                ->setAns4c($_POST['ans4c'])
                ->setAns4correct($_POST['ans4correct'])
                ->setQuest5($_POST['quest5'])
                ->setAns5a($_POST['ans5a'])
                ->setAns5b($_POST['ans5b'])
                ->setAns5c($_POST['ans5c'])
                ->setAns5correct($_POST['ans5correct']);

            $doctrine = $this->getDoctrine();
            $u = $doctrine->getManager();
            $u->persist($newQuiz);
            $u->flush();
        }

        $quizAll = $this->getDoctrine()
            ->getRepository(Quiz ::class)
            ->findAll();

        return $this->render("myProfile/admin-createQuiz.html.twig",[
            'user' => $user,
            'quizAll' => $quizAll,
            'id' => 3,
            ]);
    }

    /**
     * @Route("/admin/quiz/delete/{id}", name="adminQuizD")
     */
    public function adminQuizD($id)
    {   
        $user=$this->getUser();

        $doctrine = $this->getDoctrine();

       $quiz = $doctrine->getRepository(Quiz::class)->find($id);

       $u = $doctrine->getManager();
       $u->remove($quiz);
       $u->flush();

       return $this->redirectToRoute('adminQuiz', []);
    }

    /**
     * @Route("/admin/quiz/{id}", name="adminQuizLook")
     */
    public function adminQuizLook($id)
    {
        $user=$this->getUser();
        $doctrine = $this->getDoctrine();
        $quiz = $doctrine->getRepository(Quiz::class)->find($id);

        if(isset($_POST['submit']))
        {
        $quiz
            ->setName($_POST['name'])
            ->setQuest1($_POST['quest1'])
            ->setAns1a($_POST['ans1a'])
            ->setAns1b($_POST['ans1b'])
            ->setAns1c($_POST['ans1c'])
            ->setAns1correct($_POST['ans1correct'])
            ->setQuest2($_POST['quest2'])
            ->setAns2a($_POST['ans2a'])
            ->setAns2b($_POST['ans2b'])
            ->setAns2c($_POST['ans2c'])
            ->setAns2correct($_POST['ans2correct'])
            ->setQuest3($_POST['quest3'])
            ->setAns3a($_POST['ans3a'])
            ->setAns3b($_POST['ans3b'])
            ->setAns3c($_POST['ans3c'])
            ->setAns3correct($_POST['ans3correct'])
            ->setQuest4($_POST['quest4'])
            ->setAns4a($_POST['ans4a'])
            ->setAns4b($_POST['ans4b'])
            ->setAns4c($_POST['ans4c'])
            ->setAns4correct($_POST['ans4correct'])
            ->setQuest5($_POST['quest5'])
            ->setAns5a($_POST['ans5a'])
            ->setAns5b($_POST['ans5b'])
            ->setAns5c($_POST['ans5c'])
            ->setAns5correct($_POST['ans5correct']);
        
            $u = $doctrine->getManager();
            $u->persist($quiz);
            $u->flush();

            return $this->redirectToRoute('adminQuiz', []);
        }

        return $this->render("myProfile/admin-editQuiz.html.twig",[
            'user' => $user,
            'quiz' => $quiz,
            'id' => null,
            ]);
    }
}