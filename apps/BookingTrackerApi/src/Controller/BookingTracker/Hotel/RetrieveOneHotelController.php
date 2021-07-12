<?php

declare(strict_types=1);

namespace BookingTrackerApi\Controller\BookingTracker\Hotel;

use BookingTracker\Application\Hotel\FindOneHotelQuery;
use Shared\Infrastructure\Symfony\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

final class RetrieveOneHotelController extends Controller
{
    public function __invoke(string $id): Response
    {
        try {
            $query = new FindOneHotelQuery($id);
            $response = $this->ask($query);

            return $this->createApiResponse($response);
        } catch (Throwable $exception) {
            return $this->createApiResponse($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }
}
