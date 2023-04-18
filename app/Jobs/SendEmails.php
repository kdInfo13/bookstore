<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\ReviewMail;
use Mail;

class SendEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user, $authors, $reviews, $book_name;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user, $authors, $reviews, $book_name)
    {
        $this->user = $user;
        $this->authors = $authors;
        $this->reviews = $reviews;
        $this->book_name = $book_name;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = array(
            'user' => $this->user,
            'authors'=>$this->authors, 
            'reviews'=>$this->reviews, 
            'book_name'=>$this->book_name
        );
        Mail::to('author@yopmail.com')->send(new ReviewMail($data));
    }
}
