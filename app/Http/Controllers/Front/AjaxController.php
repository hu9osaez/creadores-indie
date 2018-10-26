<?php namespace CreadoresIndie\Http\Controllers\Front;

use CreadoresIndie\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mail;
use Spatie\Referer\Referer;

class AjaxController extends Controller
{
    public function feedback(Request $request)
    {
        $this->validate($request, [
           'name' => 'required|string',
           'email' => 'required|email',
           'message' => 'required|string',
        ]);

        try {
            Mail::raw($request->message, function ($message) use ($request) {
                $message->to(env('CONTACT_ADDRESS'));
                $message->replyTo($request->email);
                $message->subject("Feedback de [{$request->name}]");
            });

            $user_agent_parser = userAgentData();
            $referer = app(Referer::class)->get();

            activity()
                ->causedBy(auth()->user())
                ->withProperties([
                    'referer' => $referer,
                    'ip_address' => getRequestIpAddress(),
                    'user_agent' => getRequestUserAgent(),
                    'country' => getRequestCountry(),
                    'device'  => $user_agent_parser->device->model ?? 'unknown',
                    'os' => optional($user_agent_parser->os)->toString() ?? 'unknown',
                    'browser_name' => $user_agent_parser->browser->name ?? 'unknown',
                    'browser_version' => optional($user_agent_parser->browser->version)->toString() ?? 'unknown',
                ])
                ->log('feedback::new-message');

            return response()->json([
                'success' => true,
                'message' => 'Tus comentarios han sido enviados correctamente, te contactaré de vuelta lo mas pronto posible.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ocurrió un problema al enviar tus comentarios, intenta nuevamente.',
            ]);
        }
    }
}
