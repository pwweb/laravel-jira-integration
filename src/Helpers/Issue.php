<?php

namespace PWWEB\Jira\Helpers;

use JiraRestApi\Issue\IssueService;
use JiraRestApi\Issue\IssueField;
use JiraRestApi\JiraException;
use JiraRestApi\Issue\Issue as JiraIssue;

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
     * @return JiraRestApi\Issue\Issue|null
     */
    public function get($parameters = []): ?JiraIssue
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

    public function update()
    {
        try {
            $issueField = new IssueField(true);

            $issueField->->setCustomField('Public Votes', '30');

            // optionally set some query params
            $editParams = [
                'notifyUsers' => false,
            ];

            // You can set the $paramArray param to disable notifications in example
            $ret = $this->request->update($this->issueIdOrKey, $issueField, $editParams);

            var_dump($ret);
        } catch (JiraRestApi\JiraException $e) {
            $this->assertTrue(false, "update Failed : " . $e->getMessage());
        }
    }
}
