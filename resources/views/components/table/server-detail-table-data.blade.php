<?php use Carbon\Carbon; ?>

@props(['serverDetail'])
<tr>
    <td>{{ $serverDetail['id'] }}</td>
    <td>{{ $serverDetail['name'] }}</td>
    <td>{{ $serverDetail['type'] }}</td>
    <td>{{ $serverDetail['provider'] }}</td>
    <td>{{ $serverDetail['provider_id'] }}</td>
    <td>{{ $serverDetail['size'] }}</td>
    <td>{{ $serverDetail['region'] }}</td>
    <td>{{ $serverDetail['ubuntu_version'] }}</td>
    <td>{{ $serverDetail['php_version'] }}</td>
    <td>{{ $serverDetail['database_type'] }}</td>
    <td>{{ $serverDetail['ip_address'] }}</td>
    <td>{{ $serverDetail['ssh_port'] }}</td>
    <td>{{ Carbon::parse($serverDetail['created_at'])->format('d/m/Y') }}</td>
    @if ($serverDetail['is_ready'] == true)
        <td>Yes</td>
    @else
        <td>No</td>
    @endif
</tr>
