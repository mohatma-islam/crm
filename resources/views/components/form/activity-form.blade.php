@props(['activity', 'clients'])

<ul id="show_message"></ul>

{{-- Checking if activity model exits in the database or not --}}
@if ($activity->exists)
    {{-- If activity data is found then use PATCH method for update --}}
    <form action="{{ route('activity.update', $activity->id) }}" method="POST" id="edit_activity_form">
        @csrf
        @method('PATCH')
    @else
        {{-- If activity data is not found then use POST method for create --}}
        <form action="{{ route('activity.store') }}" method="POST" id="create_activity_form">
            @csrf
@endif


{{-- dropdown to get activity model data from database --}}
<x-form.dropdown name="client_id">
    @if ($activity->exists)
        @foreach ($clients as $client)
            <option value="{{ $client->id }}"
                {{ $client->id == old('client_id', $activity->client->id) ? 'selected' : '' }}>
                {{ $client->client_name }}
            </option>
        @endforeach
    @else
        {{-- if ther is no activity model data, then get the old user data after validation --}}
        @foreach ($clients as $client)
            <option value="{{ $client->id }}" {{ $client->id == old('client_id') ? 'selected' : '' }}>
                {{ $client->client_name }}
            </option>
        @endforeach

    @endif
</x-form.dropdown>


<x-form.input :model="$activity" name="activity_type" type="text"/>

<x-form.input :model="$activity" name="activity_description" type="text"/>

<input type="text" name="created_by_id" value="{{ Auth::user()->id }}" id="created_by_id" hidden>

<x-form.button :model="$activity" />



</form>

<script>
    $(document).ready(function() {

        function getInputData() {
            return {
                'client_id': $('#client_id').val(),
                'activity_type': $('#activity_type').val(),
                'activity_description': $('#activity_description').val(),
                'created_by_id': $('#created_by_id').val(),
            };
        }

        function csrf_token() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        }

        function get_response(response) {
            if (response.status == 400) {
                $('#show_message').html();
                $('#show_message').addClass('alert alert-danger ps-4');
                $.each(response.errors, function(key, error_values) {
                    $('#show_message').append('<li>' + error_values +
                        '</li>');
                });
            } else {

                window.location.href = "{{ route('activity.index') }}";

            }
        }

        //Check if activity object exits or not
        @if ($activity->exists)

            //If activity object then then run the below script
            // Update Activity Record using AJAX and JQuery
            $("#edit_activity_form").on('submit', function(e) {

                e.preventDefault();

                csrf_token();

                $.ajax({
                    type: "PATCH",
                    url: "{{ route('activity.update', $activity->id) }}",
                    data: getInputData(),
                    dataType: "json",
                    success: function(response) {

                        $('#show_message').html("");
                        get_response(response);

                    }
                });

            });
        @else

            //If activity object doesn't exists then run the below script
            // Create Activity Record using AJAX and JQuery
            $("#create_activity_form").on('submit', function(e) {

                e.preventDefault();

                csrf_token();

                $.ajax({
                    type: "POST",
                    url: "{{ route('activity.store') }}",
                    data: getInputData(),
                    dataType: "json",
                    success: function(response) {

                        $('#show_message').html("");
                        get_response(response);
                    }
                });
            });
        @endif

    });
</script>
