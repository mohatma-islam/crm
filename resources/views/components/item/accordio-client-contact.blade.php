@props(['clientContacts'])
<div class="accordion my-5" id="accordionPanelsStayOpenExample">

    <div class="accordion-item">

        <x-item.header data_target="#clientContact"> Client Contacts </x-item.header>

        <x-item.item-data target_id="clientContact">

            <div class="table-responsive">

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Client Contact ID</th>
                            <th scope="col">Client Primary Contact</th>
                            <th scope="col">Client Contact Name</th>
                            <th scope="col">Client Email Address</th>
                            <th scope="col">Client Phone Number</th>
                            <th scope="col">Created</th>
                            <th scope="col">Updated</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clientContacts as $clientContact)
                            <tr>
                                <td>{{ $clientContact->id }}</td>
                                <td> <input class="form-check-input" type="checkbox" name="flexRadioDefault"
                                        id="flexRadioDefault2" value="{{ $clientContact->client_primary_contact }}"
                                        {{ $clientContact->client_primary_contact === 1 ? 'checked' : '' }} disabled> </td>

                                <td><a href="{{ route('clientContact.show', $clientContact->id) }}">{{ $clientContact->client_contact_first_name }}
                                        {{ $clientContact->client_contact_surname }}</a> </td>

                                <td>{{ $clientContact->client_email_address }} </td>
                                <td>{{ $clientContact->client_phone_number }} </td>
                                <td>{{ date('d/m/Y', strtotime($clientContact->created_at)) }}</td>
                                <td>{{ date('d/m/Y', strtotime($clientContact->updated_at)) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        </x-item.item-data>

    </div>
</div>
