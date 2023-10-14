@props(['websites'])
<div class="accordion my-5" id="accordionPanelsStayOpenExample">

    <div class="accordion-item">

        <x-item.header data_target="#websites"> Websites </x-item.header>

        <x-item.item-data target_id="websites">

            <div class="table-responsive">

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Website ID</th>
                            <th scope="col">Website Name</th>
                            <th scope="col">Website Address</th>
                            <th scope="col">Created</th>
                            <th scope="col">Updated</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($websites as $website)
                            <tr>
                                <td>{{ $website->id }}</td>
                                <td><a href="{{ route('website.show', $website->id) }}">{{ $website->website_name }}</a>
                                </td>
                                <td>{{ $website->website_address }}</td>
                                <td>{{ date('d/m/Y', strtotime($website->created_at)) }}</td>
                                <td>{{ date('d/m/Y', strtotime($website->updated_at)) }}</td>

                            </tr>

                        @endforeach

                    </tbody>
                </table>

            </div>
                
        </x-item.item-data>

    </div>
</div>
