<?php

namespace App\Http\Controllers;

use App\Services\YoutubeSearchService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class YoutubeSearchController extends Controller
{
    /**
     * @var YoutubeSearchService
     */
    private $searchService;

    /**
     * Create a new controller instance.
     *
     * @param YoutubeSearchService $searchService
     */
    public function __construct(YoutubeSearchService $searchService)
    {
        $this->searchService = $searchService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function search(Request $request)
    {
        $this->validate($request, [
            'query' => 'required|string',
            'part' => 'sometimes|required|string'
        ]);

        $data = $request->all();

        if (isset($data['part'])) {
            return new JsonResponse($this->searchService
                ->setPart($data['part'])
                ->search($data['query'])
            );
        }

        return new JsonResponse($this->searchService
            ->search($data['query'])
        );
    }
}
