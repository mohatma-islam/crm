<div class="accordion my-5" id="accordionPanelsStayOpenExample">

    <div class="accordion-item">

        <x-item.header data_target="#hostingDetail"> Hosting Details </x-item.header>

        <x-item.item-data target_id="hostingDetail">

            <div class="table-responsive">

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Hosting Detail ID</th>
                            <th scope="col">Website Name</th>
                            <th scope="col">Server Name</th>
                            <th scope="col">Host Name</th>
                            <th scope="col">Host Username</th>
                            <th scope="col">Host Password</th>
                            <th scope="col">Port Number</th>
                            <th scope="col">Server Supplier</th>
                            <th scope="col">Connection Type</th>
                        </tr>
                    </thead>
                    <tbody>

                    {{ $slot }}

                    </tbody>
                </table>
            
            </div>

        </x-item.item-data>

    </div>
</div>