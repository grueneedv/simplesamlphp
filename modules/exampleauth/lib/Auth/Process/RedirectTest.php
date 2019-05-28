<?php

namespace SimpleSAML\Module\exampleautth\Auth\Process;

use Webmozart\Assert\Assert;

/**
 * A simple processing filter for testing that redirection works as it should.
 *
 */
class RedirectTest extends \SimpleSAML\Auth\ProcessingFilter
{
    /**
     * Initialize processing of the redirect test.
     *
     * @param array &$state  The state we should update.
     * @return void
     */
    public function process(&$state)
    {
        Assert::isArray($state);
        Assert::keyExists($state, 'Attributes');

        // To check whether the state is saved correctly
        $state['Attributes']['RedirectTest1'] = ['OK'];

        // Save state and redirect
        $id = \SimpleSAML\Auth\State::saveState($state, 'exampleauth:redirectfilter-test');
        $url = \SimpleSAML\Module::getModuleURL('exampleauth/redirecttest.php');
        \SimpleSAML\Utils\HTTP::redirectTrustedURL($url, ['StateId' => $id]);
    }
}
