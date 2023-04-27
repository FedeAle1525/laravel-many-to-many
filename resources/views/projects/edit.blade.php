@extends('layouts.app')

@section('content')

<div class="container text-center py-4">
  <h1>Modifica Progetto</h1>
</div>

<div class="container">
  <form action="{{ route('projects.update', $project) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
      <label class="form-label">Nome</label>
      <div class="input-group">
        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $project->name) }}">
        @error('name')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Descrizione</label>
        <div class="input-group">
          <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="6">
          {{ old('description', $project->description) }}
          </textarea>
          @error('description')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
      </div>

      <!-- Select con Elenco Tipologie-->
      <div class="mb-3">
        <label class="form-label">Tipologia</label>
        <div class="input-group">
          <select class="form-select @error('type_id') is-invalid @enderror" name="type_id">
            <option selected hidden>Seleziona Tipologia</option>
            <option value="">Nessuna</option>

            <!-- Ciclo le varie Tipologie recuperate dalla Collection passata alla Vista nel metodo 'create' del Controller -->
            <!-- In caso di Errore seleziono il Vecchio Valore -->
            @foreach ($types as $type)
            <option @selected( old('type_id', $project->type_id)==$type->id) value="{{ $type->id }}"> {{ $type->name }} </option>
            @endforeach

          </select>
          @error('type_id')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
      </div>

      <!-- Gruppo di Check Box per la Tecnologia -->
      <div class="mb-3">
        <label class="form-label d-block">Tecnologie</label>

        @foreach($technologies as $tech)
        <div class="form-check form-check-inline">
          <!-- Volendo ottenere un Array di Nomi, aggiungo all'attributo 'name' le [] -->
          <!-- Per gestire l'Errore controllo che l'id è presente nell'Array di Tag inviato al form che recupero con 'old' a cui passo l'Array di Tecnologie associate al Progetto come parametro di default -->
          <input class="form-check-input @error('technologies') is-invalid @enderror" type="checkbox" value="{{$tech->id}}" name="technologies[]" @checked( in_array($tech->id, old('technologies', $project->getListTechIds())) )>
          <label class="form-check-label">
            {{ $tech->name }}
          </label>

          @error('technologies')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        @endforeach

      </div>

      <div class="mb-3">
        <label class="form-label">Cliente</label>
        <div class="input-group">
          <input type="text" class="form-control @error('client') is-invalid @enderror" name="client" value="{{ old('client', $project->client) }}">
          @error('client')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label">URL</label>
        <div class="input-group">
          <input type="text" class="form-control @error('url') is-invalid @enderror" name="url" value="{{ old('url', $project->url) }}">
          @error('url')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
      </div>

      <button type="submit" class="btn btn-warning">Salva</button>
  </form>
</div>

@endsection