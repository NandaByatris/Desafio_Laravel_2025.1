<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmailController extends Controller{
    public function index()
    {
        return view('email-contato', compact('users'));
    }
    public function store(Request $request){
        var_dump(value: 'send email-contato');
    }
}
?>
