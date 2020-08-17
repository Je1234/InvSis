<option value="">Elige el cliente</option>
@foreach ($clientes as $c)
        <option value="{{ $c->id_documento }}">
            {{ $c->nombres }} {{ $c->apellidos }} #{{ $c->id_documento}}
        </option>
@endforeach