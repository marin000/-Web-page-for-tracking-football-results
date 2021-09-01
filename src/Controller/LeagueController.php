<?php

namespace App\Controller;
use App\Entity\User;
use App\Entity\FavClubs;
use App\Entity\FavPlayer;
use App\Entity\favMatches;
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

class LeagueController extends AbstractController
{
    /**
     * @Route("/homepage/", name="homepage")
     */
    public function homepage(Request $request)
    {
        $api = new FootballData();

        $now = date_create();
        $end = date_create(); 
        date_add($end,date_interval_create_from_date_string("3 days"));
        $response = $api->findMatchesForDateRange(date_format($now, "Y-m-d"),date_format($end, "Y-m-d"));
        
        $doctrine = $this->getDoctrine();
        $repository = $doctrine->getRepository(User::class);
        $usersResults = $repository->getAllUsersSortedByResult();

        $user=$this->getUser();

        return $this->render("league/homepage.html.twig",[
            "response" => $response,
            "usersResults" => $usersResults,
            "user" => $user,
            "id" => null,
        ]);
    }

     /**
     * @Route("/{name}/{id}", name="selectedLeague")
     */
    public function selectedLeague($id)
    {
        $api = new FootballData();

        $name=$api->findStandingsByCompetition($id)->competition->name;

        $doctrine = $this->getDoctrine();
        $repository = $doctrine->getRepository(CompetitionInfo::class);
        $info = $repository->findByCompetitionId($id);

        $user=$this->getUser();

        return $this->render("league/selectedLeague.html.twig", [
            "name" => $name,
            "id" => $id,
            "info" => $info,
            "user" => $user,
        ]);   
    }
    /**
     * @Route("/{name}/{id}/standing", name="selectedStanding")
     */
    public function selectedStanding(Request $request, $id,$name)
    {
        $api = new FootballData();

        $standings=$api->findStandingsByCompetition($id)->standings;

        $doctrine = $this->getDoctrine();
        $repository = $doctrine->getRepository(CompetitionInfo::class);
        $info = $repository->findByCompetitionId($id);

        $user=$this->getUser();

        return $this->render("league/selectedLeague/standing.html.twig", [
            "standings" => $standings,
            "name" => $name,
            "id" => $id,
            "info" =>$info,
            "user" => $user,
        ]);   
    }

     /**
     * @Route("/{name}/{id}/scorers", name="selectedScorers")
     */
    public function selectedScorers(Request $request, $id,$name)
    {
        $api = new FootballData();

        $scorers=$api->findScorersByCompetition($id)->scorers;

        $doctrine = $this->getDoctrine();
        $repository = $doctrine->getRepository(CompetitionInfo::class);
        $info = $repository->findByCompetitionId($id);

        $user=$this->getUser();

        return $this->render("league/selectedLeague/scorers.html.twig", [
            "scorers" => $scorers,
            "id" => $id,
            "name" => $name,
            "info" => $info,
            "user" => $user,
        ]);   
    }

    /**
     * @Route("/{name}/{id}/thisWeek", name="selectedThisWeek")
     */
    public function selectedThisWeek(Request $request, $id,$name)
    {
        $api = new FootballData();

        Carbon::setWeekStartsAt(Carbon::MONDAY);
        Carbon::setWeekEndsAt(Carbon::SUNDAY);

        $monday = Carbon::now()->startOfWeek();
        $sunday = Carbon::now()->endOfWeek();

        $matches= $api->findMatchesForDateRangeByCompetition
        ($id,date_format($monday, "Y-m-d"),date_format($sunday, "Y-m-d"));

        if(isset($_POST['matchday'])) 
        {
            if(($_POST['matchday'])>0 && ($_POST['matchday']) < 39)
            {
                $md=$_POST['matchday'];
                return $this->redirectToRoute('selectedMatchday',[
                    "id" => $id,
                    "md" =>$md,
                    "name" => $name,
                ]);
            }
        }

        $doctrine = $this->getDoctrine();
        $repository = $doctrine->getRepository(CompetitionInfo::class);
        $info = $repository->findByCompetitionId($id);

        $user=$this->getUser();

        return $this->render("league/selectedLeague/thisWeek.html.twig", [
            "matches" => $matches,
            "id" => $id,
            "name" => $name,
            "info" => $info,
            "user" => $user,
        ]);   
    }

