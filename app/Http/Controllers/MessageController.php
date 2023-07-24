<?php

namespace App\Http\Controllers;

use App\Models\messageModel;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    protected $model;

    public function __construct()
    {
        $this->model = new messageModel();
        $this->model->setConnection('mysql_slave');
    }

    public function index()
    {
        $data = $this->model->all();
        return view('index', compact('data'));
    }

    public function create(Request $request)
    {
        // Create a new instance of the messageModel
        $data = new messageModel();
        $data->full_name = $request->input('name');
        $data->email = $request->input('email'); // Set the correct property
        $data->subject = $request->input('subject'); // Set the correct property
        $data->message = $request->input('message'); // Set the correct property
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
