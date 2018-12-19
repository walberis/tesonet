<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use App\Http\ApiRequest;
use App\User;


class IssueService
{
    protected $ApiRequest;

    public function __construct( ApiRequest $ApiRequest )
    {
        $this->ApiRequest = $ApiRequest;
    }

    public function getIssues( $page = 1,  $state = 'all'){

        $user = Auth::user();

        $query = [  'page'=> $page,
                    'state' => $state,
                    'per_page' => config('github.settings.items_per_page')];


        $response = $this->ApiRequest->getRequest(config('github.links.GITHUB_API_ISSUES'), $user->access_token, $query);

        $lastPage = $this->getIssuesLastPage($response);
        $issuesCountByState = $this->getIssuesCountByState($user);

        return ['issues' => json_decode($response->getBody()),
                'lastPage' => $lastPage,
                'issuesCountByState' => $issuesCountByState
                ];
    }

    public function getIssue($login, $repo, $number){

        $user = Auth::user();

        $issueUri = config('github.links.GITHUB_API_ISSUE') . '/' . $login . '/' . $repo .  '/issues/' . $number;
        $commentsUri = config('github.links.GITHUB_API_ISSUE') . '/' . $login . '/' . $repo .  '/issues/' . $number . '/comments' ;

        $IssueResponse = $this->ApiRequest->getRequest($issueUri, $user->access_token);
        $IssueCommentsResponse = $this->ApiRequest->getRequest($commentsUri, $user->access_token);

        $issue = json_decode($IssueResponse->getBody());
        $comments =  json_decode($IssueCommentsResponse->getBody());

        return  ['issue' => $issue, 'comments' => $comments];
    }


    private function getIssuesCountByState(User $user){

        $uriOpen = config('github.links.GITHUB_API_ISSUES_SEACRH') . '?q=assignee:'. $user->login .' type:issue state:open ';
        $uriClosed = config('github.links.GITHUB_API_ISSUES_SEACRH') . '?q=assignee:'. $user->login .' type:issue state:closed ';

        $openIssueResponse = $this->ApiRequest->getRequest($uriOpen, $user->access_token);
        $closedIssueResponse = $this->ApiRequest->getRequest($uriClosed, $user->access_token);


        $openIssuesCount =  json_decode($openIssueResponse->getBody());
        $closedIssuesCount =  json_decode($closedIssueResponse->getBody());
        return [
            'openedIssuesCount' => $openIssuesCount->total_count,
            'closedIssuesCount' => $closedIssuesCount->total_count,

        ];
    }

    private function getIssuesLastPage($response){

        $linkHeader = $response->getHeader('Link');
        $lastPage = 1;
        foreach ($linkHeader as $link) {
            preg_match('/page=([0-9])&state=([a-z]*)&per_page=([0-9]*)>; rel="last"/', $link, $result);

            if ($result) {
                $lastPage = $result[1];
            }
        }
        return $lastPage;
    }
}

