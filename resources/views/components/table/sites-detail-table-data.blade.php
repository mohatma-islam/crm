<?php use Carbon\Carbon; ?>

@props(['site'])
<tr>
    <td>{{ $site['id'] }}</td>
    <td>{{ $site['name'] }}</td>
    <td>{{ $site['status'] }}</td>
    <td>{{ $site['repository'] }}</td>
    <td>{{ $site['repository_branch'] }}</td>
    <td>{{ $site['repository_status'] }}</td>
    <td>{{ $site['project_type'] }}</td>
    <td>{{ $site['php_version'] }}</td>
    <td>{{ Carbon::parse($site['created_at'])->format('d/m/Y') }}</td>
    @if ($site['is_secured'] == true)
        <td>Yes</td>
    @else
        <td>No</td>
    @endif
</tr>
