<?php

namespace App\Http\Controllers;

use App\Models\messageModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MessageController extends Controller
{


    public function index()
    {

        $useSlave = env('DB_USE_SLAVE', false);
        $connection = $useSlave ? 'mysql_slave' : 'mysql';
        $users = DB::connection($connection)->select('SELECT * FROM message');
        $data = messageModel::all();
        return view('index', compact('data', 'users', 'useSlave'));
    }

    public function toggleDatabase(Request $request)
    {
        $useSlave = $request->input('use_slave', false);
        $envData = file_get_contents(base_path('.env'));
        $envData = preg_replace('/DB_USE_SLAVE=(.*)/', 'DB_USE_SLAVE=' . $useSlave, $envData);
        file_put_contents(base_path('.env'), $envData);
        return redirect()->back();
    }

    public function create(Request $request)
    {

        $data = new messageModel();
        $data->full_name = $request->input('name');
        $data->email = $request->input('email');
        $data->subject = $request->input('subject');
        $data->message = $request->input('message');
        $data->save();
        return redirect('/index');
    }

    public function delete($id)
    {
        $dataModel =  messageModel::find($id);
        $dataModel->delete();
        return redirect('/index');
    }
}
