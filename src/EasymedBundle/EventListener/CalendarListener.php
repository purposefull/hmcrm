<?php
namespace EasymedBundle\EventListener;

use ADesigns\CalendarBundle\Event\CalendarEvent;
use ADesigns\CalendarBundle\Entity\EventEntity;
use Doctrine\ORM\EntityManager;

class CalendarEventListener
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function loadEvents(CalendarEvent $calendarEvent)
    {
        $startDate = $calendarEvent->getStartDatetime();
        $endDate = $calendarEvent->getEndDatetime();

        $request = $calendarEvent->getRequest();
        $filter = $request->get('filter');

        $calendarEvents = $this->entityManager
            ->getRepository('EasymedBundle:CalendarEvent')
            ->getVacationsBetween($startDate, $endDate);

        foreach ($calendarEvents as $ce) {
            $event = new EventEntity(
                $ce->getTitle(),
                $ce->getStartDate(),
                $ce->getEndDate(),
                false
            );
            //optional calendar event settings
            $event->setAllDay(true); // default is false, set to true if this is an all day event
            $event->setBgColor('#FF0000'); //set the background color of the event's label
            $event->setFgColor('#FFFFFF'); //set the foreground color of the event's label
            $event->setUrl('http://www.google.com'); // url to send user to when event label is clicked
            $event->setCssClass('my-custom-class'); // a custom class you may want to apply to event labels
            //finally, add the event to the CalendarEvent for displaying on the calendar
            $calendarEvent->addEvent($event);
        }
    }
}