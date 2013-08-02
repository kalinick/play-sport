<?php
/**
 * User: nikk
 * Date: 6/17/13
 * Time: 5:36 PM
 */

namespace Ps\AppBundle\Model;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Doctrine\Bundle\DoctrineBundle\Registry;

use Ps\AppBundle\Entity;
use Ps\AppBundle\Repository;
use Ps\AppBundle\Exception\EventMemberException;

class EventMemberModel
{
    const PARTICIPATE_NO = 'no';
    const PARTICIPATE_YES = 'yes';
    const PARTICIPATE_WISH = 'wish';

    static public function getParticipateList()
    {
        return [self::PARTICIPATE_NO, self::PARTICIPATE_YES, self::PARTICIPATE_WISH];
    }

    /**
     * @var Registry
     */
    protected $doctrine;

    /**
     * @var Repository\EventMemberParticipationRepository
     */
    protected $participationRepository;

    public function __construct(Registry $doctrine)
    {
        $this->doctrine = $doctrine;
        $this->participationRepository = $this->doctrine->getRepository('PsAppBundle:EventMemberParticipation');
    }

    /**
     * @param Entity\Event $oEvent
     * @param string $participate
     * @param Entity\User $oUser
     * @return Entity\EventMemberParticipation
     * @throws BadRequestHttpException
     * @throws EventMemberException
     */
    protected function getParticipation(Entity\Event $oEvent, $participate, Entity\User $oUser = null)
    {
        if (!in_array($participate, self::getParticipateList(), true)) {
            throw new BadRequestHttpException('Participate ' . $participate . ' not exists');
        }

        if ($participate == self::PARTICIPATE_NO) {
            return $this->participationRepository->findOneByTitle(self::PARTICIPATE_NO);
        }

        if ($oEvent->getPrivacy()->getTitle() === EventModel::PRIVACY_PUBLIC) {
            return $this->participationRepository->findOneByTitle(self::PARTICIPATE_YES);
        } else {
            if ($oUser !== null) {
                // TODO: create ability to  preferred users get participation yes
                if ($oUser->getId() == $oEvent->getOrganizer()->getId() && false) {
                    return $this->participationRepository->findOneByTitle(self::PARTICIPATE_YES);
                } else {
                    return $this->participationRepository->findOneByTitle(self::PARTICIPATE_WISH);
                }
            } else {
                throw new EventMemberException('event_participation.impossible');
            }
        }
    }
}