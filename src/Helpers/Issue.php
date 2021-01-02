<?php

namespace PWWEB\Jira\Helpers;

use JiraRestApi\Issue\IssueService;
use JiraRestApi\JiraException;

class Issue
{
    /**
     * @var \PWWEB\Jira\Requests\Issue\IssueRequest
     */
    protected $request;

    /**
     * @var string
     */
    protected $issueKey;

    /**
     * Issue constructor.
     *
     * @param string $issueKey
     */
    public function __construct(string $issueKey)
    {
        $this->request = app(IssueRequest::class);
        $this->issueKey = $issueKey;
    }

    /**
     * Retrieve the issue.
     *
     * @param array $parameters Parameters for retrieving issue details.
     *
     * @return string
     */
    public function get($parameters = [])
    {
        try {
            $issueService = new IssueService();

            if (true === empty($parameters)) {
                $parameters = [
                    'fields' => [  // default: '*all'
                        'summary',
                        'comment',
                    ],
                    'expand' => [
                        'renderedFields',
                        'names',
                        'schema',
                        'transitions',
                        'operations',
                        'editmeta',
                        'changelog',
                    ]
                ];
            }

            $issue = $issueService->get($this->issueKey, $parameters);

            return $issue->fields;
        } catch (JiraRestApi\JiraException $e) {
            print("Error Occured! " . $e->getMessage());
        }
    }
}
