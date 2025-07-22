<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Operations;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class MainController
{

    public function index()
    {
        //load user's notes
        $id = session('user.id');
        $notes = User::find($id)->notes()->get()->toArray();

        //show home view
        return view('home', ['notes' => $notes]);
    }

    public function newNote()
    {
        //show new note view
        return view('new_note');
    }

    public function newNoteSubmit(Request $request)
    {
        //validate request
        $request->validate(
            [
                'text_title' =>  ['required', 'min:3', 'max:200'],
                'text_note' => ['required', 'min:3', 'max:3000']
            ], //error messages
            [
                'text_title.required' => 'O username é obridatório.',
                'text_title.email' => 'O username dever ser um email válido.',
                'text_title.min' => 'A senha deve possuir ao menos :min caracteres.',

                'text_password.required' => 'A senha é obrigatória.',
                'text_password.min' => 'A senha deve possuir ao menos :min caracteres.',
                'text_password.max' => 'A senha deve possuir no máximo :max caracteres.'
            ]
        );
        //get user id

        //create new note

        //redirect to home

    }

    public function editNote($id)
    {
        $id =  Operations::decryptId($id);

        echo "I'm editing note with id = $id";
    }

    public function deleteNote($id)
    {
        $id =  Operations::decryptId($id);

        echo "I'm deleting note with id = $id";
    }
}
