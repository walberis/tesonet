<?php

namespace App\Http\Controllers;

use App\Services\IssueService;


class IssueController extends Controller
{
    protected $issueService;

    /**
     * IssueController constructor.
     * @param IssueService $issueService
     */
    public function __construct(IssueService $issueService)
    {
        $this->middleware('auth');
        $this->issueService = $issueService;
    }

    /**
     * @param int $page
     * @param string $state
     * @return $this
     */
    public function showListIssues ($page = 1, $state = 'all'){

        $issuesData = $this->issueService->getIssues($page, $state);

        return view('listIssues')->with([
            'issues' => $issuesData['issues'],
            'lastPage' => $issuesData['lastPage'],
            'issuesCountByState' => $issuesData['issuesCountByState'],
            'page' => $page,
            'state' => $state ]);
    }

    /**
     * @param $login
     * @param $repo
     * @param $number
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showIssue($login, $repo, $number){

        $issueData = $this->issueService->getIssue($login, $repo, $number);

        return view('issue', ['issue' => $issueData['issue'], 'comments' => $issueData['comments'] ]);

    }
}
