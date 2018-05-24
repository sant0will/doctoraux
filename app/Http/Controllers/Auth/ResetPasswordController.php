<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\ResetPasswordMail;
use App\Models\User;
use App\Models\Cidadao;
use App\Services\RandomPass;
use Mail;
use Hash;
class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    public function index(){
        return view('auth.passwords.reset');
    }

    public function send(Request $request){
        $aux = User::where('email', $request->email)->get();
        
        $pass = RandomPass::random_str(6);

        $user = User::find($aux[0]->id);
        $cidadao = Cidadao::find($user->cidadao_id);
        date_default_timezone_set('America/Sao_Paulo');
        $dia = date('d/m/Y');
        $hora = date('H:i:s');
        $data = $dia." ás ".$hora;
        $user->password = Hash::make($pass);
        $user->access = false;
        if($user->update()){
            try
            {
                Mail::to($request->email)->send(new ResetPasswordMail([
                    'senha' => $pass,
                    'nome' => $cidadao->nome,
                    'data' => $data
                ]));
                return redirect('/login')->with(['success' => 'Envio do e-mail realizado com sucesso!']);
            }
            catch(Exception $e)
            {         
                return redirect('/login')->with(['message' => 'Falha ao tentar enviar o e-mail!']);
            }
        }else{
            return redirect('/login')->with(['message' => 'Falha ao resetar a senha!']);
        }
    }

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
}
