<?php

namespace App\Http\Controllers\API\Google\Calendar;
use App\Services\GoogleCalendarService;

class Calendar 
{
    /**
     * Cria um evento no Google Calendar.
     *
     * @param array $data Os dados do evento. Deve conter as seguintes chaves:
     *     - summary: string O resumo do evento.
     *     - description: string A descrição do evento.
     *     - calendarId: string O ID do calendário onde o evento será criado.
     *     - startDateTime: string A data e hora de início do evento no formato 'Y-m-d\TH:i:s'.
     *     - endDateTime: string A data e hora de término do evento no formato 'Y-m-d\TH:i:s'.
     *     - timeZone: string A zona de tempo do evento. Padrão é 'America/Sao_Paulo'.
     *     - emailReminderMinutes: int (Opcional) Minutos antes do evento para enviar um lembrete por email. Padrão é 1440 minutos (24 horas).
     *     - popupReminderMinutes: int (Opcional) Minutos antes do evento para mostrar um lembrete pop-up. Padrão é 10 minutos.
     *
     * @return void
     */
    public static function createEvent($data)
    {
        $eventData = [
            'summary' => $data['summary'],
            'location' => $data['timeZone'] ?? 'America/Sao_Paulo',
            'description' => $data['description'],
            'start' => [
                'dateTime' => $data['startDateTime'],
                'timeZone' => $data['timeZone'] ?? 'America/Sao_Paulo',
            ],
            'end' => [
                'dateTime' => $data['endDateTime'],
                'timeZone' => $data['timeZone'] ?? 'America/Sao_Paulo',
            ],
            'reminders' => [
                'useDefault' => false,
                'overrides' => [
                    ['method' => 'email', 'minutes' => $data['emailReminderMinutes'] ?? 24 * 60],
                    ['method' => 'popup', 'minutes' => $data['popupReminderMinutes'] ?? 10],
                ],
            ],
        ];

        $calendarId = $data['calendarId'];
        (new GoogleCalendarService)->createEvent($calendarId, $eventData);
    }

    public static function getEventById()
    {
        
    }

}
