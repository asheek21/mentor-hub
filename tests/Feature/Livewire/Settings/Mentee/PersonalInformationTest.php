<?php

use App\Livewire\Settings\Mentee\PersonalInformation;
use Livewire\Livewire;

test('it can update settings - personal information ', function () {

    mentee();

    $mentee = auth()->user();

    expect($mentee->first_name)->toBe('Jhon');

    Livewire::test(PersonalInformation::class, ['user' => $mentee])
        ->set('first_name', 'Jhon Doe')
        ->call('updatePersonalInformation')
        ->assertStatus(200)
        ->assertHasNoErrors();

    $mentee->refresh();

    expect($mentee->first_name)->toBe('Jhon Doe');
});

test('it validates settings - personal information ', function () {

    mentee();

    $mentee = auth()->user();

    expect($mentee->first_name)->toBe('Jhon');

    Livewire::test(PersonalInformation::class, ['user' => $mentee])
        ->set('first_name', '')
        ->call('updatePersonalInformation')
        ->assertStatus(200)
        ->assertHasErrors([
            'first_name' => 'required',
        ]);
});
