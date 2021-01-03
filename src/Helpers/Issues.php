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
     * @var string
     */
    protected $query;

    /**
     * Issue constructor.
     *
     * @param string $query
     */
    public function __construct(string $query)
    {
        $this->request = app(IssueService::class);
        $this->query = $query;
    }

    /**
     * Retrieve the issue.
     *
     * @param array $parameters Parameters for retrieving issue details.
     *
     * @return JiraRestApi\Issue\IssueField|null
     */
    public function get($parameters = [])
    {
        if ('' === $this->query) {
            return null;
        }

        try {
            $issues = $this->request->search($this->query);

            return $issues;
        } catch (JiraRestApi\JiraException $e) {
            print("Error Occured! " . $e->getMessage());
        }
    }
}
