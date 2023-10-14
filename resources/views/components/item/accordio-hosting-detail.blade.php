@props(['hostingDetail'])

<div class="accordion my-5" id="accordionPanelsStayOpenExample">

    <div class="accordion-item">

        <x-item.header data_target="#hostingDetail"> Hosting Details </x-item.header>

        <x-item.item-data target_id="hostingDetail">

            <div class="table-responsive">

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Hosting Detail ID</th>
                            <th scope="col">Host Name</th>
                            <th scope="col">Host Username</th>
                            <th scope="col">Host Password</th>
                            <th scope="col">Port Number</th>
                            <th scope="col">Server Supplier</th>
                            <th scope="col">Connection Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $hostingDetail->id }}</td>
                            <td><a href="{{ route('hostingDetail.show', $hostingDetail->id) }}">
                                    {{ $hostingDetail->host_name }}</a> </td>
                            <td>{{ $hostingDetail->host_username }}</td>
                            <td>{{ $hostingDetail->host_password }}</td>
                            <td>{{ $hostingDetail->host_port_number }}</td>
                            <td>{{ $hostingDetail->server_supplier_lookup->value }}</td>
                            <td>{{ $hostingDetail->connection_type_lookup->value }}</td>
                        </tr>
                    </tbody>
                </table>
                
            </div>

        </x-item.item-data>

    </div>
</div>