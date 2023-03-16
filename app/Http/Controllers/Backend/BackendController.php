<?php

namespace App\Http\Controllers\Backend;

use App\Charts\MonthlyView;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BackendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $viewChart = new MonthlyView();
        $viewChart->labels(['One', 'Two', 'Three', 'Four']);
        $viewChart->dataset('My dataset 1', 'bar', [4, 1, 2, 3])->backgroundColor('rgba(242, 95, 92, 0.6)')->color('#F25F5C');
        $viewChart->dataset('My dataset 2', 'bar', [1, 5, 3, 4])
            ->backgroundColor('rgba(80, 81, 79, 0.5)')->color('#50514F');
        $viewChart->height(350);

        return view('backend.pages.dashboard', compact('viewChart'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
