@props(['domain'])

<tr>
    <td>{{ $domain->id }}</td>
    <td>{{ $domain->name }}</td>
    <td>{{ $domain->owner }}</td>
    <td>{{ $domain->registrar }}</td>
    <td>{{ $domain->whois_server }}</td>
    <td>{{ $domain->states }}</td>
    <td>{{ $domain->name_servers }}</td>
    <td>{{ $domain->creation_date->format('d/m/Y') }}</td>
    <td>{{ $domain->expiration_date->format('d/m/Y') }}</td>
    <td>{{ $domain->updated_at->format('d/m/Y') }}</td>

</tr>