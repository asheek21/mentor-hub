<?php

use App\Livewire\Messaging\ChatMessage;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(ChatMessage::class)
        ->assertStatus(200);
});
