<?php

namespace App\Services;

use App\Models\User;
use App\Models\TextMessage;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Collection;

class TextMessageService
{
    public static function sendMessage(array $data, Collection $records)
    {
        //pastikan argument tu letak betul2 turutan, kalau tak dia jadi error (array,etc)
        // dd($data, $records);
        $textMessages = collect([]);

        $records->map(function ($record) use ($data, $textMessages) {
            // dd($textMessages);
            $textMessage = self::sendTextMessage($data, $record);

            $textMessages->push($textMessage);
        });

        TextMessage::insert($textMessages->toArray());
    }

    public static function sendTextMessage(array $data, User $user): array
    {
        $message = Str::replace('{name}', $user->name, $data['message']);

        //send message to user

        // kena ikut turutan dalam datatbase and model
        return [
            'message' => $message,
            'sent_by' => auth()?->id() ?? null,
            'status' => TextMessage::STATUS['PENDING'],
            'response_payload' => '',
            'sent_to' => $user->id,
            'remarks' => $data['remarks'] ?? null,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
