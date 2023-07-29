<?php

namespace App\Http\Controllers;

use App\Models\ListItem;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ToDoListController extends Controller
{
    public function index(){
        $sort = DB::table('list_items')->orderBy('is_complete', 'asc')->get();

        return view('index', ['listItems' => $sort]);
    }

    public function markComplete($id){
        Log::info($id);
        $item = ListItem::find($id);
        Log::info($item);
        $item->is_complete = 1;
        $item->save();
        Log::info($item);

        return redirect('/');
    }

    public function saveItem(Request $request){
        Log::info(json_encode($request->all()));
        $newListItem = new ListItem();
        $newListItem->name = $request->what;
        $newListItem->deadline = $request->deadline;
        $newListItem->is_complete = 0;
        $newListItem->save();

        return redirect('/');
    }
}
