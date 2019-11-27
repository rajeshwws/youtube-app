<?php


namespace App\Services;


class YoutubeSearchService
{
    /** @var string */
    private $part = 'id, snippet';

    /**
     * @var \Google_Service_YouTube
     */
    private $youTube;

    /**
     * YoutubeSearchService constructor.
     * @param \Google_Service_YouTube $youTube
     */
    public function __construct(\Google_Service_YouTube $youTube)
    {
        $this->youTube = $youTube;
    }

    /**
     * @param string $query
     * @return \Google_Service_YouTube_SearchListResponse
     */
    public function search(string $query)
    {
        $queryParams = ['q' => $query];

        return $this->youTube->search->listSearch($this->part, $queryParams);
    }

    /**
     * @return string
     */
    public function getPart(): string
    {
        return $this->part;
    }

    /**
     * @param string $part
     * @return YoutubeSearchService
     */
    public function setPart(string $part): YoutubeSearchService
    {
        $this->part = $part;
        return $this;
    }
}
