<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Interfaces\ComicClientInterface;
use App\MarvelApi;
use App\SearchComicsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{


    /**
     * @var SearchComicsRepository
     */
    private $searchComicsRepository;

    public function __construct(SearchComicsRepository $searchComicsRepository)
    {
        $this->searchComicsRepository = $searchComicsRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $name = '';

        if ($request->input('name')) {
            $name = $request->input('name');
        }

        $results = $this->searchComicsRepository->getComicsByName($name);

        \JavaScript::put([
            'api_results' => $results
        ]);
        
        return Response::view('home.index', compact('results'));
    }
}
