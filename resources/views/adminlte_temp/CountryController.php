<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;
use Session;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $this->_checkPerm('country');
      $rows = Country::all();
      return view('admin.country.index', compact(['rows']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $this->_checkPerm('country');
      return view('admin.country.create', compact([]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->_checkPerm('country');

      $validation = $this->validate($request, [
        'name_en'   => 'required',
        'name_ar'   => 'required',
        'code'      => 'required',
        'lang'      => 'required',
        'currency_en'  => 'required',
        'currency_ar'  => 'required',
      ]);

      $user = Country::create($request->all());

      Session::flash('success', 'Created successfully');
      return redirect('admin/country');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $this->_checkPerm('country');
      $row = Country::findOrFail($id);
      return view('admin.country.show', compact(['row']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $this->_checkPerm('country');
      $row = Country::findOrFail($id);
      return view('admin.country.edit', compact(['row']));
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
      $this->_checkPerm('country');
      $row = Country::findOrFail($id);

      $validation = $this->validate($request, [
        'name_en'   => 'required',
        'name_ar'   => 'required',
        'code'      => 'required',
        'lang'      => 'required',
        'currency_en'  => 'required',
        'currency_ar'  => 'required',
      ]);

      $row->update($request->all());

      Session::flash('success', 'Modified successfully');
      return redirect('/admin/country/'.$id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $this->_checkPerm('country');

      $delete = Country::findOrFail($id);
      $delete->delete();

      Session::flash('success', 'Deleted successfully');
      return redirect('/admin/country');
    }
}
