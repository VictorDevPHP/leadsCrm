<div>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
    <div class="container">
        {{-- <p><b>Resumo: </b> {!! $resumo !!}</p> --}}
        <br><br><br>
        <h2>Relatório: <b>{{ date('d/m/Y', strtotime($data_inicio)) }}</b></h2>
        <table>
            <tr>
                <th>Métrica</th>
                <th>Valor</th>
            </tr>
            <tr>
                <td>Impressões</td>
                <td>{{ $impressoes }}</td>
            </tr>
            <tr>
                <td>Investimento</td>
                <td>R$: {{ $spend }}</td>
            </tr>
            @if ($acoes)
                @foreach ($acoes as $acao)
                    <tr>
                        <td>
                            @switch($acao['action_type'])
                                @case('onsite_conversion.messaging_first_reply')
                                    Respostas Iniciais de Mensagens
                                @break

                                @case('onsite_conversion.post_save')
                                    Salvamentos de Publicações
                                @break

                                @case('page_engagement')
                                    Engajamento da Página
                                @break

                                @case('post_engagement')
                                    Engajamento de Publicações
                                @break

                                @case('post')
                                    Publicações
                                @break

                                @case('onsite_conversion.messaging_conversation_started_7d')
                                    Conversas de WhatsApp
                                @break

                                @case('post_reaction')
                                    Reações em Publicações
                                @break

                                @case('link_click')
                                    Cliques em Links
                                @break
                                @default
                                    {{ $acao['action_type'] }}
                            @endswitch
                        </td>
                        <td>{{ $acao['value'] }}</td>
                    </tr>
                @endforeach
            @endif
        </table>
    </div>
</div>
