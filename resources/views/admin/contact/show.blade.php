@extends('admin.layout.app-admin')
@section('content')
    <div class="card mb-3 border-primary">
        <div class="card-header">Demande de contact : {{ $contact->name .' '. $contact->firstname }}</div>
        <div class="row no-gutters">
            <div class="offset-2 col-4">
                <div class="card-body text-primary">
                    <p>name:</p>
                    <p>firstname:</p>
                    <p>email:</p>
                    <p>sujet:</p>
                    <p>number_phone:</p>
                    <p>restaurant:</p>
                    <p>text: </p>
                    <p>done:</p>
                </div>
            </div>
            <div class="col-6">
                <div class="card-body text-primary">
                    <p>{{ $contact->name }}</p>
                    <p>{{ $contact->firstname }}</p>
                    <p>{{ $contact->email }}</p>
                    <p>{{ $contact->sujet }}</p>
                    <p>{{ $contact->number_phone == '' ? 'not write' : $contact->number_phone }}</p>
                    <p>{{ $contact->restaurant == '' ? 'not write' : $contact->restaurant }}</p>
                    <p>{{ $contact->text }}</p>
                    <p>{{ $contact->done }}</p>
                </div>
            </div>
        </div>
        <div class="card-footer">
            Created at : {{ $contact->getCreateddateAttribute() }}
            <div class="float-right">
                <button class="btn btn-primary">Reply</button>
            </div>
        </div>
    </div>
@endsection