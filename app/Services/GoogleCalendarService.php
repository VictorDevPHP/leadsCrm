<?php

namespace App\Services;

use Google\Client;
use Google\Service\Calendar;
use Google\Service\Calendar\Event;

class GoogleCalendarService
{
    protected $client;
    protected $calendar;

    /**
     * Construtor da classe GoogleCalendarService.
     *
     * Inicializa o cliente do Google Calendar com as credenciais e escopos necessários.
     *
     * @throws \Google\Exception Se ocorrer um erro ao configurar a autenticação.
     */
    public function __construct()
    {
        $this->client = new Client();
        $this->client->setAuthConfig(config('google-calendar.credentials'));
        $this->client->addScope(Calendar::CALENDAR);
        $this->calendar = new Calendar($this->client);
    }

    /**
     * Cria um evento no Google Calendar.
     *
     * @param string $calendarId O ID do calendário onde o evento será criado.
     * @param array $eventData Os dados do evento. Deve conter as seguintes chaves:
     *     - summary: string O resumo do evento.
     *     - location: string A localização do evento.
     *     - description: string A descrição do evento.
     *     - start: array Os detalhes do início do evento. Deve conter:
     *         - dateTime: string A data e hora de início do evento no formato 'Y-m-d\TH:i:s'.
     *         - timeZone: string A zona de tempo do início do evento.
     *     - end: array Os detalhes do término do evento. Deve conter:
     *         - dateTime: string A data e hora de término do evento no formato 'Y-m-d\TH:i:s'.
     *         - timeZone: string A zona de tempo do término do evento.
     *     - reminders: array (Opcional) Os lembretes para o evento. Deve conter:
     *         - useDefault: bool Se os lembretes padrão devem ser usados.
     *         - overrides: array (Opcional) Lista de lembretes personalizados. Cada lembrete deve conter:
     *             - method: string O método do lembrete ('email' ou 'popup').
     *             - minutes: int O número de minutos antes do evento para enviar o lembrete.
     *
     * @return  Calendar evento criado.
     * @throws \Exception Se ocorrer um erro ao criar o evento.
     */
    public function createEvent(string $calendarId, array $eventData): object
    {
        return $this->calendar->events->insert($calendarId, new Event($eventData));
    }

    /**
     * Obtém um evento do Google Calendar.
     *
     * Configura o cliente do Google Calendar para leitura e tenta buscar um evento específico.
     *
     * @param array $data Dados necessários para buscar o evento. Deve conter as seguintes chaves:
     *     - email: string O email do usuário cuja conta de serviço deve ser usada para acessar o calendário.
     *     - calendar_id: string O ID do calendário onde o evento está localizado.
     *     - event_id: string O ID do evento que deve ser buscado.
     *
     * @return void
     * @throws \Exception Se ocorrer um erro ao configurar o cliente ou buscar o evento.
     */
    public function getEvent($data)
    {
        $this->client->setAuthConfig(storage_path('app/google-calendar/service-account.json'));
        $this->client->setScopes([Calendar::CALENDAR_READONLY]);
        $this->client->setSubject($data['email']);
        
        try {
            return (new Calendar($this->client))->events->get($data['calendar_id'], $data['event_id']);
        } catch (\Exception $e) {
            \Log::error("Erro ao buscar evento: " . $e->getMessage());
            throw $e; 
        }
    }

}
