<?php

namespace PWWEB\Jira\Helpers;

use JiraRestApi\Issue\IssueService;
use JiraRestApi\JiraException;
use JiraRestApi\Issue\IssueField;

class Issue
{
    /**
     * @var \PWWEB\Jira\Requests\Issue\IssueRequest
     */
    protected $request;

    /**
     * @var int|string
     */
    protected $issueIdOrKey;

    /**
     * Issue constructor.
     *
     * @param int|string $issueKey
     */
    public function __construct($issueIdOrKey = '')
    {
        $this->request = app(IssueService::class);
        $this->issueIdOrKey = $issueIdOrKey;
    }

    /**
     * Retrieve the issue.
     *
     * @param array $parameters Parameters for retrieving issue details.
     *
     * @return JiraRestApi\Issue\IssueField|null
     */
    public function get($parameters = []): ?IssueField
    {
        if ('' === $this->issueIdOrKey) {
            return null;
        }

        try {
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

            $issue = $this->request->get($this->issueIdOrKey, $parameters);

            return $issue;
        } catch (JiraRestApi\JiraException $e) {
            print("Error Occured! " . $e->getMessage());
        }
    }
}
