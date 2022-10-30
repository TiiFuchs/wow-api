<?php

namespace Tii\WowApi;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Tii\WowApi\Data\Movie;

class WowApi
{

    const API_URI = 'https://owen-wilson-wow-api.onrender.com/wows/';

    protected static function makeClient()
    {
        return new Client([
            'base_uri' => self::API_URI,
            'headers' => [
                'Accept' => 'application/json',
            ]
        ]);
    }

    /**
     * @return Movie[]
     * @throws GuzzleException
     */
    public static function random(
        int $results = null,
        int $year = null,
        string $movie = null,
        string $director = null,
        int $wowInMovie = null,
        string $sort = null,
        string $direction = null,
    ): array {
        $parameters = [
            'results' => $results,
            'year' => $year,
            'movie' => $movie,
            'director' => $director,
            'wow_in_movie' => $wowInMovie,
            'sort' => $sort,
            'direction' => $direction,
        ];
        $parameters = array_filter($parameters);

        $response = self::makeClient()->get('random', [
            'query' => $parameters,
        ]);

        $content = $response->getBody()->getContents();
        $raw = json_decode($content, true);

        return array_map(fn($data) => new Movie($data), $raw);
    }

    /**
     * @return Movie|Movie[]
     * @throws GuzzleException
     */
    public static function ordered(
        string $index
    ): Movie|array {
        $response = self::makeClient()->get("ordered/$index");

        $content = $response->getBody()->getContents();
        $raw = json_decode($content, true);

        $isArray = str_starts_with($content, '[');

        if ($isArray) {
            return array_map(fn($data) => new Movie($data), $raw);
        }

        return new Movie($raw);
    }

    /**
     * @return string[]
     * @throws GuzzleException
     */
    public static function allMovies(): array
    {
        $response = self::makeClient()->get('movies');
        $content = $response->getBody()->getContents();
        return json_decode($content, true);
    }

    /**
     * @return string[]
     * @throws GuzzleException
     */
    public static function allDirectors(): array
    {
        $response = self::makeClient()->get('directors');
        $content = $response->getBody()->getContents();
        return json_decode($content, true);
    }

}