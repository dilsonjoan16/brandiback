{{-- @php
    dd($tipos);
@endphp --}}
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Modalidad</th>
            <th>Nombre</th>
            <th>Estado</th>
            <th>Usuario Creador</th>
            <th>Usuario Modificador</th>
            <th>Fecha de Creacion</th>
            <th>Fecha de Modificacion</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tipos as $t)
        <tr>
            <td>{{$t->id}}</td>
            <td>{{$t['ModalidadDeCurso']->nombre}}</td>
            <td>{{$t->nombre}}</td>
            <td>{{$t->estado}}</td>
            <td>@if ($t['UsuarioCreador'] !== null)
                {{$t['UsuarioCreador']->name}}
            @else
            No posee
            @endif</td>
            <td>@if ($t['UsuarioModificador'] !== null)
                {{$t['UsuarioModificador']->name}}
            @else
            No posee
            @endif</td>
            <td>{{$t->created_at}}</td>
            <td>{{$t->updated_at}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
