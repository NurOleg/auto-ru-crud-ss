<?php

namespace App\Mail;

use App\Advert;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdvertAdded extends Mailable
{
    protected $advert;
    protected $link;
    public const MAIL_TO = 'oleg.nur94@gmail.com';

    use Queueable, SerializesModels;

    /**
     * AdvertAdded constructor.
     * @param Advert $advert
     */
    public function __construct(Advert $advert)
    {
        $this->advert = $advert;
        $this->link = route('advert.detail', ['id' => $advert->id]);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from('test@example.com')
            ->subject('Добавлено новое объявление!')
            ->view('mail.advert_created')
            ->with([
                'advert' => $this->advert,
                'link' => $this->link
            ]);
    }
}
