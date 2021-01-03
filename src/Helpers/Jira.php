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
     * [project description]
     *
     * @param string $projectKey [description]
     *
     * @return \PWWEB\Jira\Helpers\Project [description]
     */
    protected function project(string $projectKey = ''): \PWWEB\Jira\Helpers\Project
    {
        return new Project($projectKey);
    }

    /**
     * @param string $issueKey
     *
     * @return \PWWEB\Jira\Helpers\Issue
     */
    public function issue(string $issueKey = ''): \PWWEB\Jira\Helpers\Issue
    {
        return new Issue($issueKey);
    }
}
