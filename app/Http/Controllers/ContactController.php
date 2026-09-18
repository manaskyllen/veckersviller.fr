<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMessageMail;
use App\Models\ContactMessage;
use App\Models\MunicipalitySetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        return view('pages.contact.index');
    }

    public function store(ContactRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $contactMessage = ContactMessage::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'subject' => $data['subject'],
            'message' => $data['message'],
            'status' => 'new',
            'privacy_accepted_at' => now(),
        ]);

        $municipality = MunicipalitySetting::first();

        Mail::to($municipality->contact_email)
            ->send(new ContactMessageMail($contactMessage));

        return $this->redirectAfterSubmission()
            ->with(
                'success',
                'Votre message a bien été envoyé. Merci de nous avoir contactés.'
            );
    }

    private function redirectAfterSubmission(): RedirectResponse
    {
        $previousUrl = url()->previous();

        $path = parse_url($previousUrl, PHP_URL_PATH);

        if ($path === route('contact', [], false)) {
            return redirect($previousUrl);
        }

        return redirect($previousUrl . '#contact');
    }
}
