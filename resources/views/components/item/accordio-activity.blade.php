@props(['activities'])
<div class="accordion my-5" id="accordionPanelsStayOpenExample">

    <div class="accordion-item">

        <x-item.header data_target="#activity"> Activities </x-item.header>

        <x-item.item-data target_id="activity">

            <div class="table-responsive">

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Activity ID</th>
                            <th scope="col">Activity Type</th>
                            <th scope="col">Activity Description</th>
                            <th scope="col">Created By</th>
                            <th scope="col">Created</th>
                            <th scope="col">Updated</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($activities as $activity)
                            <tr>
                                <td>{{ $activity->id }}</td>
                                <td><a href="{{ route('activity.show', $activity->id) }}">{{ $activity->activity_type }}</a> </td>
                                <td>{{ $activity->activity_description }}</td>
                                <td>{{ $activity->user->user_name }}</td>
                                <td>{{ $activity->created_at->format('d/m/Y') }}</td>
                                <td>{{ $activity->updated_at->format('d/m/Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            
            </div>

        </x-item.item-data>

    </div>
</div>