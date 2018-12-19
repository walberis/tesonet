<?php

namespace App\Http\Controllers;

use App\Services\IssueService;


class IssueController extends Controller
{
    protected $issueService;
    public function __construct(IssueService $issueService)
    {
        $this->middleware('auth');
        $this->issueService = $issueService;
    }

    public function showListIssues ($page = 1, $state = 'all'){

        $issuesData = $this->issueService->getIssues($page, $state);

        return view('listIssues')->with([
            'issues' => $issuesData['issues'],
            'lastPage' => $issuesData['lastPage'],
            'issuesCountByState' => $issuesData['issuesCountByState'],
            'page' => $page,
            'state' => $state ]);
    }

    public function showIssue($login, $repo, $number){

        $issueData = $this->issueService->getIssue($login, $repo, $number);

        return view('issue', ['issue' => $issueData['issue'], 'comments' => $issueData['comments'] ]);

    }
}
