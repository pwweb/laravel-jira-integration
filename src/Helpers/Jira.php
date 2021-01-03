<?php

namespace PWWEB\Jira\Helpers;

use PWWEB\Jira\Helpers\Issue;

class Jira
{
    protected function session()
    {
        return new Session();
    }

    protected function project()
    {
        return new Project();
    }

    /**
     * @param string $issueKey
     *
     * @return \PWWEB\Jira\Helpers\Issue
     */
    public function issue(string $issueKey): \PWWEB\Jira\Helpers\Issue
    {
        return new Issue($issueKey);
    }
}
