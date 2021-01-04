<?php

namespace PWWEB\Jira\Helpers;

use JiraRestApi\Issue\IssueService;
use JiraRestApi\Issue\IssueField;
use JiraRestApi\JiraException;
use JiraRestApi\Issue\Issue as JiraIssue;

/**
 * PWWEB\Jira\Helpers\Issue Helper.
 *
 * Wrapper for Jira Issues.
 *
 * @author    FP <fp@pw-websolutions.com>
 * @author    RAB <rab@pw-websolutions.com>
 * @copyright 2021 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
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
     * @return \JiraRestApi\Issue\Issue|null
     */
    public function get($parameters = []): ?JiraIssue
    {
        if ('' === $this->issueIdOrKey) {
            return null;
        }

        try {
            if (true === empty($parameters)) {
                $parameters = [
                    'fields' => [
                        // default: '*all'
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

    /**
     * Create a new Jira issue.
     *
     * @param array $issueData Data to be used for creation.
     *
     * @return \JiraRestApi\Issue\Issue
     */
    public function create(array $issueData): JiraIssue
    {
        try {
            $issueField = new IssueField();

            foreach ($issueData as $key => $value) {
                if (true === str_starts_with($key, 'customfield_')) {
                    $issueField->addCustomField($key, $value);
                } else {
                    $issueField->{'set'.$key}($value);
                }
            }

            $issue = $this->request->create($issueField);

            return $issue;
        } catch (JiraRestApi\JiraException $e) {
            print("Error Occured! " . $e->getMessage());
        }
    }

    /**
     * Updates a Jira issue
     *
     * @param array $issueData Data to be updated.
     *
     * @return \JiraRestApi\Issue\Issue
     */
    public function update(array $issueData): JiraIssue
    {
        try {
            $issueField = new IssueField(true);

            $issueField->addCustomField('customfield_10060', 30);

            // optionally set some query params
            $editParams = [
                'notifyUsers' => false,
            ];

            // You can set the $paramArray param to disable notifications in example
            $issue = $this->request->update($this->issueIdOrKey, $issueField, $editParams);

            return $issue;
        } catch (JiraRestApi\JiraException $e) {
            $this->assertTrue(false, "update Failed : " . $e->getMessage());
        }
    }
}
