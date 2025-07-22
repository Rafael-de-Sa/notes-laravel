<?php

namespace App\Http\Controllers;

use App\Models\Note;
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
                'text_title.required' => 'O título é obrigatório.',
                'text_title.min' => 'O título deve possuir no máximo :min caracteres.',
                'text_title.max' => 'O título deve possuir ao menos :max caracteres.',

                'text_note.required' => 'A nota é obrigatória.',
                'text_note.min' => 'A nota deve possuir ao menos :min caracteres.',
                'text_note.max' => 'A nota deve possuir no máximo :max caracteres.'
            ]
        );

        //get user id
        $id = session('user.id');

        //create new note
        $note = new Note();
        $note->user_id = $id;
        $note->title = $request->text_title;
        $note->text = $request->text_note;
        $note->save();

        //redirect to home
        return redirect()->route('home');
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
