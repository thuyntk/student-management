<?php

namespace App\Mail;

use App\Models\Subject;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailSubject extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $subjects;
    public function __construct( $subjects)
    {
        $this->subjects = $subjects;   
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subjectsNotYet = $this->subjects;
        // return $this->view('email.mailSubject', compact('subjectsNotYet'));
        // return $this->from('nguyenthikimthuy019@gmail.com', 'Me')
        //             ->with([
        //                 'subjects' =>$this->subjects
        //             ]);
        return $this->from('nguyenthikimthuy019@gmail.com')->view('email.mailSubject', compact('subjectsNotYet'));
    }
}
