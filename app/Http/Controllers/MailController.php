<?php

namespace App\Http\Controllers;
use App\Mail\Recovery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\MailLog;

class MailController extends Controller
{
     public function sendEmail(Request $request)
    {
        $newpassword = Str::random(8);
        $hashed_random_password = Hash::make($newpassword);
        //dd($hashed_random_password);
        $email = $request->get('email');

        $request->validate([
            'email' => 'required|email',
        ]);

        //dd($request->get('email_contacto'));

        $user = User::where('email', $email)->first();
        if (!$user)
            return response()->json('No se encontro algun usuario con el correo ingresado', 404);
        //dd($user);
            $user->password = $hashed_random_password;
            $user->update();

            $details = new Recovery([$newpassword,$user->name]);
            //dd($details);

            $recovery = new MailLog;
            $recovery->UsuarioCreacion = $user->id;
            $recovery->asunto = "Recuperacion de password";
            $recovery->save();

            Mail::to($email)->send($details);

        return response()->json("Mensaje enviado con exito", 200);
        // $details = [
        //     'title' => 'Correo de recuperacion',
        //     'body' => 'Este es un ejemplo'
        // ];

        // Mail::to('dilsonjoan16@gmail.com')->send(new RecoveryMail($details));
        // return "Correo enviado";
    }
}
