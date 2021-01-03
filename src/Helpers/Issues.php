<?php

namespace PWWEB\Jira\Helpers;

use JiraRestApi\Issue\IssueService;
use JiraRestApi\JiraException;
use JiraRestApi\Issue\IssueField;

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
     * @return array
     */
    public function get($query): array
    {
        if ('' === $query) {
            return [];
        }

        try {
            $issues = $this->request->search($query);

            return $issues;
        } catch (JiraRestApi\JiraException $e) {
            print("Error Occured! " . $e->getMessage());
        }
    }
}
