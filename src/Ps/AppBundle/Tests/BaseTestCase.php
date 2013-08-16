<?php
/**
 * User: nikk
 * Date: 8/5/13
 * Time: 4:43 PM
 */

namespace Ps\AppBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

use Ps\AppBundle\Controller\GetContainerTrait;

abstract class BaseTestCase extends WebTestCase
{
    use GetContainerTrait;

    private static $firstLaunch = true;

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var Application
     */
    protected $console;

    protected function setUp()
    {
        parent::setUp();

        $this->client = $this->createClient();

        $this->console = new Application($this->client->getKernel());
        $this->console->setAutoExit(false);
        $this->container = $this->client->getContainer();

        if (self::$firstLaunch) {
            self::$firstLaunch = false;
            $this->createDb();
            //$this->refreshDb();
        }
    }

    protected function createDb()
    {
        $this->runConsole('doctrine:database:create');
    }

    protected function refreshDb()
    {
        $this->runConsole('doctrine:schema:drop', ['--force' => true]);
        $this->runConsole('doctrine:schema:create');
        $this->runConsole('doctrine:fixtures:load', ['--append' => true, '--fixtures' => __DIR__ . '/../DataFixtures']);
    }

    protected function runConsole($command, array $options = [])
    {
        $options['-e'] = 'test';
        $options['-q'] = null;
        $options = array_merge($options, ['command' => $command]);
        return $this->console->run(new ArrayInput($options));
    }

    protected function get($id)
    {
        return $this->container->get($id);
    }

    protected function loginByUsername($username)
    {
        $user = $this->getUserManager()->findUserByUsername($username);

        // 'main' - firewall name in security.yml
        $this->getSecurityContext()->setToken(
            new UsernamePasswordToken(
                $user, null, 'main', $user->getRoles()
            )
        );
    }
}