<?php

namespace PWWEB\Jira\Helpers;

use JiraRestApi\Project\ProjectService;
use JiraRestApi\JiraException;
use JiraRestApi\Project\Project as JiraProject;

class Project
{
    /**
     * @var \PWWEB\Jira\Requests\Issue\IssueRequest
     */
    protected $request;

    /**
     * @var string
     */
    protected $projectKey;

    /**
     * Issue constructor.
     *
     * @param string $projectKey
     */
    public function __construct(string $projectKey = '')
    {
        $this->request = app(ProjectService::class);
        $this->projectKey = $projectKey;
    }

    /**
     * Retrieve the issue.
     *
     * @param array $parameters Parameters for retrieving issue details.
     *
     * @return JiraRestApi\Project\Project|null
     */
    public function get($parameters = []): ?JiraProject
    {
        if ('' === $this->projectKey) {
            return null;
        }

        try {
            $project = $this->request->get($this->projectKey);

            return $project;
        } catch (JiraRestApi\JiraException $e) {
            print("Error Occured! " . $e->getMessage());
        }
    }
}
