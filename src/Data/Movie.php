<?php

namespace Tii\WowApi\Data;

class Movie extends Data
{

    public string $movie;
    public int $year;
    public \DateTime $releaseDate;
    public string $director;
    public string $character;
    public string $movieDuration;
    public string $timestamp;
    public string $fullLine;
    public int $currentWowInMovie;
    public int $totalWowsInMovie;
    public string $poster;
    public Video $video;
    public string $audio;

}