<?php

namespace App\Http\Controllers;

use Session;
use App\Page;
use Illuminate\Http\Request;
use App\Http\Requests\Page\StoreRequest;
use App\Http\Requests\Page\UpdateRequest;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = [
            'pages' => Page::count() >= 50 ? Page::paginate(50) : Page::all()
        ];

        return view('backend.page.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        Session::flash('flash_message', 'Page successfully updated!');

        return view('backend.page.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $validated = $request->validated();

        $page = Page::create($request->all());
 
        return redirect()->route('admin.page.show', $page->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        return view('backend.page.show', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Page $page)
    {
        $validated = $request->validated();

        $query = Page::findOrfail($page->id);

        $query->fill($request->all())->save();

        Session::flash('flash_message', 'Page successfully updated!');

        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $query = Page::findOrFail($page->id);

        $query->delete();

        Session::flash('flash_message', 'Task successfully deleted!');

        return redirect('/home');
    }
}
