<?php

namespace App\EventListener;

use App\Entity\Cours;
use App\Repository\CoursRepository;
use CalendarBundle\Entity\Event;
use CalendarBundle\Event\CalendarEvent;

class CalendarListener
{
    private $coursRepository;

    public function __construct(
        CoursRepository $coursRepository
    ) {
        $this->coursRepository = $coursRepository;
    }

    public function load(CalendarEvent $calendar): void
    {
        $start = $calendar->getStart();
        $end = $calendar->getEnd();
        $filters = $calendar->getFilters();

        // Modify the query to fit to your entity and needs
        // Change cours.beginAt by your start date property
        $bookings = $this->coursRepository
            ->createQueryBuilder('cours')
            ->where('cours.debut BETWEEN :start and :end')
            ->setParameter('start', $start->format('Y-m-d H:i:s'))
            ->setParameter('end', $end->format('Y-m-d H:i:s'))
            ->getQuery()
            ->getResult();

        foreach ($bookings as $cours) {
            // this create the events with your data (here cours data) to fill calendar
            $info = $this->coursRepository->getInformationsById($cours->getId());
            //var_dump($cours);
            $info = $info[0]['type'] ." - " . $info[0]['matiere'] ." - " . $info[0]['salle'] ." - " . $info[0]['groupe'] ." - " . $info[0]['enseignant'];
            $bookingEvent = new Event(
                $info,
                $cours->getDebut(),
                $cours->getFin() // If the end date is null or not defined, a all day event is created.
            );

            /*
             * Add custom options to events
             *
             * For more information see: https://fullcalendar.io/docs/event-object
             * and: https://github.com/fullcalendar/fullcalendar/blob/master/src/core/options.ts
             */

            $bookingEvent->setOptions([
                'backgroundColor' => '#007bff',
                'borderColor' => '#007bff',
            ]);

            // finally, add the event to the CalendarEvent to fill the calendar
            $calendar->addEvent($bookingEvent);
        }
    }
}