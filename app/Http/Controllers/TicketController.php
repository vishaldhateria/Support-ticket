<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Ticket;
use App\User;
use App\Mailers\AppMailer;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function userTickets()
    {
        
        $tickets = Ticket::all();
        $categories = Category::all();
        return view('tickets.user_tickets', compact('tickets', 'categories'));
    }
    public function create()
    {
        $categories = Category::all(); //get all data from category model/table

        //to send the values to the frontend
        //The compact() function creates an array from variables and their values.
        //<?php
// $firstname = "Peter";
// $lastname = "Griffin";
// $age = "41";

// $result = compact("firstname", "lastname", "age");

// print_r($result);
//  Array ( [firstname] => Peter [lastname] => Griffin [age] => 41 )

        return view('tickets.create', compact('categories')); 

    }
    //$mailer variable of the type AppMailer
    public function store(Request $request, AppMailer $mailer)
    {
        //The store() accepts two arguments, $request variable of type Request and $mailer variable of type AppMailer which we have yet to create. The method first sets some form validations rules that must be met before moving forward. Upon successful form validation, a new the ticket is created and an email containing the ticket details is sent to the user (more on this below) and finally the user is redirected back with a success message.
        $this->validate($request, [
            'title'    => 'required',
            'category' => 'required',
            'priority' => 'required',
            'message'  => 'required'
        ]);

        $ticket = new Ticket([
            'title'     => $request->input('title'),
            'user_id'   => Auth::user()->id,
            'ticket_id' => strtoupper(str_random(10)),
            'category_id'  => $request->input('category'),
            'priority'  => $request->input('priority'),
            'message'   => $request->input('message'),
            'status'    => "Open",
        ]);
        
        $ticket->save();

        $mailer->sendTicketInformation(Auth::user(), $ticket);

        return redirect()->back()->with("status", "A ticket with ID: #$ticket->ticket_id has been opened");
    }
}
