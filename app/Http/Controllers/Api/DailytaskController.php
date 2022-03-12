<?php

namespace App\Http\Controllers\Api;

use App\DailyTask;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DailytaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('jwtauth')->except('login');
    }

    public function index(Request $request)
    {
        // $data = DailyTask::all();
        // return response()->json(['success' => true, 'data' => $data], 200);
        $query = DailyTask::query();
        // $query = DB::table("core_daily_tasks")->get();
        $perPage = 3;
        $page = $request->input('page', 1);
        $total = $query->count();

        $result = $query->offset(($page - 1) * $perPage)->limit($perPage)->get();

        return [
            'item' => $result,
            'totalItem' => $total,
            'Page' => $page,
            'Last_page' => ceil($total / $perPage)
        ];
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


        $request->validate([]);
        $db = new DailyTask;

        $db->user_id = $request->input('user_id');
        $db->site = $request->input('site');
        $db->week = $request->input('week');
        $db->district = $request->input('district');
        $db->ticket = $request->input('ticket');
        $db->type = $request->input('type');
        $db->subject = $request->input('subject');
        $db->raisedby = $request->input('raisedby');
        $db->position = $request->input('position');
        $db->department = $request->input('department');
        $db->agent = $request->input('agent');
        $db->save();
        return response()->json(['success' => true, 'data' => $db], 200);
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
        $db = DailyTask::find($id);
        $request->validate([]);
        $db->store($request->all());
        return response()->json(['success' => true, 'data' => $db], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $db = DailyTask::find($id);
        $db->delete();
        return response()->json(['success' => true], 200);
    }
}
