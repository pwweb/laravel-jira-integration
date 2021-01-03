<?php

namespace PWWEB\Jira\Helpers;

use JiraRestApi\Issue\IssueService;
use JiraRestApi\JiraException;
use JiraRestApi\Issue\IssueSearchResult as JiraIssues;

class Issues
{
    /**
     * @var \PWWEB\Jira\Requests\Issue\IssueRequest
     */
    protected $request;

    /**
     * Issue constructor.
     *
     */
    public function __construct()
    {
        $this->request = app(IssueService::class);
    }

    /**
     * Retrieve the issue.
     *
     * @param array $parameters Parameters for retrieving issue details.
     *
     * @return \JiraRestApi\Issue\IssueSearchResult|null
     */
    public function get($query): ?JiraIssues
    {
        if ('' === $query) {
            return null;
        }

        try {
            $issues = $this->request->search($query);

            return $issues;
        } catch (JiraRestApi\JiraException $e) {
            print("Error Occured! " . $e->getMessage());
        }
    }
}
