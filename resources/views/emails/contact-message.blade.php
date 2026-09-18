<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Nouveau message - {{ $contactMessage->subject }}</title>
</head>

<body
    style="
        margin: 0;
        padding: 0;
        background-color: #f5f5f4;
        font-family: Arial, Helvetica, sans-serif;
        color: #292524;
    ">

    <table
        role="presentation"
        width="100%"
        cellpadding="0"
        cellspacing="0"
        border="0"
        style="background-color: #f5f5f4; margin: 0; padding: 32px 16px;">
        <tr>
            <td align="center">

                <table
                    role="presentation"
                    width="100%"
                    cellpadding="0"
                    cellspacing="0"
                    border="0"
                    style="
                    max-width: 640px;
                    background-color: #ffffff;
                    border: 1px solid #e7e5e4;
                    border-radius: 12px;
                    overflow: hidden;
                ">

                    {{-- Header --}}
                    <tr>
                        <td
                            style="
                            padding: 28px 32px;
                            border-bottom: 1px solid #e7e5e4;
                            text-align: center;
                        ">

                            <img
                                src="{{ asset('images/logo.webp') }}"
                                alt="Mairie de Veckersviller"
                                width="180"
                                style="
                                display: block;
                                width: 180px;
                                max-width: 100%;
                                height: auto;
                                margin: 0 auto;
                            ">

                        </td>
                    </tr>


                    {{-- Titre --}}
                    <tr>
                        <td style="padding: 32px 32px 8px;">

                            <p
                                style="
                                margin: 0 0 8px;
                                color: #78716c;
                                font-size: 13px;
                                font-weight: 600;
                                text-transform: uppercase;
                                letter-spacing: 0.05em;
                            ">
                                Nouveau message
                            </p>

                            <h1
                                style="
                                margin: 0;
                                color: #0c1a2a;
                                font-size: 24px;
                                line-height: 1.3;
                                font-weight: 700;
                            ">
                                {{ $contactMessage->subject }}
                            </h1>

                        </td>
                    </tr>


                    {{-- Expéditeur --}}
                    <tr>
                        <td style="padding: 24px 32px 8px;">

                            <h2
                                style="
                                margin: 0 0 12px;
                                color: #0c1a2a;
                                font-size: 16px;
                                line-height: 1.4;
                            ">
                                Coordonnées du demandeur
                            </h2>

                            <table
                                role="presentation"
                                width="100%"
                                cellpadding="0"
                                cellspacing="0"
                                border="0"
                                style="
                                background-color: #fafaf9;
                                border: 1px solid #e7e5e4;
                                border-radius: 8px;
                            ">
                                <tr>
                                    <td style="padding: 16px 18px;">

                                        <p
                                            style="
                                            margin: 0 0 8px;
                                            font-size: 14px;
                                            line-height: 1.5;
                                        ">
                                            <strong>Nom :</strong>
                                            {{ $contactMessage->first_name }}
                                            {{ $contactMessage->last_name }}
                                        </p>

                                        <p
                                            style="
                                            margin: 0 0 8px;
                                            font-size: 14px;
                                            line-height: 1.5;
                                        ">
                                            <strong>E-mail :</strong>
                                            <a
                                                href="mailto:{{ $contactMessage->email }}"
                                                style="
                                                color: #1d4ed8;
                                                text-decoration: none;
                                            ">
                                                {{ $contactMessage->email }}
                                            </a>
                                        </p>

                                        @if ($contactMessage->phone)

                                        <p
                                            style="
                                                margin: 0;
                                                font-size: 14px;
                                                line-height: 1.5;
                                            ">
                                            <strong>Téléphone :</strong>
                                            {{ $contactMessage->phone }}
                                        </p>

                                        @endif

                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>


                    {{-- Message --}}
                    <tr>
                        <td style="padding: 24px 32px 32px;">

                            <h2
                                style="
                                margin: 0 0 12px;
                                color: #0c1a2a;
                                font-size: 16px;
                                line-height: 1.4;
                            ">
                                Message
                            </h2>

                            <div
                                style="
                                padding: 18px;
                                background-color: #fafaf9;
                                border-left: 3px solid #0c1a2a;
                                color: #44403c;
                                font-size: 15px;
                                line-height: 1.7;
                            ">
                                {!! nl2br(e($contactMessage->message)) !!}
                            </div>

                        </td>
                    </tr>


                    {{-- Footer --}}
                    <tr>
                        <td
                            style="
                            padding: 20px 32px;
                            background-color: #fafaf9;
                            border-top: 1px solid #e7e5e4;
                            text-align: center;
                        ">

                            <p
                                style="
                                margin: 0;
                                color: #78716c;
                                font-size: 12px;
                                line-height: 1.6;
                            ">
                                Ce message a été envoyé depuis le formulaire
                                de contact du site de la mairie de Veckersviller.
                            </p>

                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>

</html>