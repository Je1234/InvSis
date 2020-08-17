<option value="">Elige el proveedor</option>
@foreach ($proveedores as $p)
        <option value="{{ $p->id_proveedor}}">
            {{ $p->nombre }}
        </option>
@endforeach