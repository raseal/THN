<?php

declare(strict_types=1);

namespace BookingTrackerApi\Controller\BookingTracker\Hotel;

use BookingTracker\Application\Hotel\FindAll\FindAllHotelsQuery;
use Shared\Infrastructure\Symfony\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

final class RetrieveAllHotelsController extends Controller
{
    public function __invoke(): Response
    {
        $query = new FindAllHotelsQuery();
        $response = $this->ask($query);

        return $this->createApiResponse($response);
    }
}
