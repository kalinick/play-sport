<?php
/**
 * User: nikk
 * Date: 7/10/13
 * Time: 1:22 PM
 */

namespace Ps\AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpFoundation\Response;

use Ps\AppBundle\Controller\GetContainerTrait;

class CreateRegularEventsCommand extends ContainerAwareCommand
{
    use GetContainerTrait;

    protected function configure()
    {
        $this
            ->setName('ps:app:create-regular-events')
            ->addOption(
                'day',
                null,
                InputOption::VALUE_OPTIONAL,
                'The day of the events',
                date('D', strtotime('-1 day'))
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $day = $input->getOption('day');
        $result = $this->getRegularEventManager()->createEvents($day);
        $output->write('Created ' . $result . ' events');
    }

    protected function get($id)
    {
        return $this->getContainer()->get($id);
    }
}