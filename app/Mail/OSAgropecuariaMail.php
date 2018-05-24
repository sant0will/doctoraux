<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OSAgropecuariaMail extends Mailable
{

    /**
     * Limpar cache ao mecher nas configurações do e-mail
     * php artisan config:cache
     * truncate -s 0 laravel.log
     */

    use Queueable, SerializesModels;

    protected $inputs;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($inputs)
    {
        $this->inputs = $inputs;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $nr  = $this->inputs['numero'];
        $pdf = $this->inputs['pdf'];
        //dd($pdf);

        return $this->view('ordemservicos.mails.agropecuaria')
                    ->subject("[SisObras] Requerimento de Serviços nº $nr")
                    ->attachData($pdf, 'invoice.pdf');
    }
}
