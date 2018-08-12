<?php

namespace App\Http\Controllers\Movie;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $movie = Movie::where('name', 'LIKE', "%$keyword%")
                ->orWhere('genre', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $movie = Movie::latest()->paginate($perPage);
        }

        return view('movie.movie.index', compact('movie'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        if(auth()->user()->hasPermissionTo('create-movies')){
            return view('movie.movie.create');
        }
        else{
            return redirect(url('/movie/movie'))->with('per','No Access');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        if(auth()->user()->hasPermissionTo('create-movies')){
            $requestData = $request->all();
        
            Movie::create($requestData);

            return redirect('movie/movie')->with('flash_message', 'Movie added!');
        }
        else{
            return redirect(url('/movie/movie'))->with('per','No Access');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $movie = Movie::findOrFail($id);

        return view('movie.movie.show', compact('movie'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        if(auth()->user()->hasPermissionTo('edit-movies')){
            $movie = Movie::findOrFail($id);

            return view('movie.movie.edit', compact('movie'));
        }
        else{
            return redirect(url('/movie/movie'))->with('per','No Access');
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        if(auth()->user()->hasPermissionTo('edit-movies')){
            $requestData = $request->all();
        
            $movie = Movie::findOrFail($id);
            $movie->update($requestData);

            return redirect('movie/movie')->with('flash_message', 'Movie updated!');
        }
        else{
            return redirect(url('/movie/movie'))->with('per','No Access');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        if(auth()->user()->hasPermissionTo('delete-movies')){
            Movie::destroy($id);

            return redirect('movie/movie')->with('flash_message', 'Movie deleted!');
        }
        else{
            return redirect(url('/movie/movie'))->with('per','No Access');
        }
        
    }
}