    /**
     * @Route("/{name}/{id}/matchday/{md}", name="selectedMatchday")
     */
    public function selectedMatchday(Request $request, $id,$md,$name)
    {
        $api = new FootballData();
        $matchday=$api->findMatchesByCompetitionAndMatchday($id,$md);

        $doctrine = $this->getDoctrine();
        $repository = $doctrine->getRepository(CompetitionInfo::class);
        $info = $repository->findByCompetitionId($id);

        $user=$this->getUser();

        return $this->render("league/selectedLeague/matchday.html.twig", [
            "matchday" => $matchday,
            "id"=> $id,
            "name" => $name,
            "info" => $info,
            "user" => $user,
        ]);   
    }

    
    /**
     * @Route("/{name}/{id}/team/{tid}", name="selectedTeam")
     */
    public function selectedTeam(Request $request,$id,$tid,$name)
    {
        $api = new FootballData();
        $team=$api->findTeamById($tid);

        $user=$this->getUser();

        return $this->render("league/selectedLeague/team.html.twig", [
            "team" => $team,
            "id" => $id,
            "tid" => $tid,
            "name" => $name,
            "user" =>$user,
        ]);   
    }

    /**
     * @Route("/{name}/{id}/team/{tid}/squad", name="selectedSquad")
     */
    public function selectedSquad(Request $request,$id,$tid,$name)
    {
        $api = new FootballData();
        $team=$api->findTeamById($tid);
        $user=$this->getUser();

        return $this->render("league/selectedLeague/team-squad.html.twig", [
            "team" => $team,
            "id" => $id,
            "tid" => $tid,
            "name" => $name,
            "user" => $user,
        ]);   
    }

    /**
     * @Route("/{name}/{id}/team/{tid}/matches", name="selectedMatches")
     */
    public function selectedMatches(Request $request,$id,$tid,$name)
    {
        $api = new FootballData();
        $team=$api->findTeamById($tid);
        $matches=$api->findMatchesByTeam($tid);

        $user=$this->getUser();

        return $this->render("league/selectedLeague/team-matches.html.twig", [
            "team" => $team,
            "id" => $id,
            "tid" => $tid,
            "name" => $name,
            "matches" => $matches,
            "user" => $user,
        ]);   
    }


    /**
     * @Route("/{name}/{id}/team/{tid}/player/{pid}", name="selectedPlayer")
     */
    public function selectedPlayer(Request $request,$id, $tid,$pid,$name)
    {
        $api = new FootballData();
        $player=$api->findPlayerById($pid);
        $team=$api->findTeamById($tid);

        $user=$this->getUser();

        return $this->render("league/selectedLeague/player.html.twig", [
            "player" => $player,
            "team" => $team,
            "id" => $id,
            "name" => $name,
            "user" => $user,
        ]);   
    }

    /**
     * @Route("/{name}/{id}/team/{tid}/{teamName}/fav/", name="favClub")
     */
    public function favClub(Request $request,$id,$tid,$name,$teamName)
    {
        $user=$this->getUser();
        $newClub = new FavClubs();
            $newClub
                ->addUserId($user)
                ->setClubId($tid)
                ->setLeagueId($id)
                ->setLeagueName($name)
                ->setClubName($teamName);

            $doctrine = $this->getDoctrine();
            $u = $doctrine->getManager();
            $u->persist($newClub);
            $u->flush();

            return $this->redirectToRoute('selectedTeam', [
                'name' => $name,
                'id' => $id,
                'tid' => $tid
                ]);
    }


    /**
     * @Route("/{name}/{id}/team/{tid}/player/{pid}/fav/{playerName}", name="favPlayer")
     */
    public function favPlayer(Request $request,$id,$tid,$name,$playerName,$pid)
    {
        $user=$this->getUser();
        $newPlayer = new FavPlayer();
            $newPlayer
                ->addUserId($user)
                ->setClubId($tid)
                ->setLeagueId($id)
                ->setLeagueName($name)
                ->setPlayerName($playerName)
                ->setPlayerId($pid);

            $doctrine = $this->getDoctrine();
            $u = $doctrine->getManager();
            $u->persist($newPlayer);
            $u->flush();

            return $this->redirectToRoute('selectedPlayer', [
                'name' => $name,
                'id' => $id,
                'tid' => $tid,
                'pid' => $pid
                ]);
    }


    /**
     * @Route("/fav/match/{mid}", name="favMatch")
     */
    public function favMatch(Request $request,$mid)
    {
        $user=$this->getUser();
        $newMatch = new favMatches();
            $newMatch
                ->addUserId($user)
                ->setMatchId($mid);

            $doctrine = $this->getDoctrine();
            $u = $doctrine->getManager();
            $u->persist($newMatch);
            $u->flush();

            return $this->redirectToRoute('homepage', []);
    }
    
}
