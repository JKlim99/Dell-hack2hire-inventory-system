<?php

namespace App\Http\Controllers;

use App\Models\MailList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Storage;

class MailListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mailList = MailList::all();

        return View::make('mail.list')->with(['mailList' => $mailList]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return View::make('mailList.create');
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
        $validatedData = $request->validate([
            'subject' => 'required',
            'body' => 'required',
            'sender' => 'required',
            'status' => 'required',
        ]);
        $show = MailList::create($validatedData);
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
        $mailList = MailList::find($id);
        $attachments = $mailList->files;

        // show the view and pass the shark to it
        return View::make('emails.mailDetail')
            ->with(['mail'=>$mailList, 'attachments'=>$attachments]);
    }

    public function download($filename)
    {
        return response()->download(storage_path().'/'.$filename);
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
        $mailList = MailList::findOrFail($id);
        $mailList->delete();
    }
}
