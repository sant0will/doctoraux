<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResetPasswordMail extends Mailable
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
        $nome  = $this->inputs['nome'];
        $senha = $this->inputs['senha'];
        $data = $this->inputs['data'];
        
        return $this->view('auth.passwords.mails.reset')
                    ->subject("[SisObras] Recuperação de Senha")
                    ->with([
                        'nome' => $nome,
                        'senha' => $senha,
                        'data' => $data
                    ]);
    
    }
}
