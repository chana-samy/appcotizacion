<div class="form-group">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="10%">Nro</th>
                <th width="80%">Documento</th>
                <th width="10%">Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($documentos as $documento)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $documento->nombre }}</td>
                    <td>
                        <a href="{{ asset('storage/'.$documento->url) }}"
                            class="btn btn-primary btn-block rounded-0" target="_blank">Descargar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>