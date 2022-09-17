<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BulletinBoard;
use App\Models\Opinion;
use App\Models\User;
use App\Models\Schedule;

class BulletinBoardsController extends Controller
{
    public function index(){
        $subQuery=function($query){
            $query->from('opinions')
                ->select(['bulletinBoard_id','read'])
                ->selectRaw('max(created_at) as latest_opinion')
                ->groupBy(['bulletinBoard_id','read']);
        };

        $boards = BulletinBoard::joinSub($subQuery,'opinions','bulletinBoards.id','opinions.bulletinBoard_id')
            ->orderBy('latest_opinion','desc')
            ->get();


        return view('boards.index',compact('boards'));
    }

    public function show($id){
        $board=BulletinBoard::findOrFail($id);

        $opinions=Opinion::where('bulletinBoard_id','=',$board->id)
            ->orderBy('created_at','desc')
            ->paginate(100);

        $new = $opinions->first();

        $date=date('Y-m');

        $schedules = Schedule::where('date','like',$date.'%')->orderBy('date')->get();
        

        return view('boards.show',compact('board','opinions','new','schedules'));
    }

    public function create(){
        return view('boards.create');
    }

    public function store(Request $request){
        $request->validate([
            'title'=>'required|string|max:255',
        ]);

        $board = new BulletinBoard;
        $board->title = $request->title;
        $board->content = $request->content;
        $board->user_id = \Auth::user()->id;
        $board->save();

        $opinion = new Opinion;
        $opinion->bulletinBoard_id = $board->id;
        $opinion->opinion = "";
        $opinion->save();

        return redirect('/boards');
    }

    public function destroy($id){
        if(\Auth::check()){
            if(\Auth::id() === 1){
                $board = BulletinBoard::findOrFail($id);
    
                $board->delete();

                return back();
            }    
        }

    }
}
