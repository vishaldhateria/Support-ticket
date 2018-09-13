<?php
//importing the user, ticket, comment - modal and AppMailer and Auth  for Authentication - functionality

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Ticket;
use App\Comment;
use App\Mailers\AppMailer;
use Illuminate\Support\Facades\Auth;
class CommentsController extends Controller
{
    public function postComment(Request $request, AppMailer $mailer)
    {
        $this->validate($request, [
            'comment' => 'required'
        ]);

        $comment = Comment::create([ //store the comment box in comment table with below fields
            'ticket_id' => $request->input('ticket_id'),
            'user_id'   => Auth::user()->id,
            'comment'   => $request->input('comment'),
        ]);


        //Then send an email, if the user commenting is not the ticket owner (that is, if the comment was made by an admin, an email will be sent to the ticket owner). And finally display a status message.
        //user id of the ticket that was commentted on is not equal to the authenticated user id.
        if ($comment->ticket->user->id !== Auth::user()->id) {
            $mailer->sendTicketComments($comment->ticket->user, Auth::user(), $comment->ticket, $comment);
        }

        return redirect()->back()->with("status", "Your comment has be submitted.");

    }
}
