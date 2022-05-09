<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Cake;

class OrderedCakeMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $cake;
    protected $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Cake $cake, string $email)
    {
        $this->cake = $cake;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Cake Ordered')
            ->view('email.ordered-cake')
            ->with(['cake' => $this->cake, 'email' => $this->email]);
    }
}
