<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Exception;

class SmtpController
{

    public function enviar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'subject' => 'required|string',
            'message' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {

            Mail::raw($request->message, function ($mail) use ($request) {
                $mail->to($request->email)
                    ->subject($request->subject);
            });

            return response()->json([
                'success' => true,
                'message' => 'Correo enviado correctamente'
            ], 200);
        } catch (Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Error al enviar el correo',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
