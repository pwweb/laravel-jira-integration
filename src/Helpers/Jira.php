<?php

namespace PWWEB\Jira\Helpers;

use PWWEB\Jira\Helpers\Issue;

class Jira
{
    protected function session()
    {
        return new Session();
    }

    /**
     * Accessor for project entity.
     *
     * @param string $projectKey [description]
     *
     * @return \PWWEB\Jira\Helpers\Project [description]
     */
    public function project(string $projectKey = ''): \PWWEB\Jira\Helpers\Project
    {
        return new Project($projectKey);
    }

    /**
     * Accessor for multiple issues.
     *
     * @param string $query [description]
     *
     * @return \PWWEB\Jira\Helpers\Issues [description]
     */
    public function issues(string $query): \PWWEB\Jira\Helpers\Issues
    {
        return new Issues($query);
    }

    /**
     * Accessor for issue entity.
     *
     * @param string $issueKey
     *
     * @return \PWWEB\Jira\Helpers\Issue
     */
    public function issue(string $issueKey = ''): \PWWEB\Jira\Helpers\Issue
    {
        return new Issue($issueKey);
    }
}
